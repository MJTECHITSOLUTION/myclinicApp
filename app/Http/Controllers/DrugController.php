<?php

namespace App\Http\Controllers;

use App\Drugs_cat;
use App\Posologie;
use Illuminate\Http\Request;
use App\Drug;
use Redirect;
class DrugController extends Controller{


	public function __construct(){
        $this->middleware('auth');
    }


    //
    public function create(){
        $drugs_cat = Drugs_cat::all();
    	return view('drug.create', ['drugs_cat' => $drugs_cat]);

    }

    public function store(Request $request){

    	$validatedData = $request->validate([
        	'trade_name' => 'required',
    	]);
        $drug = new Drug();
        $drug->trade_name = $request->trade_name;
        $drug->generic_name = $request->generic_name;
        $drug->categorie_id = $request->drugs_cat;
        $drug->note = $request->note;
        $drug->save();

//    	$drug = Drug::updateOrCreate(
//		    ['trade_name' => $request->trade_name, 'generic_name' => $request->generic_name , 'categorie_id' => $request->drugs_cat],
//		    ['note' => $request->note]
//		);
        if ($request->note){
            $posologie = new Posologie();
            $posologie->posologie = $drug->note;
            $posologie->drug_id = $drug->id;
            $posologie->save();
        }


    	return Redirect::route('drug.all')->with('success', __('sentence.Drug added Successfully'));
    }

    public function all()
    {
        $drugs = Drug::paginate(100); // 10 items per page

        return view('drug.all', ['drugs' => $drugs]);
    }


    public function edit($id){
        $drug = Drug::find($id);
        $drugs_cat = Drugs_cat::all();

        $cat = Drugs_cat::where('id', $drug->category_id)->first();
        if ($cat == null){
            $cat = 0;
        }
        return view('drug.edit',['drug' => $drug , 'drugs_cat' => $drugs_cat, 'cat' => $cat]);
    }

    public function store_edit(Request $request){

        $validatedData = $request->validate([
            'trade_name' => 'required',
        ]);

        $drug = Drug::find($request->drug_id);

        $drug->category_id = $request->drugs_cat;
        $drug->trade_name = $request->trade_name;
        $drug->generic_name = $request->generic_name;
        $drug->note = $request->note;

        $drug->save();

        if ($request->note){
            $posologie =  Posologie::find($request->posologie);
            $posologie->posologie = $request->note;
            $posologie->save();
        }

        return Redirect::route('drug.all')->with('success', __('sentence.Drug Edited Successfully'));

    }
    public function search(Request $request){
        $term = $request->term;
        $drugs = Drug::where('trade_name','LIKE','%' . $term . '%')->OrderBy('id','DESC')->paginate(200);
        return view('drug.all', ['drugs' => $drugs]);
    }

        public function destroy($id){

        Drug::destroy($id);
        return Redirect::route('drug.all')->with('success', __('sentence.Drug Deleted Successfully'));

    }

    public function add_cat(Request $request)
    {
        $category = new Drugs_cat();
        $category->categorie = $request->categoryName;
        $category->save();
        return response()->json(['id' => $category->id, 'name' => $category->categorie]);
    }

    public function edit_cat(Request $request)
    {
        $category = Drugs_cat::find($request->id);
        $category->categorie = $request->name;
        $category->save();
        return response()->json(['success' => true]);
    }

    public function delete_cat(Request $request)
    {
        $category = Drugs_cat::find($request->id);
        $category->delete();
        return response()->json(['success' => true]);
    }


}
