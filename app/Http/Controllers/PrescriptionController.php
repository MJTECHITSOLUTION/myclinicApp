<?php

namespace App\Http\Controllers;

use App\Act;
use App\Analyse;
use App\Billing;
use App\Billing_item;
use App\Consultation_acte;
use App\Drugs_cat;
use App\Medicament;
use App\Posologie;
use App\Prescription_medicament;
use App\Prescription_rapport;
use App\Radio;
use App\Seance;
use App\Type_med;
use Illuminate\Http\Request;
use App\Drug;
use App\User;
use App\Patient;
use App\Prescription;
use App\Prescription_drug;
use App\Prescription_test;
use App\Prescription_radio;
use App\Test;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Redirect;
use Arr;


class PrescriptionController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create()
    {

        $drugs = Drug::all();
        $patients = User::where('role', 'patient')->get();
        $tests = Test::all();
        $analyses = Analyse::all();
        $radios = Radio::all();
        $actes = Act::all();
        $type_med = Type_med::all();
        $drugs_cat = Drugs_cat::all();

        $lastPatientId = Session::get('lastpatient');

        $alertMessage = null;
        $consultation = null; // Initialize $consultation
        $consultation_id = null; // Initialize $consultation

        if (isset($lastPatientId)) {
            $consultation = Consultation_acte::join('act', 'act.id', '=', 'consultation_acte.act_id')
                ->where('user_id', $lastPatientId)
                ->where('status', 'En cours')
                ->select('act.*', 'consultation_acte.*')
                ->get();

            $consultation_id = Consultation_acte::where('user_id', $lastPatientId)
                ->where('status', 'En cours')
                ->distinct()
                ->select('consultation_acte.prescription_id')
                ->get();

            if ($consultation->isNotEmpty()) {
                $alertMessage = 'Cette patient est déjà en consultation (En cours)';
            }
        }


        return view('prescription.create', [
            'drugs' => $drugs,
            'patients' => $patients,
            'tests' => $tests,
            'analyses' => $analyses,
            'radios' => $radios,
            'actes' => $actes,
            'alertMessage' => $alertMessage,
            'consultations' => $consultation,
            'consultation_id' => $consultation_id,
            'type_med' => $type_med,
            'drugs_cat' => $drugs_cat
        ]);
    }

    public function getDrugsByType(Request $request)
    {
        $typeId = $request->input('type_id');
        $drugs = Medicament::where('type_id', $typeId)->get();
        return response()->json($drugs);
    }


    public function getPosologieByMedicament(Request $request)
    {
        $medicamentId = $request->input('medicament_id');
        $posologie = Posologie::where('drug_id', $medicamentId)->first();

        if ($posologie) {
            return response()->json(['posologie' => $posologie->posologie]);
        } else {
            return response()->json(['posologie' => null]);
        }
    }

    public function data()
    {

        $lastPatientId = Session::get('lastpatient');

        $alertMessage = null;
        $consultation = null;
        $consultation_id = null;

        if (isset($lastPatientId)) {
            $consultation = Consultation_acte::join('act', 'act.id', '=', 'consultation_acte.act_id')
                ->join('seances', 'seances.consultation_act_id', '=', 'consultation_acte.id')
                ->where('user_id', $lastPatientId)
                ->where('status', 'En cours')
                ->select('act.*', 'consultation_acte.*', 'seances.*')
                ->get();

            $consultation_id = Consultation_acte::where('user_id', $lastPatientId)
                ->where('status', 'En cours')
                ->distinct()
                ->select('consultation_acte.prescription_id')
                ->get();

            if ($consultation->isNotEmpty()) {
                $alertMessage = 'Cette patient est déjà en consultation (En cours)';
            }
        }
        return response()->json($consultation);
    }

    //dropdown
    public function getAnalyses($testId)
    {
        $analyses = Analyse::where('test_id', $testId)->get();

        return response()->json($analyses);
    }

    public function getPatientData($patient_id)
    {
        $patient = User::findOrFail($patient_id);


        // Update the session variables
        Session::put('lastpatient', $patient->id);
        Session::put('namePatient', $patient->name);
        Session::put('imagePatient', $patient->image);
        Session::put('genderPation', $patient->patient->gender);

        // Return the updated data as JSON
        return response()->json([
            'namePatient' => Session::get('namePatient'),
            'lastPatientId' => Session::get('lastpatient'),
            'imagePatient' => Session::get('imagePatient'),
            'genderPation' => Session::put('genderPation', $patient->patient->gender),
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
        ], [
            'patient_id.required' => 'Le champ patient est obligatoire.',
            'patient_id.exists' => 'Aucun patient spécifié',
        ]);


        $prescription = new Prescription;
        $prescription->user_id = $request->patient_id;
        $prescription->observation = $request->observation;
        $prescription->observation2 = $request->observation2;
        $prescription->observation3 = $request->observation3;
        $prescription->observation4 = $request->observation4;
        $prescription->observation5 = $request->observation5;
        $prescription->motife = $request->motife;
        $prescription->pc = $request->pc;
        $prescription->fr = $request->fr;
        $prescription->sa = $request->sa;
        $prescription->rapport = $request->rapport;
        $prescription->bilan = $request->bilan;
        $prescription->age = $request->age;
        $prescription->poid = $request->poid;
        $prescription->taille = $request->taille;
        $prescription->pas = $request->pas;
        $prescription->pad = $request->pad;
        $prescription->pouls = $request->pouls;
        $prescription->temp = $request->temp;
        $prescription->certificat = $request->certificat;
        $prescription->dated = $request->dated;
        $prescription->datef = $request->datef;
        $prescription->av_vl_od_s = $request->av_vl_od_s;
        $prescription->av_vl_og_s = $request->av_vl_og_s;
        $prescription->av_vl_od_a = $request->av_vl_od_a;
        $prescription->av_vl_og_a = $request->av_vl_og_a;
        $prescription->av_vp_od = $request->av_vp_od;
        $prescription->av_vp_og = $request->av_vp_og;
        $prescription->annex_od = $request->annex_od;
        $prescription->annex_og = $request->annex_og;
        $prescription->sa_od = $request->sa_od;
        $prescription->sa_og = $request->sa_og;
        $prescription->to_od = $request->to_od;
        $prescription->to_og = $request->to_og;
        $prescription->fo_od = $request->fo_od;
        $prescription->fo_og = $request->fo_og;
        $prescription->verre_ar = $request->verre_ar;
        $prescription->verre_lb = $request->verre_lb;
        $prescription->verre_uv = $request->verre_uv;
        $prescription->verre_pro = $request->verre_pro;
        $prescription->verre_phog = $request->verre_phog;
        $prescription->ref_od = $request->ref_od;
        $prescription->ref_og = $request->ref_og;
        $prescription->haut = $request->haut;
        $prescription->droite = $request->droite;
        $prescription->gauche = $request->gauche;
        $prescription->bas = $request->bas;
        $prescription->patient_title = $request->patient_title;
        $prescription->addition = $request->addition;

        $prescription->reference = 'p' . rand(10000, 99999);
        $prescription->note_honoraire = 'N-' . rand(10000, 99999);
        $prescription->save();

        if (isset($request->trade_name)) {
            $i = count($request->trade_name);
            for ($x = 0; $x < $i; $x++) {
                if ($request->trade_name[$x] != null) {
                    $add_drug = new Prescription_drug;
                    // Set the properties for the Prescription_drug model
                    //                    $add_drug->dose = $request->dose[$x];
                    //                    $add_drug->duration = $request->duration[$x];
                    $add_drug->drug_advice = $request->drug_advice[$x];
                    $add_drug->prescription_id = $prescription->id;
                    $add_drug->drug_id = $request->trade_name[$x];
                    $add_drug->save();
                }
            }
        }

        if (isset($request->medicament_id)) {
            $i = count($request->medicament_id);
            for ($x = 0; $x < $i; $x++) {
                if ($request->medicament_id[$x] != null) {
                    $add_drug = new Prescription_medicament;
                    $add_drug->medicament_id = $request->medicament_id[$x];
                    $add_drug->drug_advice = $request->medicament_advice[$x];
                    $add_drug->prescription_id = $prescription->id;
                    $add_drug->save();
                }
            }
        }

        if (isset($request->value)) {
            $i = count($request->value);
            for ($x = 0; $x < $i; $x++) {
                if ($request->value[$x] != null) {
                    $add_rapport = new Prescription_rapport;
                    $add_rapport->value = $request->value[$x];
                    $add_rapport->rapport = $request->rap[$x];
                    $add_rapport->prescription_id = $prescription->id;
                    $add_rapport->save();
                }
            }
        }
        if (isset($request->act_id)) {
            $i = count($request->act_id);
            $consultation_acte_ids = [];
            for ($x = 0; $x < $i; $x++) {
                if ($request->act_id[$x] != null) {
                    $add_acte = new Consultation_acte;
                    $add_acte->act_id = $request->act_id[$x];
                    $add_acte->prix = $request->prix[$x];
                    $add_acte->libelle_act = $request->libelle_act[$x];
                    $add_acte->dent = $request->dent[$x];
                    $add_acte->status = $request->status[$x];
                    $add_acte->prescription_id = $prescription->id;
                    $add_acte->user_id = $request->patient_id;
                    $consultation_acte_ids[] = $add_acte->id;
                    $add_acte->save();

                    // Save the Consultation_acte object
                    if (isset($add_acte->id)) {
                        $add_seance = new Seance;
                        $add_seance->prescription_id = $prescription->id;
                        $add_seance->consultation_act_id = $add_acte->id;
                        $add_seance->numseances = $request->numseancess[$x];

                        // Retrieve the observations as an array
                        $observations = $request->input('observationss', []);
                        $add_seance->observation = isset($observations[$x]) ? $observations[$x] : null;

                        // Save the Seance object
                        $add_seance->save();
                    }
                }
            }
        }
        if (isset($request->consultation_act_id)) {
            $i = count($request->consultation_act_id);
            for ($x = 0; $x < $i; $x++) {
                if ($request->consultation_act_id[$x] != null) {
                    $add_seance = new Seance;
                    $add_seance->prescription_id = $prescription->id;
                    $add_seance->consultation_act_id = $request->consultation_act_id[$x];
                    $add_seance->numseances = $request->numseances[$x];

                    // Retrieve the observations as an array
                    $observations = $request->input('observations', []);
                    $add_seance->observation = isset($observations[$x]) ? $observations[$x] : null;
                    $add_seance->save();

                    Consultation_acte::where('id', $request->consultation_act_id[$x])
                        ->update(['status' => $request->old_status[$x]]);
                }
            }
        }

        if (isset($request->radio_id)) {
            $i = count($request->radio_id);
            for ($x = 0; $x < $i; $x++) {
                //                if($request -> radio[$x] =! null){
                $add_radio = new Prescription_radio;
                $add_radio->radio_id = $request->radio_id[$x];
                $add_radio->justif = $request->justif[$x];
                $add_radio->prescription_id = $prescription->id;
                $add_radio->save();
            }
            //            }
        }

        if (isset($request->radio)) {
            $i = count($request->radio);
            for ($x = 0; $x < $i; $x++) {
                //                if($request -> radio[$x] =! null){
                $add_radio = new Prescription_radio;
                $add_radio->radio = $request->radio[$x];
                $add_radio->justif = $request->justif[$x];
                $add_radio->prescription_id = $prescription->id;
                $add_radio->save();
            }
            //            }
        }

        if (isset($request->analyse_id)) {
            $y = count($request->analyse_id);
            for ($x = 0; $x < $y; $x++) {
                $add_test = new Prescription_test;
                $add_test->test_id = 14;
                $add_test->prescription_id = $prescription->id;
                $add_test->description = $request->description[$x];
                $add_test->analyse_id = $request->analyse_id[$x];
                $add_test->save();
            }
        }

        return Redirect::route('prescription.view', ['id' => $prescription->id])->with('success', 'consultation créée avec succès!');
    }


    public function all()
    {
        $lastpatient = session('lastpatient');
        $patients = User::where('role', 'patient')->get();


        $prescriptions = Prescription::orderBy('id', 'DESC')
            ->when($lastpatient, function ($query) use ($lastpatient) {
                return $query->where('user_id', $lastpatient);
            })
            ->paginate(15);

        $billingExists = [];
        $billingIds = [];
        $paymentStatus = [];
        $consultation = [];
        $referance = [];


        foreach ($prescriptions as $prescription) {
            $billingEntry = Billing::where('id_prescription', $prescription->id)->first();

            if ($billingEntry) {
                $billingExists[$prescription->id] = true;
                $billingIds[$prescription->id] = $billingEntry->id;
                $paymentStatus[$prescription->id] = $billingEntry->payment_status;
                $referance[$prescription->id] = $billingEntry->reference;
            } else {
                $billingExists[$prescription->id] = false;
                $billingIds[$prescription->id] = null;
                $paymentStatus[$prescription->id] = null;
                $referance[$prescription->id] = null;


            }

            // Count 'consultation_acte' records for the current prescription
            $enCoursCount = Consultation_acte::where('prescription_id', $prescription->id)
                ->where('status', 'En cours')
                ->count();

            $termineCount = Consultation_acte::where('prescription_id', $prescription->id)
                ->where('status', 'Termine')
                ->count();

            $consultation[$prescription->id]['en_cours'] = $enCoursCount;
            $consultation[$prescription->id]['termine'] = $termineCount;
        }

        return view('prescription.all', [
            'prescriptions' => $prescriptions,
            'billingExists' => $billingExists,
            'billingIds' => $billingIds,
            'paymentStatus' => $paymentStatus,
            'consultation' => $consultation,
            'referance' => $referance,
            'patients' => $patients,
        ]);
    }

    public function search()
    {
        $lastpatient = session('lastpatient');

        $start_date = request()->input('start_date');
        $end_date = request()->input('end_date');

        $prescriptions = Prescription::orderBy('id', 'ASC')
            ->when($lastpatient, function ($query) use ($lastpatient) {
                return $query->where('user_id', $lastpatient);
            })
            ->when($start_date, function ($query) use ($start_date) {
                return $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->whereDate('created_at', '<=', $end_date);
            })
            ->paginate(15);
        $prescriptions->appends(request()->input());


        $billingExists = [];
        $billingIds = [];
        $paymentStatus = [];
        $consultation = [];
        $referance = [];

        foreach ($prescriptions as $prescription) {
            $billingEntry = Billing::where('id_prescription', $prescription->id)->first();

            if ($billingEntry) {
                $billingExists[$prescription->id] = true;
                $billingIds[$prescription->id] = $billingEntry->id;
                $paymentStatus[$prescription->id] = $billingEntry->payment_status;
                $referance[$prescription->id] = $billingEntry->reference;
            } else {
                $billingExists[$prescription->id] = false;
                $billingIds[$prescription->id] = null;
                $paymentStatus[$prescription->id] = null;
                $referance[$prescription->id] = null;


            }

            // Count 'consultation_acte' records for the current prescription
            $enCoursCount = Consultation_acte::where('prescription_id', $prescription->id)
                ->where('status', 'En cours')
                ->count();

            $termineCount = Consultation_acte::where('prescription_id', $prescription->id)
                ->where('status', 'Termine')
                ->count();

            $consultation[$prescription->id]['en_cours'] = $enCoursCount;
            $consultation[$prescription->id]['termine'] = $termineCount;
        }

        return view('prescription.search', [
            'prescriptions' => $prescriptions,
            'billingExists' => $billingExists,
            'billingIds' => $billingIds,
            'paymentStatus' => $paymentStatus,
            'consultation' => $consultation,
            'referance' => $referance,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);
    }


    public function view($id)
    {

        $user_id = request()->query('user_id');
        $prescription = Prescription::findOrFail($id);
        $billingEntry = Billing::where('id_prescription', $prescription->id)->first();
        $prescription_drugs = Prescription_drug::where('prescription_id', $id)->get();
        $prescription_tests = Prescription_test::where('prescription_id', $id)->get();
        $prescription_radios = DB::table('prescription_radio')
            ->join('radio', 'prescription_radio.radio_id', '=', 'radio.id')
            ->where('prescription_radio.prescription_id', $id)
            ->select('prescription_radio.*', 'radio.radio_name')
            ->get();
        $radios_pediatre = Prescription_radio::where('prescription_id', $id)->get();

        $consultation_act = Consultation_acte::join('act', 'act.id', '=', 'consultation_acte.act_id')
            ->join('prescriptions', 'consultation_acte.prescription_id', '=', 'prescriptions.id')
            ->where('prescriptions.id', $id)
            ->select('act.*', 'consultation_acte.*', 'prescriptions.*')
            ->get();
        $prescription_medicament = Prescription_medicament::where('prescription_id', $id)->join('medicament', 'prescription_medicament.medicament_id', '=', 'medicament.id')->get();

        $totalPrice = $consultation_act->sum('prix');


        $patient = Patient::where('user_id', $user_id)->first();

        foreach ($prescription_tests as $prescription_test) {
            $analyse = Analyse::find($prescription_test->analyse_id);
            $prescription_test->analyse_name = $analyse ? $analyse->analyse_name : '';
        }

        return view('prescription.view', [
            'prescription' => $prescription,
            'prescription_drugs' => $prescription_drugs,
            'prescription_tests' => $prescription_tests,
            'prescription_radios' => $prescription_radios,
            'patient' => $patient,
            'billingEntry' => $billingEntry,
            'consultation_act' => $consultation_act,
            'radios_pediatre' => $radios_pediatre,
            'totalPrice' => $totalPrice,
            'prescription_medicament' => $prescription_medicament,
        ]);
    }

    public function pdf($id)
    {

        $prescription = Prescription::findOrfail($id);
        $prescription_drugs = Prescription_drug::where('prescription_id', $id)->get();

        view()->share(['prescription' => $prescription, 'prescription_drugs' => $prescription_drugs]);


        $pdf = PDF::loadView('prescription.pdf_view', ['prescription' => $prescription, 'prescription_drugs' => $prescription_drugs]);
        $pdf->setOption('viewport-size', '1024x768');
        // download PDF file with download method
        return $pdf->download($prescription->User->name . '_pdf.pdf');
    }


    public function edit($id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription_drugs = Prescription_drug::where('prescription_id', $id)->get();
        $prescription_tests = Prescription_test::where('prescription_id', $id)->get();
        $prescription_rapport = Prescription_rapport::where('prescription_id', $id)->get();
        $prescription_medicament = Prescription_medicament::where('prescription_id', $id)->join('medicament', 'prescription_medicament.medicament_id', '=', 'medicament.id')->select('Prescription_medicament.*','medicament.*','Prescription_medicament.id as medicament_id')->get();
        $drugs = Drug::all();
        $tests = Test::all();
        $type_med = Type_med::all();
        $listradio = Radio::all()->toArray();
        $radios = Radio::all();
        $drugs_cat = Drugs_cat::all();
        $prescription_radio = Prescription_radio::where('prescription_id', $id)->get();
        $analyses = Analyse::all();
        $prescription_radios = Prescription_radio::where('prescription_id', $id)
            ->join('radio', 'prescription_radio.radio_id', '=', 'radio.id')
            ->select('radio.radio_name', 'prescription_radio.*')
            ->get();
        $selectradios = DB::table('prescription_radio')
            ->join('radio', 'prescription_radio.radio_id', '=', 'radio.id')
            ->where('prescription_radio.prescription_id', $id)
            ->select('prescription_radio.*', 'radio.*')
            ->get();

        // Fetch all associated analyses and store them in an array
        $analyseIds = $prescription_tests->pluck('analyse_id')->toArray();
        $analysesData = Analyse::whereIn('id', $analyseIds)->get();

        // Associate each prescription test with its corresponding analysis
        $prescription_tests->each(function ($prescription_test) use ($analysesData) {
            $analyse = $analysesData->where('id', $prescription_test->analyse_id)->first();
            $prescription_test->analyse_name = $analyse ? $analyse->analyse_name : '';
        });
        $actes = Act::all();
        $consultationact = Consultation_acte::join('act', 'act.id', '=', 'consultation_acte.act_id')
            ->where('prescription_id', '=', $id)
            ->select('act.*', 'consultation_acte.*')
            ->get();

        return view('prescription.edit', [
            'prescription' => $prescription,
            'prescription_drugs' => $prescription_drugs,
            'prescription_tests' => $prescription_tests,
            'drugs' => $drugs,
            'tests' => $tests,
            'analyses' => $analyses,
            'prescription_radios' => $prescription_radios,
            'selectradios' => $selectradios,
            'listradio' => $listradio,
            'radios' => $radios,
            'actes' => $actes,
            'consultationact' => $consultationact,
            'prescription_rapport' => $prescription_rapport,
            'prescription_radio' => $prescription_radio,
            'type_med' => $type_med,
            'prescription_medicament' => $prescription_medicament,
            'drugs_cat' => $drugs_cat
        ]);
    }


    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'trade_name.*' => 'required',
        ]);

        if (isset($request->prescription_id)) {
            Prescription::where('id', $request->prescription_id)
                ->update([
                    'observation' => $request->observation,
                    'observation2' => $request->observation2,
                    'observation3' => $request->observation3,
                    'observation4' => $request->observation4,
                    'observation5' => $request->observation5,
                    'poid' => $request->poid,
                    'taille' => $request->taille,
                    'pas' => $request->pas,
                    'pad' => $request->pad,
                    'pouls' => $request->pouls,
                    'temp' => $request->temp,
                    'certificat' => $request->certificat,
                    'dated' => $request->dated,
                    'datef' => $request->datef,
                    'motife' => $request->motife,
                    'pc' => $request->pc,
                    'fr' => $request->fr,
                    'sa' => $request->sa,
                    'rapport' => $request->rapport,
                    'bilan' => $request->bilan,
                    'age' => $request->age,
                ]);
        } else {
            $prescription = new Prescription;
            //            $prescription->user_id = $user->id; // Assuming you have a valid $user object with an id property
            $prescription->observation = $request->observation;
            $prescription->observation2 = $request->observation2;
            $prescription->observation3 = $request->observation3;
            $prescription->observation4 = $request->observation4;
            $prescription->observation5 = $request->observation5;
            $prescription->motife = $request->motife;
            $prescription->pc = $request->pc;
            $prescription->fr = $request->fr;
            $prescription->sa = $request->sa;
            $prescription->rapport = $request->rapport;
            $prescription->bilan = $request->bilan;
            $prescription->age = $request->age;
            $prescription->poid = $request->poid;
            $prescription->taille = $request->taille;
            $prescription->pas = $request->pas;
            $prescription->pad = $request->pad;
            $prescription->pouls = $request->pouls;
            $prescription->temp = $request->temp;
            $prescription->certificat = $request->certificat;
            $prescription->dated = $request->dated;
            $prescription->datef = $request->datef;
            $prescription->av_vl_od_s = $request->av_vl_od_s;
            $prescription->av_vl_og_s = $request->av_vl_og_s;
            $prescription->av_vl_od_a = $request->av_vl_od_a;
            $prescription->av_vl_og_a = $request->av_vl_og_a;
            $prescription->av_vp_od = $request->av_vp_od;
            $prescription->av_vp_og = $request->av_vp_og;
            $prescription->annex_od = $request->annex_od;
            $prescription->annex_og = $request->annex_og;
            $prescription->sa_od = $request->sa_od;
            $prescription->sa_og = $request->sa_og;
            $prescription->to_od = $request->to_od;
            $prescription->to_og = $request->to_og;
            $prescription->fo_od = $request->fo_od;
            $prescription->fo_og = $request->fo_og;
            $prescription->verre_ar = $request->verre_ar;
            $prescription->verre_lb = $request->verre_lb;
            $prescription->verre_uv = $request->verre_uv;
            $prescription->verre_pro = $request->verre_pro;
            $prescription->verre_phog = $request->verre_phog;
            $prescription->ref_od = $request->ref_od;
            $prescription->ref_og = $request->ref_og;
            $prescription->haut = $request->haut;
            $prescription->droite = $request->droite;
            $prescription->gauche = $request->gauche;
            $prescription->bas = $request->bas;
            $prescription->patient_title = $request->patient_title;
            $prescription->addition = $request->addition;
            $prescription->reference = 'p' . rand(10000, 99999);
            $prescription->save();
        }
        

        $analyses = Analyse::all();
        $prescription_drugs = Prescription_drug::where('prescription_id', $request->prescription_id)->pluck('id')->toArray();

        if ($request->has('prescription_drug_id')) {
            $filtered = $request->prescription_drug_id;
        } else {
            $filtered = [];
        }

        foreach ($prescription_drugs as $key => $dz) {
            $filtered[] = "$dz";
        }


        $filtered_unique = array_unique($filtered);


        $deleted_drugs = array_count_values($filtered);

        foreach ($deleted_drugs as $key => $value)
            if ($value < 2) {
                $new_array[] = $key;
                Prescription_drug::destroy($key);
            }

