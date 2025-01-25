<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use Illuminate\Support\Facades\Validator;

class Zone_Controller_location extends Controller
{
    // Retrieve all zones with their locations
    public function index()
    {
        $zones = Zone::with('locations:id,title,route,zone_id')->get();

        return response()->json($zones);
    }

    // Retrieve a specific zone by route with its locations
    public function show($route)
    {
        $zone = Zone::with('locations:id,title,route,zone_id')->where('route', $route)->first();

        if (!$zone) {
            return response()->json(['message' => 'Zone not found'], 404);
        }

        return response()->json($zone);
    }
}