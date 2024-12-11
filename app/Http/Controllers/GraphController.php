<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\analyse;
use Illuminate\Http\Request;
use App\Drug;
use App\User;
use App\Patient;
use App\Prescription;
use App\Prescription_drug;
use App\Prescription_test;
use App\Test;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use App\Graph;
use App\Croissance;
use Illuminate\Support\Facades\Session;

class GraphController extends Controller
{
    public function getPatientImage(Request $request): \Illuminate\Http\JsonResponse
    {
        $patientId = $request->input('patient_id');

        // Assuming your 'graph' table has a 'user_id' column for patient ID
        $graph = Graph::where('user_id', $patientId)->first();

        if ($graph && $graph->image) {
            return response()->json(['image' => $graph->image]);
        } else {
            return response()->json(['image' => null]);
        }
    }

    public function create()
    {
        $lastpatient = session('lastpatient');
        $patients = User::where('role', 'patient')->get();
        $graphs = Graph::all();

        $types = Graph::select('type')->distinct()->pluck('type');
        $labels = [];
        $prescriptions = Prescription::all();
        $croissances = Croissance::join('users', 'croissance.user_id', '=', 'users.id')
            ->join('graph', 'croissance.graph_id', '=', 'graph.id')
            ->select('users.name', 'graph.label', 'graph.type')
            ->distinct()
            ->get();
        $gras = Graph::join('croissance', 'graph.id', '=', 'croissance.graph_id')
            ->where('user_id', $lastpatient)
            ->distinct()
            ->select(['graph.image', 'graph.label'])
            ->get();
        $statistics = Croissance::select('x', 'y')
            ->where('user_id', $lastpatient)
            ->get();

        return view('graph.create', ['graphs' => $graphs, 'patients' => $patients, 'prescriptions' => $prescriptions, 'croissances' => $croissances, "gras" => $gras, 'statistics' => $statistics, 'types' => $types, 'labels' => $labels]);
    }
    public function getLabels(Request $request)
    {
        $selectedType = $request->input('type');
        $labels = Graph::where('type', $selectedType)->pluck('label', 'id'); // Keep this line for IDs and labels

        $labelsArray = [];
        foreach ($labels as $id => $label) {
            $labelsArray[] = ['id' => $id, 'label' => $label];
        }

        return response()->json($labelsArray);
    }


