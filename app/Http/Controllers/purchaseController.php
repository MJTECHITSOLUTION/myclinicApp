<?php

namespace App\Http\Controllers;


use App\Item;
use App\Setting;
// use App\Purchase_item;
use App\Category;
use App\Purchase;

use App\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class purchaseController extends Controller

// bghit nsayb route fach t3tiha purchase id, tjib lik mn db ol items dialha bach n3rfo wach pivot khdam olala la makhdamch
{
    public function all()
    {
        $purchases = Purchase::OrderBy('id', 'DESC')->paginate(10);
        return view('purchase.all', ['purchases' => $purchases]);
    }

    public function create()
    {
        $items = Item::all();
        $fournisseurs = Fournisseur::all();
        return view('purchase.create', compact('items', 'fournisseurs'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'fournisseur' => ['required', 'string', 'max:255'],
            'purchase_date' => ['required', 'date'],
        ]);

        $purchase = new Purchase();
        $purchase->fournisseur_id = $request->fournisseur;
        $purchase->purchase_date = $request->purchase_date;
        $purchase->total_price  = $request->total;
        $purchase->TVA  = $request->tva;
        $purchase->purchase_status  = 0;
        $purchase->type_pay  = $request->typePayment;
        $purchase->total_price  = $request->finalAmount;
        $purchase->ref_pay  = $request->reference;


        $purchase->purchase_note  = $request->note;


        if ($request->hasfile('Recu')) {

            $file = $request->file('Recu');
            $extension = $file->getClientOriginalExtension();
            $filename = time()  . '-recu-' . $request->purchase_date . '.' . $extension;
            $file->move('uploads/recu/', $filename);
            $purchase->recu = $filename;
        } else {

            $purchase->recu = '';
        }

        if ($request->hasFile('facture')) {

            // We Get the image
            $file = $request->file('facture');
            // We Add String to Image name
            $fileName = time() . '-facture-' . $request->purchase_date . '.' . $file->getClientOriginalExtension();
            // We Tell him the uploads path
            $destinationPath = public_path() . '/uploads/factures/';
            // We move the image to the destination path
            $file->move($destinationPath, $fileName);
            // Add fileName to database

            $purchase->facture = $fileName;
        } else {
            $purchase->facture = "";
        }

        if ($request->hasFile('bon_livraison')) {

            // We Get the image
            $file = $request->file('bon_livraison');
            // We Add String to Image name
            $fileName = time() . '-bon_livraison-' . $request->purchase_date . '.' . $file->getClientOriginalExtension();
            // We Tell him the uploads path
            $destinationPath = public_path() . '/uploads/bon_livraison/';
            // We move the image to the destination path
            $file->move($destinationPath, $fileName);
            // Add fileName to database

            $purchase->bon_livraison = $fileName;
        } else {
            $purchase->bon_livraison = "";
        }



        $purchase->save();

        $items = $request->input('item_id');
        $quantities = $request->input('quantity');



        foreach ($items as $key => $item) {
            $purchase->items()->attach(
                $item,
                [
                    'quantity' => $quantities[$key],
                ]

            );
        }

        return redirect()->route('purchase.all')->with('success', 'Achat ajouté avec succès');
    }

    public function edit($id)
    {
        $purchase = Purchase::find($id);
        $items = Item::all();
        // $putchase_items = Purchase_item::where('purchase_id', $id)->get();
        $fournisseurs = Fournisseur::all();
        return view('purchase.edit', compact('purchase', 'items', 'fournisseurs',));
    }

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'fournisseur' => ['required', 'string', 'max:255'],

            'purchase_date' => ['required', 'date'],
        ]);

        $purchase = Purchase::findOrfail($request->myid);
        $purchase->fournisseur_id = $request->fournisseur;
        $purchase->purchase_date = $request->purchase_date;
        $purchase->total_price  = $request->total;
        $purchase->TVA  = $request->tva;
        $purchase->type_pay  = $request->typePayment;

        $purchase->ref_pay  = $request->reference;
        $purchase->total_price  = $request->finalAmount;


        $purchase->purchase_note  = $request->note;


        if ($request->hasfile('Recu')) {


            $file = $request->file('Recu');


            $fileName = time() . '-recu-' . $request->purchase_date . '.' . $file->getClientOriginalExtension();


            $destinationPath = public_path() . '/uploads/recu/';
            $file->move($destinationPath, $fileName);


            $old_file = $purchase->recu;

            if ($old_file != "") {

                $file_path = public_path() . '/uploads/recu/' . $old_file;

                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }


            $purchase->recu = $fileName;
        }

        if ($request->hasFile('facture')) {

            // We Get the image
            $file = $request->file('facture');
            // We Add String to Image name
            $fileName = time() . '-facture-' . $request->purchase_date . '.' . $file->getClientOriginalExtension();
            // We Tell him the uploads path
            $destinationPath = public_path() . '/uploads/factures/';
            // We move the image to the destination path
            $file->move($destinationPath, $fileName);
            // Add fileName to database

            // delete old file
            $old_file = $purchase->facture;
            if ($old_file != "") {
                $file_path = public_path() . '/uploads/factures/' . $old_file;


                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }



            $purchase->facture = $fileName;
        }


        if ($request->has('deleteFacture')) {

            $this->deleteFacture($request);
        }

        if ($request->has('deleteBon')) {

            $this->delete_bon_livraison($request);
        }

        if ($request->has('deleteRecu')) {

            $this->delete_recu($request);
        }




        if ($request->hasFile('bon_livraison')) {



            // We Get the image
            $file = $request->file('bon_livraison');
            // We Add String to Image name
            $fileName = time() . '-bon_livraison-' . $request->purchase_date . '.' . $file->getClientOriginalExtension();
            // We Tell him the uploads path
            $destinationPath = public_path() . '/uploads/bon_livraison/';
            // We move the image to the destination path
            $file->move($destinationPath, $fileName);
            // Add fileName to database

            // delete old file
            $old_file = $purchase->bon_livraison;

            if ($old_file != "") {

                $file_path = public_path() . '/uploads/bon_livraison/' . $old_file;

                if (file_exists($file_path)) {

                    unlink($file_path);
                }
            }



            $purchase->bon_livraison = $fileName;
        }

        $purchase->update();

        // kayna w7da ila l9at id deja kayn kat updaetih auto o l



        $items = $request->input('item_id');

        $quantities = $request->input('quantity');

        // if no items are selected, detach all items
        if (!$items) {
            return redirect()->back()->with('success', 'No items selected');
        }

        foreach ($items as $key => $item) {
            $existingItem = $purchase->items()->find($item);

            if ($existingItem) {
                $purchase->items()->updateExistingPivot($item, ['quantity' => $quantities[$key]]);
            } else {
                $purchase->items()->attach(
                    $item,
                    ['quantity' => $quantities[$key]]
                );
            }
        }

        return redirect()->back()->with('success', 'Achat mise a jour avec succès');
    }

    public function view($id)
    {
        $system_name = Setting::where('option_name', 'system_name')->first();
        $system_address = Setting::where('option_name', 'address')->first();
        $system_phone = Setting::where('option_name', 'phone')->first();
        $system_email = Setting::where('option_name', 'hospital_email')->first();
        $system_title = Setting::where('option_name', 'title')->first();
        $system_ville  = Setting::where('option_name', 'ville')->first();
        $settings = [
            'system_name' => $system_name,
            'system_address' => $system_address,
            'system_phone' => $system_phone,
            'system_email' => $system_email,
            'system_title' => $system_title,
            'system_ville' => $system_ville,
        ];

        $purchase = Purchase::find($id);
        $fournisseur = Fournisseur::find($purchase->fournisseur_id);

        $items = Item::all();

        return view('purchase.view', ['purchase' => $purchase, 'items' => $items, 'settings' => $settings, 'fournisseur' => $fournisseur]);
    }


    public function purchase_status(Request $request, $id)
    {
        $purchase = Purchase::find($id);
        $purchase->purchase_status = $request->purchase_status;

        $purchase->update();
        return redirect()->route('purchase.all')->with('success', 'Achat mise a jour avec succès');
    }

    public function deleteFacture(Request $request)
    {
        $purchase = Purchase::find($request->myid);
        $old_file = $purchase->facture;
        $file_path = public_path() . '/uploads/factures/' . $old_file;

        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $purchase->facture = "";
        $purchase->update();
    }

    public function delete_bon_livraison(Request $request)
    {
        $purchase = Purchase::find($request->myid);
        $old_file = $purchase->bon_livraison;
        $file_path = public_path() . '/uploads/bon_livraison/' . $old_file;

        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $purchase->bon_livraison = "";
        $purchase->update();
    }


    public function delete_recu(Request $request)
    {
        $purchase = Purchase::find($request->myid);
        $old_file = $purchase->recu;
        $file_path = public_path() . '/uploads/recu/' . $old_file;

        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $purchase->recu = "";
        $purchase->update();
    }


    public function destroy($id)
    {

        $purchase = Purchase::find($id);
        $purchase->delete();
        return redirect()->route('purchase.all')->with('success', 'Achat supprimé avec succès');
    }
}
