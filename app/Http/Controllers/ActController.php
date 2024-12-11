<?php

namespace App\Http\Controllers;

use App\analyse;
use App\Category_act;
use App\Sous_category_act;
use App\Act;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ActController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }



    public function create_category_act(){
        $category_act = Category_act::all();

        return view('act.create_category_act',['category_act' => $category_act]);
    }
    public function searchcat(Request $request){

        $term = $request->term;

        $category_act = Category_act::all();

        $sous_category_act = Sous_category_act::where('category_act_id','=',$term)->paginate(10);

        return view('act.searchcat',['category_act' => $category_act , 'sous_category_act' =>$sous_category_act]);
    }
    public function searchact(Request $request){

        $term = $request->term;
        $term1 = $request->term1;

        $category_act = Category_act::all();

        $sous_category_act = Sous_category_act::where('category_act_id','=',$term)->paginate(10);

        $actes = Act::where('category_act_id','=', $term1)
            ->where('sous_category_act_id', '=', $term)
            ->paginate(10);

        return view('act.searchact',['category_act' => $category_act , 'sous_category_act' =>$sous_category_act , 'actes'=>$actes]);
    }

    public function create_sous_category_act(){

        $category_act = Category_act::all();

        $sous_category_act = Sous_category_act::paginate(10);


        return view('act.create_sous_category_act',['category_act' => $category_act , 'sous_category_act' =>$sous_category_act]);

    }

    public function create_act(){
        $actes = Act::paginate(10);
        $sous_category_act = Sous_category_act::all();
        $category_act = Category_act::all();

        return view('act.create_act', ['sous_category_act' =>$sous_category_act , 'category_act' => $category_act ,'actes'=>$actes]);
    }

    public function getSousCategoryActs($categoryActId) {
        $sousCategoryActs = Sous_category_act::where('category_act_id', $categoryActId)->get();

        $options = [];
        foreach ($sousCategoryActs as $sousCategoryAct) {
            $options[$sousCategoryAct->id] = $sousCategoryAct->name;
        }

        return response()->json($options);
    }

    public function store_category(Request $request): \Illuminate\Http\RedirectResponse
    {

        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $category_act = new Category_act;
        $category_act->ref = $request->ref;
        $category_act->name = $request->name;
        $category_act->cout = $request->cout;


        $category_act->save();

        return Redirect::route('act.create_category_act')->with('success', 'Act créer avec succès');

    }

    public function store_sous_category_act(Request $request): \Illuminate\Http\RedirectResponse
    {

        $validatedData = $request->validate([
            'category_act_id'=>'required',
            'name' => 'required',
        ]);

        $sous_category_act = new Sous_category_act;

        $sous_category_act->category_act_id = $request->category_act_id;
        $sous_category_act->ref = $request->ref;
        $sous_category_act->name = $request->name;
        $sous_category_act->cout = $request->cout;


        $sous_category_act->save();

        return Redirect::route('act.create_sous_category_act')->with('success', 'Act créer avec succès');

    }

    public function store_act(Request $request): \Illuminate\Http\RedirectResponse
    {

        $validatedData = $request->validate([
            'sous_category_act_id'=>'required',
            'category_act_id'=>'required',
            'name' => 'required',
        ]);

        $act = new Act;

        $act->sous_category_act_id = $request->sous_category_act_id;
        $act->category_act_id = $request->category_act_id;
        $act->ref = $request->ref;
        $act->lettre = $request->lettre;
        $act->name = $request->name;
        $act->nums = $request->nums;
        $act->cout = $request->cout;


        $act->save();

        return Redirect::route('act.create_act')->with('success', 'Act créer avec succès');

    }



    public function edit($id){

        $acts = Act::find($id);

        return view('act.create_act',['acts' => $acts]);
    }


    public function editfamily($id){

        $acts = Category_act::find($id);
        return response()->json([
            'acts'=>$acts
        ]);

    }
    public function updatef(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $category_act = Category_act::find($request->acte_id);
        $category_act->ref = $request->ref;
        $category_act->name = $request->name;


        $category_act->update();

        return Redirect::route('act.create_category_act')->with('success', 'Act modifier avec succès');

    }
    public function updateg(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $category_act = Sous_category_act::find($request->id);
        $category_act->category_act_id = $request->category_act_id ;
        $category_act->ref = $request->ref;
        $category_act->name = $request->name;


        $category_act->update();

        return Redirect::route('act.create_sous_category_act')->with('success', 'Act modifier avec succès');

    }


    public function editcategory($id){

        $acts = Sous_category_act::find($id);
        return response()->json([
            'acts'=>$acts
        ]);

    }
    public function update(Request $request) {
        $act = Act::find($request->id);


        $act->ref = $request->ref;
        $act->lettre = $request->lettre;
        $act->name = $request->name;
        $act->cout = $request->cout;
        $act->nums = $request->nums;


        $act->update();

        return Redirect::route('act.create_act')->with('success', 'Act modifier avec succès');



    }




    public function destroy($id)
    {
        $acte = Act::find($id);

        $acte->delete();

        return redirect()->route('act.create_act')->with('success', 'Acte supprimé avec succès');
    }
    public function destroysouscategory($id)
    {
        $sousacte = Sous_category_act::find($id);

        $sousacte->delete();

        return redirect()->route('act.create_sous_category_act')->with('success', 'Catégorie supprimé avec succès');
    }
    public function destroyfamily($id)
    {
        $sousacte = Category_act::find($id);

        $sousacte->delete();

        return redirect()->route('act.create_category_act')->with('success', 'Famille acte supprimé avec succès');
    }

}
