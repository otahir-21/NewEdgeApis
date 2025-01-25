<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Amenity;

class AmenityController extends Controller
{
    public function index() {
        return Amenity::all(); // Return all amenities as JSON
    }

    public function store(Request $request) {
        // Validate incoming request, including the Arabic name
        $validated = $request->validate([
            'name' => 'required|string',
            'name_ar' => 'nullable|string', // Make the Arabic name field nullable
            'route' => 'nullable|string',
            'icon' => 'required|string',  // Expecting a string for icon
        ]);

        // Create a new Amenity record with validated data
        $amenity = Amenity::create($validated);

        // Return a JSON response with the created amenity and a 201 status code
        return response()->json($amenity, 201);
    }

    public function show($id) {
        // Find the amenity by ID or return 404 if not found
        $amenity = Amenity::findOrFail($id);

        // Return a JSON response with the found amenity
        return response()->json($amenity);
    }

    public function update(Request $request, $id) {
        // Validate incoming request, including the Arabic name
        $validated = $request->validate([
            'name' => 'required|string',
            'name_ar' => 'nullable|string', // Make the Arabic name field nullable
            'route' => 'nullable|string',
            'icon' => 'required|string',  // Expecting a string for icon
        ]);

        // Find the amenity by ID or return 404 if not found
        $amenity = Amenity::findOrFail($id);

        // Update the amenity with the validated data
        $amenity->update($validated);

        // Return a JSON response with the updated amenity
        return response()->json($amenity);
    }

    public function destroy($id) {
        // Find the amenity by ID or return 404 if not found
        $amenity = Amenity::findOrFail($id);

        // Delete the amenity from the database
        $amenity->delete();

        // Return a 204 No Content response
        return response()->json(null, 204);
    }
}