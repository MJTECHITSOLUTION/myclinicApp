<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

use Redirect;

class CategoryController extends Controller
{
    public function all()
    {
        $categorys = Category::OrderBy('id', 'DESC')->paginate(10);
        return view('category.all', ['categorys' => $categorys]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;

        $category->save();

        return Redirect::route('category.all')->with('success', 'catégorie ajouté avec succès');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', ['category' => $category]);
    }

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category = Category::findOrfail($request->myid);
        $category->name = $request->name;
        $category->slug = $request->slug;

        $category->update();

        return Redirect::route('category.all')->with('success', 'catégorie modifié avec succès');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return Redirect::route('category.all')->with('success', 'catégorie supprimé avec succès');
    }
}
