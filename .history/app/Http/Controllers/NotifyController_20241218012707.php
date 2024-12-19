<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notify;

class NotifyController extends Controller
{
    // Show all notifies and manage Create/Edit in one page
    public function index()
    {
        $notifies = Notify::all();
        return view('notify.index', compact('notifies'));
    }

    // Handle both store and update in one method
    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'actif' => 'required|boolean',
        ]);

        if ($request->id) {
            // Update existing record
            $notify = Notify::findOrFail($request->id);
            $notify->update($request->all());
            return redirect()->route('notifies.index')->with('success', 'Notify updated successfully!');
        } else {
            // Create a new record
            Notify::create($request->all());
            return redirect()->route('notifies.index')->with('success', 'Notify created successfully!');
        }
    }

    // Delete a notify
    public function destroy($id)
    {
        $notify = Notify::findOrFail($id);
        $notify->delete();
        return redirect()->route('notify.index')->with('success', 'Notify deleted successfully!');
    }
}
