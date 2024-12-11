<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Antecedents;
use Illuminate\Support\Facades\Redirect;

class AnticedentsController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }



    public function create(){
        return view('anticedents.create');

    }
    public function view(){
        $antecident = Antecedents::all();
        return response()->json($antecident);

    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'antecedents_name' => 'required',
        ]);

        $antecedents = Antecedents::updateOrCreate(
            ['antecedents_name' => $request->antecedents_name]
        );

        $anticedents = Antecedents::all();

        return view('anticedents.all',['anticedents' => $anticedents]);
    }


    public function all(){
        $anticedents = Antecedents::all();

        return view('anticedents.all',['anticedents' => $anticedents]);
    }


    public function edit($id){
        $antecedents = Antecedents::find($id);
        return view('anticedents.edit',['antecedents' => $antecedents]);
    }

    public function store_edit(Request $request) {
        $validatedData = $request->validate([
            'antecedents_name' => 'required',
        ]);
        $antecedents = Antecedents::find($request->id);
        if ($antecedents) {
            $antecedents->update([
                'antecedents_name' => $request->antecedents_name,
            ]);
            return redirect()->route('anticedents.all')->with('success', 'Modifié avec succès');
        } else {
            return redirect()->route('anticedents.all')->with('error', 'Antecedents non trouvée');
        }
    }

    public function destroy($id){
        Antecedents::destroy($id);
        return Redirect::route('anticedents.all')->with('success', 'supprimée avec succès');

    }
}
