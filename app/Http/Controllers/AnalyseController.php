<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Analyse;

class AnalyseController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }


    public function create(){
         $tests = test::all();
        return view('analyse.create',['tests' => $tests]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {

    		$validatedData = $request->validate([
	        	'analyse_name' => 'required',
                'test_id' => 'required',
	    	]);

    	$analyse = new Analyse;

        $analyse->analyse_name = $request->analyse_name;
        $analyse->test_id = $request->test_id;

        $analyse->save();

        return Redirect::route('analyse.all')->with('success', __('sentence.analyse Created Successfully'));

    }

    public function all(){
        $analyses = Analyse::all();

        foreach ($analyses as $analyse) {
            $test = Test::find($analyse->test_id);
            $analyse->test_name = $test ? $test->test_name : 'N/A';
        }

        return view('analyse.all', ['analyses' => $analyses]);
    }

    public function edit($id){
        $analyse = Analyse::find($id);
        $tests = Test::all();
        return view('analyse.edit',['analyse' => $analyse , 'tests' => $tests]);
    }

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'analyse_name' => 'required',
        ]);

        $analyse = Analyse::find($request->analyse_id);

        if (!$analyse) {
            return Redirect::route('analyse.all')->with('error', __('sentence.Analyse not found'));
        }
        $analyse->analyse_name = $request->analyse_name;
        $analyse->test_id = 14;
        $analyse->save();
        return Redirect::route('analyse.all')->with('success', __('sentence.Analyse Edited Successfully'));
    }


    public function destroy($id){

    	Analyse::destroy($id);
        return Redirect::route('analyse.all')->with('success', __('sentence.Analyse Deleted Successfully'));

    }
    public function search(Request $request){

        $term = $request->term;

        $analyses = Analyse::where('analyse_name','LIKE','%' . $term . '%')->OrderBy('id','asc')->paginate(10);


        return view('analyse.all', ['analyses' => $analyses]);
    }

}
