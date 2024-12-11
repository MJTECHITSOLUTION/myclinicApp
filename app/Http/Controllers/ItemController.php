<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;

use Redirect;




class ItemController extends Controller
{
    public function all()
    {
        $items = Item::OrderBy('id', 'DESC')->paginate(10);
        return view('item.all', ['items' => $items]);
    }

    public function create()
    {
        $Categorys = Category::all();
        return view('item.create', ['categorys' => $Categorys]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'stock' => ['numeric'],
            'alert_stock' => ['numeric'],
            'purchase_price' => ['required', 'numeric'],
            'sale_price' => ['numeric'],
        ]);

        $item = new Item();
        $item->name = $request->name;


        $item->purchase_price = $request->purchase_price;
        $item->sale_price = $request->sale_price;
        $item->brand = $request->brand;
        $item->alert_stock = $request->alert_stock;
        $item->stock = $request->stock;
        $item->category_id = $request->category;
        $item->unit = $request->unit;
        $item->expiration_date = $request->expiration_date;
        $item->production_date = $request->production_date;

        if ($request->hasFile('item')) {
            $file = $request->file('item');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '-' . $item->name . '.' . $extension;
            $file->move('uploads/images_Items/', $filename);
            $item->item_image = $filename;
        } else {
            $item->item_image = 'default.png';
        }

        $item->save();


        return Redirect::route('item.all')->with('success', 'Article ajouté avec succès');
    }

    public function edit($id)
    {
        $item = Item::find($id);
        $Categorys = Category::all();
        return view('item.edit', ['item' => $item, 'categorys' => $Categorys]);
    }

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'stock' => ['numeric'],
            'alert_stock' => ['numeric'],
            'purchase_price' => ['required', 'numeric'],
            'sale_price' => ['numeric'],
        ]);

        $item = Item::findOrfail($request->myid);
        $item->name = $request->name;


        $item->purchase_price = $request->purchase_price;
        $item->sale_price = $request->sale_price;
        $item->brand = $request->brand;
        $item->category_id = $request->category;
        $item->alert_stock = $request->alert_stock;
        $item->stock = $request->stock;

        $item->unit = $request->unit;
        $item->expiration_date = $request->expiration_date;
        $item->production_date = $request->production_date;

        if ($request->hasFile('item')) {
            $file = $request->file('item');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '-' . $item->name . '.' . $extension;
            $file->move('uploads/images_Items/', $filename);

            // delete old image
            if ($item->item_image != 'default.png') {
                $image_path = public_path('uploads/images_Items/' . $item->item_image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            };

            $item->item_image = $filename;
        }

        $item->update();

        return Redirect::route('item.all')->with('success', 'Article mise a jour avec succès');
    }

    public function view($id)
    {
        $item = Item::find($id);
        return view('item.view  ', ['item' => $item]);
    }


    public function search(Request $request)
    {

        $term = $request->term;

        $items = Item::where('name', 'LIKE', '%' . $term . '%')->OrderBy('id', 'asc')->paginate(10);

        return view('item.all', ['items' => $items]);
    }

    public function create_category(Request $request)
    {

        dd($request->all());
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;

        $category->save();

        return Redirect::route('item.all')->with('success', 'catégorie ajouté avec succès');
    }


    public function destroy($id)
    {
        $item = Item::find($id);



        if ($item->item_image != 'default.png') {
            $image_path = public_path('uploads/images_Items/' . $item->item_image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        };


        $item = Item::destroy($id);


        return Redirect::route('item.all')->with('success', 'Article supprimé avec succès');
    }
}
