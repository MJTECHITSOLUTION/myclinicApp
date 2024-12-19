<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelsNotify;

class NotifyController extends Controller
{
    // List all notifies
    public function index()
    {
        $notifies = Notify::all();
        return view('notifies.index', compact('notifies'));
    }

    // Show create form
    public function create()
    {
        return view('notifies.create');
    }

    // Store a new notify
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'actif' => 'required|boolean',
        ]);

        Notify::create($request->all());
        return redirect()->route('notifies.index')->with('success', 'Notify created successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $notify = Notify::findOrFail($id);
        return view('notifies.edit', compact('notify'));
    }

    // Update a notify
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'actif' => 'required|boolean',
        ]);

        $notify = Notify::findOrFail($id);
        $notify->update($request->all());
        return redirect()->route('notifies.index')->with('success', 'Notify updated successfully!');
    }

    // Delete a notify
    public function destroy($id)
    {
        $notify = Notify::findOrFail($id);
        $notify->delete();
        return redirect()->route('notifies.index')->with('success', 'Notify deleted successfully!');
    }
}
