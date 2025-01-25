<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeyDetail;

class KeyDetailController extends Controller
{
    // Get all KeyDetails
    public function index()
    {
        return KeyDetail::all();
    }

    // Get a single KeyDetail by ID or route
    public function show($identifier)
    {
        // Check if the identifier is numeric (for ID) or a string (for route)
        if (is_numeric($identifier)) {
            // Retrieve by ID
            return KeyDetail::findOrFail($identifier);
        } else {
            // Retrieve by route
            return KeyDetail::where('route', $identifier)->firstOrFail();
        }
    }

    // Add a new KeyDetail
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'value' => 'required|string',
            'route' => 'required|string|unique:key_details,route', // Ensure route is unique
            'icon' => 'required|string',  // Expecting a string for icon
        ]);

        return KeyDetail::create([
            'name' => $request->name,
            'value' => $request->value,
            'route' => $request->route,
            'icon' => $request->icon,  // Save the icon string directly
        ]);
    }

    // Update a KeyDetail
    public function update(Request $request, $id)
    {
        $keyDetail = KeyDetail::findOrFail($id);

        $request->validate([
            'name' => 'string',
            'value' => 'string',
            'route' => 'string|unique:key_details,route,' . $keyDetail->id, // Ensure route is unique but allow current KeyDetail's route
            'icon' => 'string',  // Expecting a string for icon
        ]);

        // Update fields
        $keyDetail->update($request->only(['name', 'value', 'route', 'icon']));

        return $keyDetail;
    }

    // Delete a KeyDetail
    public function destroy($id)
    {
        $keyDetail = KeyDetail::findOrFail($id);

        $keyDetail->delete();

        return response()->json(['message' => 'KeyDetail deleted']);
    }
}