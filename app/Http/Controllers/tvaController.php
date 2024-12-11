<?php

namespace App\Http\Controllers;

use App\tva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class tvaController extends Controller
{
    public function all()
    {
        $tva = tva::OrderBy('id', 'DESC')->paginate(10);
        return view('tva.all', ['tva' => $tva]);
    }

    public function create()
    {
        return view('tva.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'value' => ['required', 'numeric'],
        ]);

        $tva = new tva();
        $tva->name = $request->name;
        $tva->value = $request->value;
        $tva->save();

        return Redirect::route('tva.all')->with('success', 'TVA ajouté avec succès');
    }

    public function edit($id)
    {
        $tva = tva::findOrfail($id);
        return view('tva.edit', ['tva' => $tva]);
    }


    public function store_edit(
        Request $request

    ) {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'value' => ['required', 'numeric'],
        ]);

        $tva = tva::findOrfail($request->myid);
        $tva->name = $request->name;
        $tva->value = $request->value;
        $tva->update();

        return Redirect::route('tva.all')->with('success', 'TVA modifié avec succès');
    }




    public function delete($id)
    {
        $tva = tva::findOrfail($id);
        $tva->delete();
        return Redirect::route('tva.all')->with('success', 'TVA supprimé avec succès');
    }
}
