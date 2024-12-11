<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Assurance;
use Redirect;
class AssuranceController extends Controller{


	public function __construct(){
        $this->middleware('auth');
    }


    //
    public function create(){
    	return view('assurance.create');

    }

    public function store(Request $request){

    	$validatedData = $request->validate([
        	'assurance_name' => 'required',
    	]);

    	$assurance = Assurance::updateOrCreate(
		    ['assurance_name' => $request->assurance_name, 'generic_name' => $request->generic_name],
		    ['note' => $request->note]
		);

    	return Redirect::route('assurance.all')->with('success', 'créer success');
    }

    public function all(){
    	$assurance = Assurance::all();

    	return view('assurance.all',['assurance' => $assurance]);
    }


    public function edit($id){
        $assurance = Assurance::find($id);
        return view('assurance.edit',['assurance' => $assurance]);
    }

    public function store_edit(Request $request) {

        $validatedData = $request->validate([
            'assurance_name' => 'required',
        ]);

        $assurance = Assurance::find($request->assurance_id);

        if ($assurance) {
            // Update the existing Assurance's properties
            $assurance->update([
                'assurance_name' => $request->assurance_name,
                'generic_name' => $request->generic_name,
                'note' => $request->note,
            ]);

            return redirect()->route('assurance.all')->with('success', 'Modifié avec succès');
        } else {
            return redirect()->route('assurance.all')->with('error', 'Assurance non trouvée');
        }
    }

        public function destroy($id){

        Assurance::destroy($id);
        return Redirect::route('assurance.all')->with('success', 'supprimée avec succès');

    }
}
