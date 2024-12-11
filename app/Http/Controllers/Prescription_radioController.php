<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prescription_radio;
use App\Radio;
use App\User;
use Illuminate\Support\Facades\Redirect;

class Prescription_radioController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    public function create(){
        $radios = Radio::all();
        return view('radio.create',['radios' => $radios]);
    }
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {

        $validatedData = $request->validate([
            'radio_name' => 'required',
        ]);

        $radio = new Radio();

        $radio->radio_name = $request->radio_name;

        $radio->save();

        return Redirect::route('radio.all')->with('success', __('Radio créé avec succès'));

    }
    public function all(){
        $radios = Radio::all();

        return view('radio.all', ['radios' => $radios]);
    }
    public function edit($id){
        $radio = Radio::find($id);
        return view('radio.edit',['radio' => $radio]);
    }
    public function store_edit(Request $request)
    {

        $radio = Radio::find($request->radio_id);

        if (!$radio) {
            return Redirect::route('radio.all')->with('error', __('Radio pas trouvé'));
        }
        $radio->radio_name = $request->radio_name;
        $radio->save();
        return Redirect::route('radio.all')->with('success', __('Radio Modifié avec succès'));
    }
    public function destroy($id){

        Radio::destroy($id);
        return Redirect::route('radio.all')->with('success', __('Radio Supprimé avec succès'));

    }
    public function search(Request $request){

        $term = $request->term;

        $radios = radio::where('radio_name','LIKE','%' . $term . '%')->OrderBy('id','asc')->paginate(10);


        return view('radio.all', ['radios' => $radios]);
    }

}
