<?php

namespace App\Http\Controllers;

use App\TypeDepose;
use Illuminate\Http\Request;

class TypeDeposeController extends Controller
{
    public  function all()
    {
        $type_deposes = TypeDepose::OrderBy('id', 'DESC')->paginate(10);
        return view('type_depose.all', compact('type_deposes'));
    }

    public  function create()
    {
        return view('type_depose.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $type_depose = new TypeDepose();
        $type_depose->name = $request->name;
        $type_depose->note = $request->note;

        $type_depose->save();

        return redirect()->route('type_depose.all')
            ->with('success', 'Type de depose ajouter avec success .');
    }

    public function edit($id)
    {
        $type_depose = TypeDepose::findOrfail($id);
        return view('type_depose.edit', ['type_depose' => $type_depose]);
    }

    public function store_edit(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $type_depose = TypeDepose::findOrfail($request->id);
        $type_depose->name = $request->name;
        $type_depose->note = $request->note;

        $type_depose->save();

        return redirect()->route('type_depose.all')
            ->with('success', 'Type de depose modifier avec success .');
    }

    public function destroy($id)
    {
        $type_depose = TypeDepose::findOrfail($id);
        $type_depose->delete();

        return redirect()->route('type_depose.all')
            ->with('success', 'Type de depose supprimer avec success .');
    }
}