//        $prescription_medicament = Prescription_medicament::where('prescription_id', $request->prescription_id)->pluck('id')->toArray();
//        if ($request->has('prescription_medicament_id')) {
//            $filtered = $request->prescription_medicament_id;
//        } else {
//            $filtered = [];
//        }
//        foreach ($prescription_medicament as $key => $dz) {
//            $filtered[] = "$dz";
//        }
//        $filtered_unique = array_unique($filtered);
//        $deleted_drugs = array_count_values($filtered);
//        foreach ($deleted_drugs as $key => $value)
//            if ($value < 2) {
//                $new_array[] = $key;
//                Prescription_medicament::destroy($key);
//            }

        if (isset($request->medicament_id)) {
            $i = count($request->medicament_id);
            for ($x = 0; $x < $i; $x++) {
                if ($request->medicament_id[$x] != null) {
                    $add_drug = new Prescription_medicament;
                    $add_drug->medicament_id = $request->medicament_id[$x];
                    $add_drug->drug_advice = $request->medicament_advice[$x];
                    $add_drug->prescription_id = $request->prescription_id;
                    $add_drug->save();
                }
            }
        }

        if (isset($request->trade_name)) :
            $i = count($request->trade_name);
            for ($x = 0; $x < $i; $x++) {
                if (isset($request->prescription_drug_id[$x])) {
                    Prescription_drug::where('id', $request->prescription_drug_id[$x])
                        ->update([
                            'type' => $request->type[$x],
                            'strength' => $request->strength[$x],
                            'dose' => $request->dose[$x],
                            'duration' => $request->duration[$x],
                            'drug_advice' => $request->drug_advice[$x],
                            'drug_id' => $request->trade_name[$x]
                        ]);
                } else {
                    $add_drug = new Prescription_drug;
                    //                    $add_drug->type = $request->type[$x];
                    //                    $add_drug->strength = $request->strength[$x];
                    //                    $add_drug->dose = $request->dose[$x];
                    //                    $add_drug->duration = $request->duration[$x];
                    $add_drug->drug_advice = $request->drug_advice[$x];
                    $add_drug->prescription_id = $request->prescription_id;
                    $add_drug->drug_id = $request->trade_name[$x];
                    $add_drug->save();
                }
            }
        endif;


        if (isset($request->value)):
            $i = count($request->value);
            for ($x = 0; $x < $i; $x++) {
                if (isset($request->prescription_rapport_id[$x])) {
                    // Ensure $request->prescription_rapport_id[$x] is not a string
                    Prescription_rapport::where('id', $request->prescription_rapport_id[$x])
                        ->update([
                            'value' => $request->value[$x],
                            'rapport' => $request->rapport[$x],
                        ]);
                } else {
                    $add_rapport = new Prescription_rapport;
                    $add_rapport->value = $request->value[$x];
                    $add_rapport->rapport = $request->rapport[$x];
                    $add_rapport->prescription_id = $request->prescription_id;
                    $add_rapport->save();
                }
            }
        endif;
        if (isset($request->act_id)) {
            $i = count($request->act_id);

            for ($x = 0; $x < $i; $x++) {
                if (isset($request->consultation_act_id[$x])) {

                    // Update existing Consultation_acte
                    Consultation_acte::where('id', $request->consultation_act_id[$x])
                        ->update([
                            'status' => $request->status[$x],
                            'prix' => $request->prix[$x],
                        ]);
                }
            }
        }
        if (isset($request->new_act_id)) {
            $i = count($request->new_act_id);

            for ($x = 0; $x < $i; $x++) {
                $add_act = new Consultation_acte;
                $add_act->act_id = $request->new_act_id[$x];
                $add_act->prix = $request->prix[$x];
                $add_act->libelle_act = $request->libelle_act[$x];
                $add_act->status = $request->status[$x];
                $add_act->dent = $request->new_dent[$x];
                $add_act->prescription_id = $request->prescription_id;
                $add_act->user_id = $request->patient_id;
                $add_act->save();

                $add_seance = new Seance;
                $add_seance->prescription_id = $request->prescription_id;
                $add_seance->consultation_act_id = $add_act->id;
                $add_seance->numseances = 1;

                // Retrieve the observations as an array
                $observations = $request->input('observations', []);
                $add_seance->observation = isset($observations[$x]) ? $observations[$x] : null;

                // Save the Seance object
                $add_seance->save();
            }
        }


        // Test

        $prescription_tests = Prescription_test::where('prescription_id', $request->prescription_id)->pluck('id')->toArray();

        if ($request->has('prescription_test_id')) {
            $filtered_test = $request->prescription_test_id;
        } else {
            $filtered_test = [];
        }

        foreach ($prescription_tests as $key => $fr) {
            $filtered_test[] = "$fr";
        }


        $filtered_test_unique = array_unique($filtered_test);

        $deleted_tests = array_count_values($filtered_test);

        foreach ($deleted_tests as $key => $value)
            if ($value < 2) {
                //$new_array[] = $key;
                Prescription_test::destroy($key);
            }

        $prescription_radios = Prescription_radio::where('prescription_id', $request->prescription_id)->pluck('id')->toArray();

        if ($request->has('prescription_radio_id')) {
            $filtered_test = $request->prescription_radio_id;
        } else {
            $filtered_test = [];
        }

        foreach ($prescription_radios as $key => $frr) {
            $filtered_test[] = "$frr";
        }


        $filtered_test_unique = array_unique($filtered_test);

        $deleted_tests = array_count_values($filtered_test);

        foreach ($deleted_tests as $key => $value)
            if ($value < 2) {
                //$new_array[] = $key;
                Prescription_radio::destroy($key);
            }


        if (isset($request->radio_id)) :
            $i = count($request->radio_id);
            for ($x = 0; $x < $i; $x++) {

                    if (isset($request->prescription_radio_id[$x])) {
                        Prescription_radio::where('id', $request->prescription_radio_id[$x])
                            ->update([
                                'radio' => $request->radio_id[$x],
                                'prescription_id' => $request->prescription_id,
                                'justif' => $request->justif[$x],
                            ]);
                    } else {
                        $add_radio = new Prescription_radio;
                        $add_radio->radio = $request->radio[$x];
                        $add_radio->prescription_id = $request->prescription_id;
                        $add_radio->justif = $request->justif[$x];

                        $add_radio->save();
                    }
            }
        endif;

        if (isset($request->radio_id_new)) {
            $i = count($request->radio_id_new);
            for ($x = 0; $x < $i; $x++) {
                $add_radio = new Prescription_radio;
                $add_radio->radio_id = $request->radio_id_new[$x];
                $add_radio->justif = $request->justif_new[$x];
                $add_radio->prescription_id = $request->prescription_id;
                $add_radio->save();
            }
        }


        if (isset($request->test_name)) :
            $i = count($request->test_name);
            for ($x = 0; $x < $i; $x++) {

                try {
                    if (isset($request->prescription_test_id[$x])) {
                        Prescription_test::where('id', $request->prescription_test_id[$x])
                            ->update([
                                'description' => $request->description[$x],
                                'test_id' => 14,
                                'analyse_id' => $request->analyse_id[$x],
                            ]);
                    } else {
                        $add_test = new Prescription_test;
                        $add_test->description = $request->description[$x];
                        $add_test->prescription_id = $request->prescription_id;
                        $add_test->test_id = 14;
                        $add_test->analyse_id = $request->analyse_id[$x];

                        $add_test->save();
                    }
                } catch (\Exception $e) {
                    // Log or handle the exception as needed
                    return back()->withInput()->withErrors(['error' => 'An error occurred']);
                }
            }
        endif;
        return Redirect::route('prescription.view', ['id' => $request->prescription_id])->with('success', 'consultation modifiée avec succès!');
        //return $request;

    }


    public function destroy($id)
    {
        Prescription::destroy($id);
        return Redirect::route('prescription.all')->with('success', 'consultation supprimée avec succès !');
    }


    public function view_for_user(Request $request, $id)
    {

        $User = User::findOrfail($id);

        $prescriptions = Prescription::where('user_id', $id)->paginate(10);
        return view('prescription.view_for_user', ['prescriptions' => $prescriptions]);
    }

    public function remove($id)
    {
        Consultation_acte::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Acte supprimé avec succès');
    }

    public function remove_rapport($id)
    {
        Prescription_rapport::where('id', $id)->delete();

        return redirect()->back()->with('success', 'supprimé avec succès');
    }

    public function getBillingInfo(Request $request)
    {
        $consultationActId = $request->input('consultation_act_id');

        // Perform a query to get the sum of the paye column for the specified consultation_act_id
        $billingInfo = Billing_item::where('consultation_act_id', $consultationActId)
            ->selectRaw('SUM(payer) as totalPaye')
            ->first();

        return response()->json($billingInfo);
    }
    public function destroy_medicament($id)
    {
        $medicament = Prescription_medicament::find($id);

        if ($medicament) {
            $medicament->delete();
            return redirect()->back()->with('success', __('sentence.Medicament removed successfully'));
        } else {
            return redirect()->back()->with('error', __('sentence.Medicament not found'));
        }
    }


}
