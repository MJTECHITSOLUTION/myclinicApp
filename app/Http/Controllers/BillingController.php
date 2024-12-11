<?php

namespace App\Http\Controllers;

use App\Billing_cheque;
use App\Billing_reglement;
use App\Payment;
use Illuminate\Http\Request;
use App\User;
use App\Act;
use App\Consultation_acte;
use App\Seance;
use App\Setting;
use App\Billing;
use App\Billing_item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Redirect;

class BillingController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }


    public function create() {
        $prescription_id = request()->query('p');
        $user_id = request()->query('u');
        $lastPatientId = Session::get('lastpatient');

        $actes = Consultation_acte::leftJoin('billing_items', 'consultation_acte.id', '=', 'billing_items.consultation_act_id')
            ->join('act', 'act.id', '=', 'consultation_acte.act_id')
            ->where('prescription_id',$prescription_id)
            ->select('consultation_acte.id as consultation_act_idc', 'consultation_acte.libelle_act','consultation_acte.status', 'consultation_acte.dent', 'consultation_acte.prix', 'act.*', 'billing_items.*')
            ->get();

        $deleted_actes = Consultation_acte::leftJoin('billing_items', 'consultation_acte.id', '=', 'billing_items.consultation_act_id')
            ->where('user_id', $lastPatientId)
            ->join('act', 'act.id', '=', 'consultation_acte.act_id')
            ->where('deleted_act','=',1)
            ->select('consultation_acte.id as consultation_act_idc', 'consultation_acte.status', 'consultation_acte.dent', 'consultation_acte.prix', 'act.*', 'billing_items.*')
            ->get();

        $patients = User::where('role', 'patient')->get();
        $payments = Payment::all();

        return view('billing.create', [
            'patients' => $patients,
            'prescription_id' => $prescription_id,
            'user_id' => $user_id,
            'payments' => $payments,
            'actes'=>$actes,
            'deleted_actes'=>$deleted_actes,
        ]);
    }




    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'payment_mode' => 'required',
            'payment_status' => 'required',
            'invoice_title.*' => 'required',
            'invoice_amount.*' => ['required', 'numeric'],
        ]);


        $billing = new Billing;

        $billing->user_id = $request->patient_id;
        $billing->payment_mode = $request->payment_mode;
        $billing->payment_status = $request->payment_status;
        $billing->id_prescription = $request->id_prescription;
        $billing->reference = 'b' . rand(10000, 99999);
        $billing->due_amount = $request->due_amount;
        $billing->deposited_amount = $request->deposited_amount;
        $billing->vat = Setting::get_option('vat');

        $invoiceAmount = collect($request->invoice_amount);
        $dueAmount = collect($request->due_amount);

        $billing->total_without_tax = $request->due_amount;
        $billing->total_with_tax = $invoiceAmount->sum() + ($invoiceAmount->sum() * Setting::get_option('vat') / 100) + $dueAmount->sum();

        $billing->save();


        $add_reg = new Billing_reglement;
        $add_reg->payment = $request->payment;
        $add_reg->payment_method = $request->payment_mode;
        $add_reg->billing_id = $billing->id;;
        $add_reg->save();

        if (!empty($request->consultation_act_id)) {

            $i = count($request->consultation_act_id);

            for ($r = 0; $r < $i; $r++) {
                $invoice_items = new Billing_item;

                $invoice_items->consultation_act_id = $request->consultation_act_id[$r];
                $invoice_items->payer = $request->payer[$r];
                $invoice_items->billing_reglement_id = $add_reg->id ;
                // $invoice_items->invoice_amount = $request->invoice_amount[$x];
                $invoice_items->billing_id = $billing->id;


                $invoice_items->save();
            }

        }

        if (!empty($request->invoice_title)) {
            $i = count($request->invoice_title);

            for ($x = 0; $x < $i; $x++) {

                $invoice_item = new Billing_item;

                $invoice_item->invoice_title = $request->invoice_title[$x];
                $invoice_item->invoice_amount = $request->invoice_amount[$x];
                $invoice_item->billing_id = $billing->id;
                $invoice_item->payer = $request->new_payer[$x];
                $invoice_item->billing_reglement_id = $add_reg->id;
                $invoice_item->ref = rand(10000, 99999);

                $invoice_item->save();
            }
        }
        if ($request->payment_mode == 'Chèque') {
            foreach ($request->cheques as $cheque) {
                $billingCheque = new Billing_cheque;
                $billingCheque->reference = $cheque['reference'];
                $billingCheque->date_cheque = now()->format('Y-m-d');
                $billingCheque->amount_cheque = $cheque['montant'];
                $billingCheque->importer = $cheque['nom_importer'];
                $billingCheque->encaissementdate = $cheque['date_encaissement'];
                $billingCheque->billing_id = $billing->id;
                $billingCheque->save();
            }
        }


        return Redirect::route('billing.all')->with('success', 'Facture créée avec succès !');

    }


    public function getChequeDetails(Request $request)
    {
        $invoiceId = $request->id;
        // Fetch the cheque details based on the invoice ID
        $cheques = Billing_cheque::where('billing_id', $invoiceId)->get();
        // Return the view with cheque details
        return response()->json($cheques);
    }
    public function all(){
        $lastpatient = session('lastpatient');
        $patients = User::where('role', 'patient')->get();

        $invoices = Billing::orderBy('billings.id', 'DESC')
            ->when($lastpatient, function ($query) use ($lastpatient) {
                return $query->where('billings.user_id', $lastpatient);
            })
            ->leftJoin('prescriptions', function ($join) {
                $join->on('billings.id_prescription', '=', 'prescriptions.id');
            })
            ->select('billings.*', 'prescriptions.id as prescriptions_id')
            ->paginate(10);



        $sumPayments = DB::table('billing_reglement')
            ->select('billing_id', DB::raw('SUM(payment) as total_payment'))
            ->groupBy('billing_id')
            ->get();


        return view('billing.all', ['invoices' => $invoices , 'sumPayments'=>$sumPayments,'patients'=>$patients]);
    }

    public function facture(){
        $lastpatient = session('lastpatient');
        $patients = User::where('role', 'patient')->get();

        $invoices = Billing::orderBy('billings.id', 'DESC')
            ->when($lastpatient, function ($query) use ($lastpatient) {
                return $query->where('billings.user_id', $lastpatient);
            })
            ->leftJoin('prescriptions', function ($join) {
                $join->on('billings.id_prescription', '=', 'prescriptions.id');
            })
            ->where('billings.facture', 1)
            ->select('billings.*', 'prescriptions.id as prescriptions_id')
            ->paginate(10);

        $sumPayments = DB::table('billing_reglement')
            ->select('billing_id', DB::raw('SUM(payment) as total_payment'))
            ->groupBy('billing_id')
            ->get();


        return view('billing.facture', ['invoices' => $invoices , 'sumPayments'=>$sumPayments,'patients'=>$patients]);
    }

    public function search(Request $request){

        $reference = $request->input('reference');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $invoices = Billing::orderBy('billings.id', 'DESC')
            ->join('prescriptions', function ($join) use ($reference) {
                $join->on('billings.id_prescription', '=', 'prescriptions.id')
                    ->whereNotNull('billings.id_prescription');
                if ($reference) {
                    $join->where('prescriptions.reference', 'LIKE', '%' . $reference . '%');
                }
            })
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('billings.created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('billings.created_at', '<=', $endDate);
            })
            ->select('billings.*', 'prescriptions.id as prescriptions_id')
            ->paginate(20);



        $sumPayments = DB::table('billing_reglement')
            ->select('billing_id', DB::raw('SUM(payment) as total_payment'))
            ->groupBy('billing_id')
            ->get();


        return view('billing.search', ['invoices' => $invoices , 'sumPayments'=>$sumPayments,'reference'=>$reference,'startDate'=>$startDate,'endDate'=>$endDate]);
    }



    public function view($id){

        $billing = Billing::findOrfail($id);

        $billing_items = Billing_item::where('billing_id', $id)
            ->whereNotNull('invoice_title')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('billing_items as bi2')
                    ->whereColumn('bi2.ref', '=', 'billing_items.ref')
                    ->where('bi2.id', '<', DB::raw('billing_items.id'));
            })
            ->get();



        $actes = Billing_item::join(DB::raw('(SELECT consultation_act_id, MAX(created_at) as max_created_at
                            FROM billing_items
                            GROUP BY consultation_act_id) as max_created'),
            function ($join) {
                $join->on('billing_items.consultation_act_id', '=', 'max_created.consultation_act_id')
                    ->on('billing_items.created_at', '=', 'max_created.max_created_at');
            })
            ->join('consultation_acte', 'consultation_acte.id', '=', 'billing_items.consultation_act_id')
            ->join('act', 'act.id', '=', 'consultation_acte.act_id')
            ->where('billing_items.billing_id', $id)
            ->orderBy('billing_items.consultation_act_id')
            ->get([
                'consultation_acte.id as consultation_act_idc',
                'consultation_acte.status',
                'consultation_acte.dent',
                'consultation_acte.prix',
                'act.*',
                'billing_items.id as items_id',
                'billing_items.*'
            ]);

        return view('billing.view',['billing' => $billing, 'billing_items' => $billing_items , 'actes'=>$actes]);
    }

    public function pdf($id){

        $billing = Billing::findOrfail($id);
        $billing_items = Billing_item::where('billing_id' ,$id)->get();

        view()->share(['billing' => $billing, 'billing_items' => $billing_items]);
        $pdf = PDF::loadView('billing.pdf_view', ['billing' => $billing, 'billing_items' => $billing_items]);

        // download PDF file with download method
        return $pdf->download($billing->User->name.'_invoice.pdf');
    }


    public function edit($id){

        $billing = Billing::findOrfail($id);
        $billing_items = Billing_item::where('billing_id', $id)
            ->whereNotNull('invoice_title')
            ->get();

        $actes = Billing_item::join(DB::raw('(SELECT consultation_act_id, MAX(created_at) as max_created_at
                            FROM billing_items
                            GROUP BY consultation_act_id) as max_created'),
            function ($join) {
                $join->on('billing_items.consultation_act_id', '=', 'max_created.consultation_act_id')
                    ->on('billing_items.created_at', '=', 'max_created.max_created_at');
            })
            ->join('consultation_acte', 'consultation_acte.id', '=', 'billing_items.consultation_act_id') // Added join with consultation_acte
            ->join('act', 'act.id', '=', 'consultation_acte.act_id')
            ->where('billing_items.billing_id', $id)
            ->orderBy('billing_items.consultation_act_id')
            ->get([
                'consultation_acte.id as consultation_act_idc',
                'consultation_acte.status',
                'consultation_acte.dent',
                'consultation_acte.prix',
                'consultation_acte.libelle_act',
                'act.*',
                'billing_items.id as items_id',
                'billing_items.*'
            ]);
        $reglement = Billing_reglement::where('billing_id', '=', $id)
            ->latest()  // Orders the results by the created_at column in descending order
            ->first();
        $payments = Payment::all();


        return view('billing.edit',['billing' => $billing, 'billing_items' => $billing_items , 'payments'=>$payments ,'actes'=>$actes ,'reglement'=>$reglement]);

    }
    public function reglement($id){

        $billing = Billing::findOrfail($id);
        $billing_items = Billing_item::where('billing_id', $id)
            ->whereNotNull('invoice_title')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('billing_items as bi2')
                    ->whereColumn('bi2.ref', '=', 'billing_items.ref')
                    ->where('bi2.id', '<', DB::raw('billing_items.id'));
            })
            ->get();

        $sumPayment = DB::table('billing_reglement')
            ->select('billing_id', DB::raw('SUM(payment) as total_payment'))
            ->where('billing_id', $id) // Add this line to filter by billing_id
            ->groupBy('billing_id')
            ->get();