    // Store the graph entry in the database
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'x' => 'required|numeric',
            'y' => 'required|numeric',
        ]);
        $patient = User::findOrfail($request->user_id);
        Session::put('lastpatient', $patient->id);
        Session::put('namePatient', $patient->name);
        Session::put('imagePatient', $patient->image);
        Session::put('genderPation', $patient->gender);

        $point = new Croissance();
        $point->fill($request->all());
        $point->save();
        return redirect()->route('graph.all')->with('success', 'Entrée de graphique créée avec succès.');
    }

    //    public function getGraphData(Request $request)
    //    {
    //        $user_id = $request->input('user_id');
    //        $graphData = [];
    //        $graphData['graph_images'] = Graph::where('user_id', 13)->pluck('image')->toArray();
    //        $graphData['graph_points'] = Croissance::where('user_id', 13)
    //            ->whereNotNull('x')
    //            ->whereNotNull('y')
    //            ->get(['id', 'x', 'y']);
    //        return response()->json($graphData);
    //    }

    // Display all graph entries
    public function all()
    {
        $lastpatient = session('lastpatient');
        $patients = User::where('role', 'patient')->get();
        $graphs = Graph::all();
        $prescriptions = Prescription::all();



        // Modify the $croissances query based on the $lastpatient value
        $croissances = Croissance::join('users', 'croissance.user_id', '=', 'users.id')
            ->join('graph', 'croissance.graph_id', '=', 'graph.id')
            ->when($lastpatient, function ($query) use ($lastpatient) {
                return $query->where('user_id', $lastpatient);
            })
            ->select('users.name', 'graph.label', 'graph.type', 'users.id', 'graph_id', 'user_id')
            ->distinct()
            ->get();

        $gras = Graph::join('croissance', 'graph.id', '=', 'croissance.graph_id')
            ->when($lastpatient, function ($query) use ($lastpatient) {
                return $query->where('user_id', $lastpatient);
            })
            ->select(['graph.image', 'graph.label'])
            ->distinct()
            ->get();

        return view('graph.all', [
            'graphs' => $graphs,
            'patients' => $patients,
            'prescriptions' => $prescriptions,
            'croissances' => $croissances,
            'gras' => $gras,
        ]);
    }


    // View a specific graph entry
    public function view($id)
    {
        $lastpatient = session('lastpatient');

        $graph_id = request()->query('graph_id');
        $label = request()->query('label');
        $patient = User::find($id);
        $graphs = Graph::all();
        $prescriptions = Prescription::all();
        $croissances = Croissance::join('users', 'croissance.user_id', '=', 'users.id')
            ->join('graph', 'croissance.graph_id', '=', 'graph.id')
            ->when($lastpatient, function ($query) use ($lastpatient) {
                return $query->where('user_id', $lastpatient);
            })
            ->select('users.name', 'graph.label', 'graph.type', 'users.id', 'graph_id', 'user_id')
            ->distinct()
            ->get();
        $gras = Graph::join('croissance', 'graph.id', '=', 'croissance.graph_id')
            ->where('user_id', $id)
            ->where('graph.label', $label) // Add this condition to filter by label
            ->select(['graph.image', 'graph.label'])
            ->distinct()
            ->get();
        $statistics = Croissance::select('x', 'y')
            ->where('user_id', $id)
            ->where('graph_id', $graph_id)
            ->get();

        return view('graph.view', ['graphs' => $graphs, 'patient' => $patient, 'prescriptions' => $prescriptions, 'croissances' => $croissances, "gras" => $gras, 'statistics' => $statistics]);
    }


    public function destroy($id)
    {
        $graph_id = request()->query('graph_id');
        $user_id = request()->query('user_id');
        $graph = Croissance::where('user_id', $user_id)
            ->where('graph_id', $graph_id);
        $graph->delete();

        return redirect()->route('graph.all')->with('success', 'Graph entry deleted successfully.');
    }

    public function view_for_user($id)
    {

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('graph.all')->with('error', 'User not found.');
        }

        $graphs = $user->graphs;

        return view('graph.view_for_user', compact('user', 'graphs'));
    }

    public function edit($id)
    {
        $graph_id = request()->query('graph_id');
        $label = request()->query('label');
        $patient = User::find($id);
        $graphs = Graph::all();
        $prescriptions = Prescription::all();
        $croissances = Croissance::join('users', 'croissance.user_id', '=', 'users.id')
            ->join('graph', 'croissance.graph_id', '=', 'graph.id')
            ->select('users.name', 'graph.label', 'graph.type', 'croissance.graph_id')
            ->distinct()
            ->get();
        $gras = Graph::join('croissance', 'graph.id', '=', 'croissance.graph_id')
            ->where('user_id', $id)
            ->where('graph.label', $label)
            ->select(['graph.image', 'graph.label'])
            ->distinct()
            ->get();
        $statistics = Croissance::select('x', 'y', 'graph_id', 'id')
            ->where('user_id', $id)
            ->where('graph_id', $graph_id)
            //            ->select('graph_id')
            ->get();


        return view('graph.edit', ['graphs' => $graphs, 'patient' => $patient, 'prescriptions' => $prescriptions, 'croissances' => $croissances, "gras" => $gras, 'statistics' => $statistics]);
    }
    public function savePoint(Request $request)
    {
        $point = new Croissance();
        $point->fill($request->all());
        $point->save();
    }

    public function deletePoint(Request $request)
    {

        $point = Croissance::find($request->input('pointId'));

        if (!$point) {
            return response()->json(['message' => 'Pointe introuvable.'], 404);
        }
        $point->delete();
        return response()->json(['message' => 'Point supprimé avec succès']);
    }

    public function update(Request $request)
    {

        if (isset($request->id)) {
            Croissance::where('id', $request->id)
                ->update([
                    'user_id' => $request->user_id,
                    'x' => $request->x,
                    'y' => $request->y,
                    'graph_id' => $request->graph_id,
                ]);
        } else {
            $croissance = new Croissance;
            $croissance->x = $request->x;
            $croissance->y = $request->y;
            $croissance->user_id = $request->user_id;
            $croissance->graph_id = $request->graph_id;
            $croissance->save();
        }
        return redirect()->route('graph.all')->with('success', 'Les informations sur le patient ont été mises à jour avec succès');
    }
    public function search(Request $request)
    {

        $term = $request->term;
        //         =  Graph::join('croissance', 'graph.id', '=', 'croissance.graph_id')
        //            ->where('user_id', $term)
        //            ->select()
        //            ->distinct()
        //            ->get();

        $patients = Croissance::where('user_id', $term)
            ->distinct()
            ->pluck('graph_id');

        //        $patients = Croissance::where('user_id', '=', 'users.id')
        //            ->select('users.name', 'graph.label', 'graph.type')
        //            ->where('users.name','LIKE','%' . $term . '%')
        //            ->distinct()
        //            ->get();

        $patients = User::where('role', 'patient')->get();
        $graphs = Graph::all();
        $prescriptions = Prescription::all();
        $croissances = Croissance::join('users', 'croissance.user_id', '=', 'users.id')
            ->join('graph', 'croissance.graph_id', '=', 'graph.id')
            ->select('users.name', 'graph.label', 'graph.type', 'users.id', 'graph_id')
            ->distinct()
            ->get();
        $gras = Graph::join('croissance', 'graph.id', '=', 'croissance.graph_id')
            ->where('user_id', 13)
            ->select(['graph.image', 'graph.label'])
            ->distinct()
            ->get();


        return view('graph.all', ['graphs' => $graphs, 'patients' => $patients, 'prescriptions' => $prescriptions, 'croissances' => $croissances, "gras" => $gras]);
    }
}
