<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // Get all locations
    // public function index()
    // {
    //     $locations = Location::with('zone')->get(); // Eager load the zone relationship
    //     return response()->json($locations);
    // }

    public function index(Request $request)
    {
        // Get the zone_id from the query parameters
        $zoneId = $request->query('zone_id');

        // If zone_id is provided, filter by zone; otherwise, get all locations
        $locations = Location::with('zone')
            ->when($zoneId, function ($query) use ($zoneId) {
                return $query->where('zone_id', $zoneId);
            })
            ->get();

        return response()->json($locations);
    }
    // Get a single location by ID
    // public function show($id)
    // {
    //     $location = Location::with('zone')->findOrFail($id);
    //     return response()->json($location);
    // }
    public function show($id)
    {
        // Find the location by ID and ensure it's in the specified zone if zone_id is provided
        $location = Location::with('zone')->findOrFail($id);

        // Check if zone_id is provided in the request
        if (request()->has('zone_id') && $location->zone_id != request()->query('zone_id')) {
            return response()->json(['message' => 'Location not found in this zone.'], 404);
        }

        return response()->json($location);
    }

    // Add a new location
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'zone_id' => 'required|exists:zones,id', // Ensure the zone exists
        ]);

        $location = Location::create($request->all());
        return response()->json($location, 201); // 201 Created
    }

    // Update an existing location
    public function update(Request $request, $id)
    {
        $location = Location::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'zone_id' => 'required|exists:zones,id', // Ensure the zone exists
        ]);

        $location->update($request->all());
        return response()->json($location);
    }

    // Delete a location
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();
        return response()->json(null, 204); // 204 No Content
    }
}