//
//        $actes = Consultation_acte::join('billing_items', 'consultation_acte.id', '=', 'billing_items.consultation_act_id')
//            ->where('billing_id', $id)
//            ->join('act', 'act.id', '=', 'consultation_acte.act_id')
//            ->select(
//                'consultation_acte.id as consultation_act_idc',
//                'consultation_acte.status',
//                'consultation_acte.dent',
//                'consultation_acte.prix',
//                'act.*',
//                'billing_items.id as items_id',
//                'billing_items.*'
//            )
//            ->get();

        $actes = Billing_item::join(DB::raw('(SELECT consultation_act_id, MAX(created_at) as max_created_at
                            FROM billing_items
                            GROUP BY consultation_act_id) as max_created'),
            function ($join) {
                $join->on('billing_items.consultation_act_id', '=', 'max_created.consultation_act_id')
                    ->on('billing_items.created_at', '=', 'max_created.max_created_at');
            })
            ->join('consultation_acte', 'consultation_acte.id', '=', 'billing_items.consultation_act_id') // Added join with consultation_acte
            ->join('act', 'act.id', '=', 'consultation_acte.act_id')
            ->where('billing_items.billing_id', $id)
            ->orderBy('billing_items.consultation_act_id')
            ->get([
                'consultation_acte.id as consultation_act_idc',
                'consultation_acte.status',
                'consultation_acte.dent',
                'consultation_acte.prix',
                'consultation_acte.libelle_act',
                'act.*',
                'billing_items.id as items_id',
                'billing_items.*'
            ]);


        $payments = Payment::all();
        return view('billing.reglement',['billing' => $billing, 'billing_items' => $billing_items , 'payments'=>$payments ,'actes'=>$actes,'sumPayment'=>$sumPayment]);
    }
    public function showreg($id){

        $reg = Billing_reglement::where('billing_id','=',$id)->get();

        return response()->json($reg);

    }
    public function deleteRow($id)
    {
        try {
            // Find the row by ID and get the billing_id
            $billingReglement = Billing_reglement::findOrFail($id);

            $billingId = $billingReglement->billing_id;

            Billing::where('id', $billingId)
                ->update(['payment_status' => 'Partially Paid']);

            $billingReglement->delete();

            return response()->json(['message' => 'Supprimée avec succès']);

        } catch (\Exception $e) {
            // Handle errors and return an error response
            return response()->json(['error' => 'Échec de la suppression'], 500);
        }


    }

    public function updateregle(Request $request){

        $billing = Billing::find($request->billing_id);
        $billing->payment_status = $request->payment_status;
        $billing->save();

        $add_reg = new Billing_reglement;
        $add_reg->payment = $request->payment;
        $add_reg->payment_method = $request->payment_mode;
        $add_reg->billing_id = $request->billing_id;
        $add_reg->save();

        if (!empty($request->billing_item_id)) {

            $i = count($request->billing_item_id);

            for ($x = 0; $x < $i; $x++) {

//                Billing_item::where('id', $request->billing_item_id[$x])
//                    ->update([
//                        'payer' => $request->new_payer[$x]
//                    ]);

                $invoice_item = new Billing_item;

                $invoice_item->invoice_title = $request->invoice_title[$x];
                $invoice_item->invoice_amount = $request->invoice_amount[$x];
                $invoice_item->billing_id = $billing->id;
                $invoice_item->payer = $request->payer[$x];
                $invoice_item->billing_reglement_id = $add_reg->id;
                $invoice_item->ref = $request->ref[$x];

                $invoice_item->save();
            }
        }


        if (!empty($request->consultation_act_id)) {

            $i = count($request->consultation_act_id);

            for ($x = 0; $x < $i; $x++) {
                $invoice_items = new Billing_item;

                $invoice_items->consultation_act_id = $request->consultation_act_id[$x];
//                $invoice_items->rest_a_payer = $request->rest_a_payer[$x];
                $invoice_items->payer = $request->payer[$x];
                $invoice_items->billing_reglement_id = $add_reg->id ;
                // $invoice_items->invoice_amount = $request->invoice_amount[$x];
                $invoice_items->billing_id = $billing->id;

                $invoice_items->save();
            }

        }

        return Redirect::route('billing.all');


    }

    public function update(Request $request)
    {
        $billing = Billing::findOrfail($request->billing_id);
        $billing_items = Billing_item::where('billing_id', $request->billing_id)->pluck('id')->toArray();


        if ($request->has('billing_item_id')) {
            $filtered = $request->billing_item_id;
        } else {
            $filtered = [];
        }



        foreach ($billing_items as $key => $dz) {
            $filtered[] = "$dz";
        }


        $filtered_unique = array_unique($filtered);


        $deleted_items = array_count_values($filtered);

//        foreach ($deleted_items as $key => $value)
//            if ($value < 2) {
//                $new_array[] = $key;
//
//                Billing_item::destroy($key);
//
//            }
        $billing = Billing::find($request->billing_id);

        $billing->user_id = $request->patient_id;
        $billing->payment_mode = $request->payment_mode;
        $billing->payment_status = $request->payment_status;
        $billing->reference = 'b'.rand(10000,99999);
//        $billing->due_amount = $request->due_amount;
//        $billing->deposited_amount = $request->deposited_amount;
        $billing->vat = Setting::get_option('vat');

        $newPayer = $request->oldPayer + $request->payment;
        $billing->due_amount = $newPayer;
        $invoiceAmount = collect($request->invoice_amount);
        $dueAmount = collect($request->due_amount);

        $billing->total_without_tax = $dueAmount->sum();
        $billing->total_with_tax = $invoiceAmount->sum() + ($invoiceAmount->sum() * Setting::get_option('vat') / 100) + $dueAmount->sum();
        $billing->save();

        if (isset($request->items_id)):
            $b = count($request->items_id);
            for ($x = 0; $x < $b; $x++) {
                Billing_item::where('id', $request->items_id[$x])
                    ->update(['payer' => $request->payer[$x],
                    ]);
            }

        endif;
        if (isset($request->reglement_id)):{
            Billing_reglement::where('id', $request->reglement_id)
                ->update(['payment' => $newPayer,
                    'payment_method'=>$request->payment_mode,
                ]);
        }
        endif;




        if(isset($request->invoice_title)):

            $i = count($request->invoice_title);


            for ($x = 0; $x < $i; $x++) {

                if(isset($request->billing_item_id[$x])){

                    Billing_item::where('id', $request->billing_item_id[$x])
                        ->update(['invoice_title' => $request->invoice_title[$x],
                            'invoice_amount' => $request->invoice_amount[$x],
                            'payer'=>$request->new_payer[$x],
                        ]);
                }else{
                    $add_item_to_invoice = new Billing_item;
                    $add_item_to_invoice->invoice_title = $request->invoice_title[$x];
                    $add_item_to_invoice->invoice_amount = $request->invoice_amount[$x];
                    $add_item_to_invoice->billing_id = $request->billing_id;
                    $add_item_to_invoice->payer = $request->n_new_payer;


                    $add_item_to_invoice->save();
                }
            }

//              if($request->payment_status == 'Paid'){
//                $request->due_amount = 0;
//                $request->deposited_amount = Collect($request->invoice_amount)->sum()+(Collect($request->invoice_amount)->sum()*Setting::get_option('vat')/100);
//              }

        endif;


        return Redirect::route('billing.all')->with('success', 'Facture modifiée avec succès !');

    }

    public function destroy($id){

        Billing::destroy($id);
        return Redirect::route('billing.all')->with('success', 'Facture supprimée avec succès !');

    }
    public function destroy_act($id)
    {
        // Retrieve billing items to delete
        $billingItemsToDelete = Billing_item::where('consultation_act_id', $id)->get();
        Consultation_acte::where('id', $id)->update(['deleted_act' => true]);
        // Calculate the sum of 'payer' column
        $sumPayer = $billingItemsToDelete->sum('payer');

        // Fetch the billing_reglement_id from the first billing item
        $billingReglementId = $billingItemsToDelete->first()->billing_reglement_id;

        // Delete billing items
        foreach ($billingItemsToDelete as $billingItem) {
            $billingItem->delete();
        }

        // Fetch the corresponding billing_reglement using billing_reglement_id
        $billingReglement = Billing_reglement::find($billingReglementId);

        // Update the payment column in billing_reglement
        if ($billingReglement) {
            // Subtract the sum of 'payer' from the 'payment' column
            $billingReglement->payment -= $sumPayer;

            // Make sure the payment value doesn't go below 0
            $billingReglement->payment = max(0, $billingReglement->payment);

            // Save the changes
            $billingReglement->save();
        }

        return back()->with('success', 'Act supprimée avec succès !');
    }
    public function showall($id){

        $patient = User::findOrFail($id);
        Session::put('lastpatient', $patient->id);
        Session::put('namePatient', $patient->name);
        Session::put('imagePatient', $patient->image);
        return Redirect::route('billing.all');
    }
    public function fetchBillingInfo($actId)
    {
        $billingInfo = Billing_item::where('consultation_act_id', $actId)->get();
        return response()->json($billingInfo);
    }
    public function trueFacture (Request $request){
        $trueFacture = Billing::where('id', $request->id)->update(['facture' => 1]);
        return redirect()->back()->with('success', 'Facture créée avec succès');

    }
    public function falseFacture (Request $request){
        $trueFacture = Billing::where('id', $request->id)->update(['facture' => 0]);
        return redirect()->back()->with('success', 'Facture supprimée avec succès');
    }

    public function updateDate($id, Request $request)
    {
        $billing = Billing::findOrFail($id);
        $billing->created_at = $request->date;
        $billing->save();

        return response()->json(['success' => true]);
    }
}
