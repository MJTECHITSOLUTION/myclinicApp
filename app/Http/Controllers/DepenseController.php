<?php

namespace App\Http\Controllers;

use App\Depense;
use App\TypeDepose;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    public function all()
    {
        $depenses = Depense::OrderBy('id', 'DESC')->paginate(10);
        return view('depense.all', compact('depenses'));
    }

    public function create()
    {
        $type_depenses =  TypeDepose::all();



        return view('depense.create', compact('type_depenses'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'type_depenses' => 'required',
            'monton' => 'required',
        ]);

        $depanse = new Depense();
        $depanse->label = $request->label;
        $depanse->type_depenses = $request->type_depenses;
        $depanse->monton = $request->monton;
        $depanse->created_by = $request->created_by;
        $depanse->reference = $request->reference;
        $depanse->note = $request->note;

        $depanse->save();

        return redirect()->route('depense.all')
            ->with('success', 'Depense ajouter avec success .');
    }

    public function edit($id)
    {
        $depense = Depense::findOrfail($id);
        $type_depenses =  TypeDepose::all();
        return view('depense.edit', ['depense' => $depense, 'type_depenses' => $type_depenses]);
    }

    public function store_edit(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'type_depenses' => 'required',
            'monton' => 'required',


        ]);



        $depanse = Depense::findOrfail($request->myid);
        $depanse->label = $request->label;
        $depanse->type_depenses = $request->type_depenses;
        $depanse->monton = $request->monton;
        $depanse->created_by = $request->created_by;
        $depanse->reference = $request->reference;

        $depanse->note = $request->note;

        $depanse->save();

        return redirect()->route('depense.all')
            ->with('success', 'Depense modifier avec success .');
    }

    public function destroy($id)
    {
        $depense = Depense::findOrfail($id);
        $depense->delete();
        return redirect()->route('depense.index')
            ->with('success', 'Depense supprimer avec success .');
    }
}
