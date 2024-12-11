<?php

namespace App\Http\Controllers;

use App\Antecedents;
use App\Billing_item;
use App\Consultation_acte;
use App\Rapport;
use App\Rapport_patient;
use App\Rapport_type;
use App\Seance;
use Illuminate\Http\Request;
use App\User;
use App\Patient;
use App\Prescription;
use App\Appointment;
use App\Billing;
use App\Document;
use App\History;
use App\Assurance;
use App\Croissance;
use App\Graph;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Hash;
use Redirect;
use Str;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function all()
    {

        $patients = User::where('role', '=', 'patient')->OrderBy('id', 'DESC')->paginate(10);
        return view('patient.all', ['patients' => $patients]);
    }




    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'before:today'],
            'gender' => ['required'],
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048',

        ]);

        $user = new User();
        $user->password = Hash::make('doctorino123');
        $user->email = $request->email;
        $user->name = $request->name;

        if ($request->hasFile('image')) {

            // We Get the image
            $file = $request->file('image');
            // We Add String to Image name
            $fileName = Str::random(15) . '-' . $file->getClientOriginalName();
            // We Tell him the uploads path
            $destinationPath = public_path() . '/uploads/';
            // We move the image to the destination path
            $file->move($destinationPath, $fileName);
            // Add fileName to database

            $user->image = $fileName;
        } else {
            $user->image = "";
        }


        $user->save();


        $patient = new Patient();

        $patient->user_id = $user->id;
        $patient->birthday = $request->birthday;
        $patient->phone = $request->phone;
        $patient->gender = $request->gender;
        $patient->blood = $request->blood;
        $patient->adress = $request->adress;
        $patient->weight = $request->weight;
        $patient->height = $request->height;
        $patient->nbenfant = $request->nbenfant;
        $patient->profession = $request->profession;
        $patient->assurance = $request->assurance;
        $patient->situation = $request->Situation;
        $patient->province = $request->Province;
        $patient->postal = $request->postal;
        $patient->ville = $request->Ville;
        $patient->cin = $request->cin;
        $patient->pays = $request->Pays;
        $patient->fixe = $request->fixe;
        $patient->numdossier = $request->numdossier;
        $patient->historiquemaladie =  $request->historiquemaladie;
        $patient->nameArabic = $request->nameArabic;

        $patient->save();

        return Redirect::route('patient.all')->with('success', __('sentence.Patient Created Successfully'));
    }





    public function edit($id)
    {

        $assurances = Assurance::all();
        $patient = User::findOrfail($id);
        Session::put('lastpatient', $patient->id);
        Session::put('namePatient', $patient->name);
        Session::put('imagePatient', $patient->image);
        Session::put('genderPation', $patient->patient->gender);

        return view('patient.edit', ['patient' => $patient, 'assurances' => $assurances]);
    }

    public function store_edit(Request $request)
    {

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            //	            'email' => [
            //			        'required', 'email', 'max:255',
            //			        Rule::unique('users')->ignore($request->user_id),
            //		    ],
            //            'birthday' => ['required','before:today'],
            //            'blood' => ['required',
            //            			Rule::in(['Unknown', 'A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
            //        	],
            'gender' => [
                'required'
            ],
            'weight' => ['numeric', 'nullable'],
            'height' => ['numeric', 'nullable'],
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);

        $user = User::find($request->user_id);

        $user->email = $request->email;
        $user->name = $request->name;

        if ($request->hasFile('image')) {

            // We Get the image
            $file = $request->file('image');
            // We Add String to Image name
            $fileName = Str::random(15) . '-' . $file->getClientOriginalName();
            // We Tell him the uploads path
            $destinationPath = public_path() . '/uploads/';
            // We move the image to the destination path
            $moved = $file->move($destinationPath, $fileName);
            // Add fileName to database

            $fullpath = public_path() . '/uploads/' . $user->image;

            if ($moved && !empty($user->image)) {
                unlink($fullpath);
            }

            $user->image = $fileName;
        }


        $user->update();


        $patient = Patient::where('user_id', '=', $request->user_id)
            ->update([
                'birthday'     => $request->birthday,
                'phone'      => $request->phone,
                'gender'     => $request->gender,
                'blood'      => $request->blood,
                'adress'     => $request->adress,
                'weight'     => $request->weight,
                'height'     => $request->height,
                'nbenfant'   => $request->nbenfant,
                'cin'        => $request->cin,
                'profession' => $request->profession,
                'assurance'  => $request->assurance,
                'situation'  => $request->Situation,
                'province'   => $request->Province,
                'postal'     => $request->postal,
                'ville'      => $request->Ville,
                'pays'       => $request->Pays,
                'fixe'       => $request->fixe,
                'assurance_id' => $request->assurance_id,
                'historiquemaladie' => $request->historiquemaladie,
                'nameArabic' => $request->nameArabic,
                'numdossier'=>$request->numdossier,
            ]);




        return redirect()->back()->with('success', __('sentence.Patient Updated Successfully'));
    }
    public function updateSelectedPatient(Request $request)
    {
        $selectedPatientId = $request->input('selected_patient_id');
        $request->session()->put('selected_patient_id', $selectedPatientId);
        return response()->json(['message' => 'Selected patient ID updated in the session.']);
    }

    public function create()
    { {
            Session::put('lastpatient', Null);
            Session::put('namePatient', Null);
            Session::put('imagePatient', Null);
            Session::put('genderPation', Null);
            $assurances = Assurance::all();

            return view('patient.create', compact('assurances'));
        }
        //    	return view('patient.create');
    }

    public function view($id)
    {
        $patient = User::findOrFail($id);
        Session::put('lastpatient', $patient->id);
        Session::put('namePatient', $patient->name);
        Session::put('imagePatient', $patient->image);
        Session::put('genderPation', $patient->patient->gender);



        $antecident = Antecedents::all();
        $prescriptions = Prescription::where('user_id', $id)->orderBy('id', 'Desc')->get();
        $appointments = Appointment::where('user_id', $id)->orderBy('id', 'Desc')->get();
        $documents = Document::where('user_id', $id)->orderBy('id', 'Desc')->get();
        $invoices = Billing::where('user_id', $id)->orderBy('id', 'Desc')->get();
        $invoicesFacture = Billing::where('user_id', $id)->where('facture',1)->orderBy('id', 'Desc')->get();
        $historys = History::where('user_id', $id)->orderBy('id', 'Desc')->get();
        $graphs = Graph::join('croissance', 'graph.id', '=', 'croissance.graph_id')
            ->select('graph.*', 'croissance.*')
            ->where('user_id', $id)
            ->get();
        $sumPayments = DB::table('billing_reglement')
            ->select('billing_id', DB::raw('SUM(payment) as total_payment'))
            ->groupBy('billing_id')
            ->get();

        $consultation = Consultation_acte::join('act', 'act.id', '=', 'consultation_acte.act_id')
            ->leftJoin('seances', function ($join) {
                $join->on('seances.consultation_act_id', '=', 'consultation_acte.id');
            })
            ->leftJoin(DB::raw('(SELECT MAX(numseances) AS max_numseance, consultation_act_id FROM seances GROUP BY consultation_act_id) as max_seances'), function ($join) {
                $join->on('seances.numseances', '=', 'max_seances.max_numseance');
                $join->on('seances.consultation_act_id', '=', 'max_seances.consultation_act_id');
            })
            ->where('user_id', $id)
            ->select('act.*', 'consultation_acte.*', 'seances.*', 'consultation_acte.created_at as act_created_at' ,'consultation_acte.id as consultation_id')
            ->whereNotNull('max_seances.max_numseance')
            ->get();

        $gabarits_patients = Rapport_patient::join('users', 'rapport_patient.user_id', '=', 'users.id')
            ->where('user_id',$id)
            ->select('rapport_patient.*', 'users.name as user_name', 'users.email as user_email')
            ->get();

        $rapport_types = Rapport::join('users', 'rapport.user_id', '=', 'users.id')
            ->where('user_id', $id)
            ->select('rapport.id', 'users.name',  'rapport_type_id', 'user_id','rapport.created_at')
            ->orderBy('rapport.id', 'desc') // Add this line to order by rapport.id in descending order
            ->get();

        // Count 'consultation_acte' records for the patient
        $enCoursCount = Consultation_acte::where('user_id', $id)
            ->where('status', 'En cours')
            ->count();

        $termineCount = Consultation_acte::where('user_id', $id)
            ->where('status', 'Termine')
            ->count();

        return view('patient.view', [
            'patient' => $patient,
            'prescriptions' => $prescriptions,
            'appointments' => $appointments,
            'invoices' => $invoices,
            'invoicesFacture'=> $invoicesFacture,
            'documents' => $documents,
            'historys' => $historys,
            'graphs' => $graphs,
            'enCoursCount' => $enCoursCount,
            'termineCount' => $termineCount,
            'consultation' =>$consultation,
            'antecident' =>$antecident,
            'sumPayments' => $sumPayments,
            'gabarits_patients'=>$gabarits_patients,
            'rapport_types'=>$rapport_types,
        ]);
    }


    //     public function search(Request $request) {
    //         $term = $request->term;
    //
    //         // Use a join to search in both "user" and "patient" tables
    //         $patients = User::join('patients', 'users.id', '=', 'patients.user_id')
    //             ->where('users.name', 'LIKE', '%' . $term . '%')
    ////             ->orWhere('patients.phone', 'LIKE', '%' . $term . '%')
    ////             ->orWhere('patients.cin', 'LIKE', '%' . $term . '%')
    //             ->orderBy('users.id', 'asc')
    //             ->paginate(10);
    //
    //         return view('patient.all', ['patients' => $patients]);
    //     }

    public function search(Request $request) {
        $term = $request->term;

        // Use a join to search in both "user" and "patient" tables
        $patients = Patient::join('users', 'users.id', '=', 'patients.user_id')
            ->where('users.role','=','patient')
            ->where('users.name', 'LIKE', '%' . $term . '%')
            ->orWhere('patients.phone', 'LIKE', '%' . $term . '%')
            ->orWhere('patients.cin', 'LIKE', '%' . $term . '%')
            ->orderBy('users.id', 'asc')
            ->paginate(10);


        return view('patient.search', ['patients' => $patients]);
    }

    public function showListpaiement($id)
    {
        $billing_act = Billing_item::join('consultation_acte', 'billing_items.consultation_act_id', '=', 'consultation_acte.id')
            ->where('billing_items.consultation_act_id', '=', $id)
            ->select('billing_items.*', 'consultation_acte.prix')
            ->get();

        $sumPayer = Billing_item::where('consultation_act_id', $id)->sum('payer');

        // Create an associative array with both variables
        $responseArray = [
            'billing_act' => $billing_act,
            'sumPayer' => $sumPayer,
        ];

        // Convert the array to JSON and send it as the response
        return response()->json($responseArray);
    }

    public function showListseance($id)
    {
        $seances = Seance::where('consultation_act_id','=',$id)->get();
        return response()->json($seances);
    }
    public function showListconsultation($id)
    {
        $dataconsultation = Consultation_acte::where('id','=',$id)->get();
        return response()->json($dataconsultation);
    }


    public function destroy($id){


        $patient = User::destroy($id);

        return Redirect::back()->with('success', 'Patient supprimé avec succès');
    }


}

