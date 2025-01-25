<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;

class ZoneController extends Controller
{
    // Get all zones
    public function index()
    {
        $zones = Zone::all();
        return response()->json($zones);
    }

    // Get a single zone by ID
    public function show($id)
    {
        $zone = Zone::findOrFail($id);
        return response()->json($zone);
    }

    // Add a new zone
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
        ]);

        $zone = Zone::create($request->all());
        return response()->json($zone, 201); // 201 Created
    }

    // Update an existing zone
    public function update(Request $request, $id)
    {
        $zone = Zone::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
        ]);

        $zone->update($request->all());
        return response()->json($zone);
    }

    // Delete a zone
    public function destroy($id)
    {
        $zone = Zone::findOrFail($id);
        $zone->delete();
        return response()->json(null, 204); // 204 No Content
    }

    public function getAllZonesWithLocations()
{
    $zones = Zone::with('locations')->get();

    $zonesData = $zones->map(function ($zone) {
        return [
            'id' => $zone->id,
            'title' => $zone->title,
            'route' => $zone->route,
            'locations' => $zone->locations->map(function ($location) {
                return [
                    'id' => $location->id,
                    'title' => $location->title,
                    'route' => $location->route,
                ];
            })
        ];
    });

    return response()->json($zonesData);
}

public function getZoneByRoute($route)
{
    $zone = Zone::where('route', $route)->with('locations')->firstOrFail();

    $zoneData = [
        'id' => $zone->id,
        'title' => $zone->title,
        'route' => $zone->route,
        'locations' => $zone->locations->map(function ($location) {
            return [
                'id' => $location->id,
                'title' => $location->title,
                'route' => $location->route,
            ];
        })
    ];

    return response()->json($zoneData);
}
}