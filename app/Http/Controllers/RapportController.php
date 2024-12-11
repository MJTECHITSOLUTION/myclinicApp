<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\User;
use App\Rapport;
use App\Rapport_type;
use App\Prescription;
use App\Setting;
use App\Variable;
use App\Gabarit;
use App\Rapport_patient;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class RapportController extends Controller
{


    public function create()
    {
        $lastpatient = session('lastpatient');
        $patients = User::where('role', 'patient')->get();
        $settings = Setting::where('id', 23)->get('option_value');

        $prescriptions = Prescription::all();
        $labels = Rapport_type::all();

        return view('rapport.create', ['patients' => $patients, 'prescriptions' => $prescriptions, 'labels' => $labels, 'settings' => $settings]);
    }

    public function gabarit_view($name)
    {
        $lastpatient = session('lastpatient');
        $patients = User::where('role', 'patient')->get();
        $settings = Setting::where('id', 23)->get('option_value');
        $gabarits = Gabarit::all();


        $prescriptions = Prescription::all();
        $labels = Rapport_type::all();

        return view('gabarit.gabarit_view', ['patients' => $patients, 'prescriptions' => $prescriptions, 'labels' => $labels, 'settings' => $settings , 'gabarits'=>$gabarits , 'name'=>$name]);
    }

    public function create_gabarit()
    {
        $lastpatient = session('lastpatient');
        $varibles = Variable::all();
        return view('gabarit.gabarit', ['varibles'=>$varibles ]);
    }

    public function store_gabarit(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $rapport = new Gabarit();
        $rapport->name = $request->name;
        $rapport->text = $request->text;




        $rapport->save();

        return redirect('gabarit/gabarit_all')->with('success', 'Entrée de gabarit créée avec succès.');
    }
    public function store_template(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
        ]);

        $rapport = new Rapport_patient();
        $rapport->user_id = $request->user_id;
        $rapport->text = $request->text;
        $rapport->template_name = $request->template_name;

        $rapport->save();

        return redirect('gabarit/all')->with('success', 'Entrée de gabarit créée avec succès.');
    }

    public function gabarit_all()
    {
        $lastpatient = session('lastpatient');
        $patients = User::where('role', 'patient')->get();
        $rapports = Rapport::all();
        $prescriptions = Prescription::all();

        $gabarits = Gabarit::all();

        return view('gabarit.gabarit_all', [
            'patients' => $patients,
            'prescriptions' => $prescriptions,
            'gabarits' => $gabarits,
        ]);
    }

    public function all_gabarit_patient()
    {
        $lastpatient = session('lastpatient');
        $patients = User::where('role', 'patient')->get();
        $rapports = Rapport::all();
        $prescriptions = Prescription::all();

        $gabarits_patients = Rapport_patient::join('users', 'rapport_patient.user_id', '=', 'users.id')
            ->when($lastpatient, function ($query) use ($lastpatient) {
                return $query->where('user_id', $lastpatient);
            })
            ->select('rapport_patient.*', 'users.name as user_name', 'users.email as user_email')
            ->orderBy('rapport_patient.created_at', 'desc')  // Add this line for descending order
            ->get();

        $rapport_types = Rapport::join('users', 'rapport.user_id', '=', 'users.id')
            ->join('rapport_type', 'rapport.rapport_type_id', '=', 'rapport_type.id')
            ->when($lastpatient, function ($query) use ($lastpatient) {
                return $query->where('user_id', $lastpatient);
            })
            ->select('rapport.id', 'users.name', 'rapport_type.label', 'rapport_type_id', 'user_id','rapport.created_at')
            ->orderBy('rapport.id', 'desc') // Add this line to order by rapport.id in descending order
            ->get();

        $gabarits = Gabarit::all();

        return view('gabarit.all', [
            'patients' => $patients,
            'prescriptions' => $prescriptions,
            'gabarits' => $gabarits,
            'gabarits_patients'=>$gabarits_patients,
            'rapport_types'=>$rapport_types,
        ]);
    }

    public function view_patient($id)
    {
        $lastpatient = session('lastpatient');
        $patients = User::where('role', 'patient')->get();
        $rapports = Rapport::all();
        $prescriptions = Prescription::all();

        $gabarits_patients = Rapport_patient::join('users', 'rapport_patient.user_id', '=', 'users.id')
            ->select('rapport_patient.*', 'users.name as user_name', 'users.email as user_email')
            ->where('rapport_patient.id', '=', $id)
            ->get();


        $gabarits = Gabarit::all();

        return view('gabarit.view', [
            'patients' => $patients,
            'prescriptions' => $prescriptions,
            'gabarits' => $gabarits,
            'gabarits_patients'=>$gabarits_patients,
        ]);
    }
    public function gabarit_edit($id)
    {
        $gabarit = Gabarit::select('text')->where('id' ,$id)->first();
        $gabarit_titre = Gabarit::select('name')->where('id' ,$id)->first();


        $varibles = Variable::all();

        return view('gabarit.gabarit_edit', ['gabarit' => $gabarit, 'varibles' => $varibles,'gabarit_titre'=>$gabarit_titre ,'id'=>$id]);
    }
    public function gabarit_update(Request $request)
    {

        Gabarit::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'text' => $request->text,
            ]);

        return redirect()->route('gabarit.gabarit_all')->with('success', 'Les informations sur le patient ont été mises à jour avec succès');
    }
    public function patient_update(Request $request)
    {

        Rapport_patient::where('id', $request->id)
            ->update([
                'text' => $request->text,
            ]);

        return redirect()->route('gabarit.all')->with('success', 'Les informations sur le patient ont été mises à jour avec succès');
    }
    public function patient_edit($id)
    {

        $lastpatient = session('lastpatient');
        $patients = User::where('role', 'patient')->get();
        $rapports = Rapport::all();
        $prescriptions = Prescription::all();

        $gabarits_patients = Rapport_patient::join('users', 'rapport_patient.user_id', '=', 'users.id')
            ->select('rapport_patient.*', 'users.name as user_name', 'users.email as user_email')
            ->where('rapport_patient.id', '=', $id)
            ->get();



        $gabarits = Gabarit::all();



        return view('gabarit.edit', [
            'patients' => $patients,
            'prescriptions' => $prescriptions,
            'gabarits' => $gabarits,
            'gabarits_patients'=>$gabarits_patients,
        ]);
    }




    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
        ]);

        $patient = User::findOrfail($request->input('user_id'));
        Session::put('lastpatient', $patient->id);
        Session::put('namePatient', $patient->name);
        Session::put('imagePatient', $patient->image);
        Session::put('genderPation', $patient->patient->gender);


        $rapport = new Rapport();
        $rapport->user_id = $request->input('user_id');
        $rapport->rapport_type_id = $request->input('rapport_type_id');
        $rapport->date_debut = $request->input('date_debut');
        $rapport->date_fin = $request->input('date_fin');
        $rapport->tuteur = $request->input('tuteur');
        $rapport->nb_jour = $request->input('nb_jour');
        $rapport->nb_jour1 = $request->input('nb_jour1');
        $rapport->child = $request->input('child');
        $rapport->libre = $request->input('libre');
        $rapport->name_medcien = $request->input('name_medcien');
        $rapport->verifie = $request->input('verifie');
        $rapport->patient_mariage = $request->input('patient_mariage');
        $rapport->patient_cin = $request->input('patient_cin');
        $rapport->conclusion = $request->input('conclusion');


        $labels = Rapport_type::where('id', $rapport->rapport_type_id)->first();
        $label = $labels->label;



        $rapport->save();

        return redirect('rapport/view/' . $rapport->id . '?label=' . $label . '&user_id=' . $rapport->user_id)->with('success', 'Entrée de rapport créée avec succès.');
    }

    // Display all graph entries
    public function all()
    {
        $lastpatient = session('lastpatient');
        $patients = User::where('role', 'patient')->get();
        $rapports = Rapport::all();
        $prescriptions = Prescription::all();



        $rapport_types = Rapport::join('users', 'rapport.user_id', '=', 'users.id')
            ->join('rapport_type', 'rapport.rapport_type_id', '=', 'rapport_type.id')
            ->when($lastpatient, function ($query) use ($lastpatient) {
                return $query->where('user_id', $lastpatient);
            })
            ->select('rapport.id', 'users.name', 'rapport_type.label', 'rapport_type_id', 'user_id')
            ->orderBy('rapport.id', 'desc') // Add this line to order by rapport.id in descending order
            ->get();



        return view('rapport.all', [
            'patients' => $patients,
            'prescriptions' => $prescriptions,
            'rapport_types' => $rapport_types,
        ]);
    }


    // View a specific graph entry
    public function view($id)
    {
        $settings = Setting::where('id', 23)->get('option_value');
        $label = request()->query('label');
        $patient = User::find($id);
        $rapports = Rapport::select('nb_jour', 'user_id', 'rapport_type_id', 'date_debut', 'date_fin', 'tuteur', 'child', 'libre', 'nb_jour1', 'name_medcien', 'verifie', 'patient_mariage', 'patient_cin', 'conclusion', 'created_at')
            ->where('id', $id)
            ->get();

        if ($rapports) {
            // Access all columns of the $rapport object
            $allColumns = $rapports->toArray(); // This returns an associative array with all columns
        } else {
            // Handle the case where no record with the given $id was found.
        }



        return view('rapport.view', ['label' => $label, 'rapports' => $rapports, 'settings' => $settings, 'patient' => $patient,]);
    }


    public function destroy($id)
    {
        $rapport_type_id = request()->query('id');
        $user_id = request()->query('user_id');
        $rapport = Rapport::where('id', $id);
        $rapport->delete();

        return redirect()->route('rapport.all')->with('success', "L'entrée de rapport a été supprimée avec succès.");
    }
    public function gabarit_destroy($id)
    {

        $gabarit = Gabarit::where('id', $id);
        $gabarit->delete();

        return redirect()->route('gabarit.gabarit_all')->with('success', "L'entrée de rapport a été supprimée avec succès.");
    }
    public function patient_destroy($id)
    {

        $gabarit = Rapport_patient::where('id', $id);
        $gabarit->delete();

        return redirect()->route('gabarit.all')->with('success', "L'entrée de rapport a été supprimée avec succès.");
    }

    public function view_for_user($id)
    {

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('rapport.all')->with('error', 'Utilisateur non trouvé.');
        }

        $graphs = $user->graphs;

        return view('rapport.view_for_user', compact('user', 'graphs'));
    }

    public function edit($id)
    {
        $settings = Setting::where('id', 23)->get('option_value');
        $label = request()->query('label');
        $user_id = request()->query('user_id');
        $patient = User::find($user_id);
        $rapports = Rapport::select('nb_jour', 'user_id', 'rapport_type_id', 'date_debut', 'date_fin', 'tuteur', 'child', 'libre', 'id', 'nb_jour1', 'name_medcien', 'verifie', 'patient_mariage', 'patient_cin', 'conclusion')
            ->where('id', $id)
            ->get();
        if ($rapports) {
            // Access all columns of the $rapport object
            $allColumns = $rapports->toArray(); // This returns an associative array with all columns
        } else {
            // Handle the case where no record with the given $id was found.
        }

        return view('rapport.edit', ['label' => $label, 'rapports' => $rapports, 'settings' => $settings, 'patient' => $patient]);
    }



    public function update(Request $request)
    {

        if (isset($request->id)) {
            Rapport::where('id', $request->id)
                ->update([
                    'nb_jour' => $request->nb_jour,
                    'user_id' => $request->user_id,
                    'date_debut' => $request->date_debut,
                    'date_fin' => $request->date_fin,
                    'tuteur' => $request->tuteur,
                    'child' => $request->child,
                    'libre' => $request->libre,
                    'nb_jour1' => $request->nb_jour1,
                    'name_medcien' => $request->name_medcien,
                    'verifie' => $request->verifie,
                    'patient_mariage' => $request->patient_mariage,
                    'patient_cin' => $request->patient_cin,
                    'conclusion' => $request->conclusion,


                ]);
        } else {
        }
        return redirect()->route('rapport.all')->with('success', 'Les informations sur le patient ont été mises à jour avec succès');
    }

}
