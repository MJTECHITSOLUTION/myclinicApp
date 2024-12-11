<?php

namespace App\Http\Controllers;

use App\Fournisseur;
use App\User;
use Hash;
use Redirect;
use Str;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{

    public function all()
    {
        $fournisseurs = Fournisseur::OrderBy('id', 'DESC')->paginate(10);
        return view('fournisseur.all', ['fournisseurs' => $fournisseurs]);
    }



    public function create()
    {
        return view('fournisseur.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:fournisseurs',
            'phone' => 'required|numeric',
        ]);



        $fournisser = new Fournisseur();

        $fournisser->name = $request->name;
        $fournisser->email = $request->email;
        $fournisser->phone = $request->phone;
        $fournisser->mobile = $request->mobile;
        $fournisser->Numéro_IF = $request->numéro_IF;
        $fournisser->ICE = $request->ICE;
        $fournisser->pays = $request->pays;
        $fournisser->ville = $request->ville;
        $fournisser->adresse = $request->adresse;

        $fournisser->save();

        return Redirect::route('fournisseur.all')->with('success', 'Fournisseur ajouté avec succès');
    }

    public function edit($id)
    {
        $fournisseur = Fournisseur::findOrfail($id);
        return view('fournisseur.edit', ['fournisseur' => $fournisseur]);
    }

    public function store_edit(Request $request)
    {

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);








        $fournisseur = Fournisseur::where('id', '=', $request->myid)
            ->update([
                'name'      => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'mobile'      => $request->mobile,
                'Numéro_IF'      => $request->numéro_IF,
                'ICE'      => $request->ICE,
                'Pays'      => $request->pays,
                'Ville'      => $request->ville,
                'Adresse'      => $request->adresse,
            ]);




        return Redirect::route('fournisseur.all')->with('success', 'Fournisseur mise a jour  avec succès');
    }

    public function view($id)
    {
        $fournisseur = Fournisseur::findOrfail($id);
        return view('fournisseur.view', ['fournisseur' => $fournisseur]);
    }

    public function search(Request $request)
    {

        $term = $request->term;

        $fournisseurs = User::where('name', 'LIKE', '%' . $term . '%')->where('role', 'fournisseur')->OrderBy('id', 'asc')->paginate(10);


        return view('fournisseur.all', ['fournisseur' => $fournisseurs]);
    }

    public function destroy($id)
    {

        $patient = Fournisseur::destroy($id);

        return Redirect::route('fournisseur.all')->with('success', 'Patient Deleted Successfully');
    }
}
