<?php

namespace App\Http\Controllers;

use App\Models\DholeraInvestment;
use Illuminate\Http\Request;

class DholeraInvestmentController extends Controller
{
    // Get all Dholera Investments
    public function index()
    {
        $investments = DholeraInvestment::all();
        return response()->json($investments);
    }

    // Get a single Dholera Investment by ID
    public function show($id)
    {
        $investment = DholeraInvestment::findOrFail($id);
        return response()->json([
            "id" => $investment->id,
            "intro_title" => $investment->intro_title,
            "intro_description" => $investment->intro_description,
            "intro_featured_img" => $investment->intro_featured_img,
            "location1_title" => $investment->location1_title,
            "location1_link" => $investment->location1_link,
            "location1_featured_img" => $investment->location1_featured_img,
            "location2_title" => $investment->location2_title,
            "location2_link" => $investment->location2_link,
            "location2_featured_img" => $investment->location2_featured_img,
            "advantages" => $investment->advantages,
            "industries_title" => $investment->industries_title,
            "industries_description" => $investment->industries_description,
            "plan_title" => $investment->plan_title,
            "plan_description" => $investment->plan_description,
            "plan_featured_img" => $investment->plan_featured_img,
            "planList" => $investment->planList,
            "dmic_title" => $investment->dmic_title,
            "dmic_description" => $investment->dmic_description,
            "dmic_featured_img" => $investment->dmic_featured_img,
            "dmicList" => $investment->dmicList,
            "airport_title" => $investment->airport_title,
            "airport_description" => $investment->airport_description,
            "airport_featured_img" => $investment->airport_featured_img,
            "advantage_title" => $investment->advantage_title,
            "advantage_description" => $investment->advantage_description,
            "expectations" => $investment->expectations,
            "sectors" => $investment->sectors,
            "benefits" => $investment->benefits,
            "investors" => $investment->investors,
            "created_at" => $investment->created_at,
            "updated_at" => $investment->updated_at
        ]);
    }

    // Store a new Dholera Investment
    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'intro_title' => 'required|string',
            'intro_description' => 'required|string',
            'intro_featured_img' => 'required|string',
            'location1_title' => 'required|string',
            'location1_link' => 'required|string',
            'location1_featured_img' => 'required|string',
            'location2_title' => 'required|string',
            'location2_link' => 'required|string',
            'location2_featured_img' => 'required|string',
            'advantages' => 'required|array',
            'industries_title' => 'required|string',
            'industries_description' => 'required|string',
            'plan_title' => 'required|string',
            'plan_description' => 'required|string',
            'plan_featured_img' => 'required|string',
            'planList' => 'required|array',
            'dmic_title' => 'required|string',
            'dmic_description' => 'required|string',
            'dmic_featured_img' => 'required|string',
            'dmicList' => 'required|array',
            'airport_title' => 'required|string',
            'airport_description' => 'required|string',
            'airport_featured_img' => 'required|string',
            'advantage_title' => 'required|string',
            'advantage_description' => 'required|string',
            'expectations' => 'required|array',
            'sectors' => 'required|array',
            'benefits' => 'required|array',
            'investors' => 'required|array'
        ]);

        // Create a new investment record
        $investment = DholeraInvestment::create($request->all());

        // Return a success response with the created data
        return response()->json($investment, 201);
    }

    // Update a Dholera Investment by ID
    public function update(Request $request, $id)
    {
        // Validate incoming data
        $request->validate([
            'intro_title' => 'string',
            'intro_description' => 'string',
            'intro_featured_img' => 'string',
            'location1_title' => 'string',
            'location1_link' => 'string',
            'location1_featured_img' => 'string',
            'location2_title' => 'string',
            'location2_link' => 'string',
            'location2_featured_img' => 'string',
            'advantages' => 'array',
            'industries_title' => 'string',
            'industries_description' => 'string',
            'plan_title' => 'string',
            'plan_description' => 'string',
            'plan_featured_img' => 'string',
            'planList' => 'array',
            'dmic_title' => 'string',
            'dmic_description' => 'string',
            'dmic_featured_img' => 'string',
            'dmicList' => 'array',
            'airport_title' => 'string',
            'airport_description' => 'string',
            'airport_featured_img' => 'string',
            'advantage_title' => 'string',
            'advantage_description' => 'string',
            'expectations' => 'array',
            'sectors' => 'array',
            'benefits' => 'array',
            'investors' => 'array'
        ]);

        // Find the investment record by ID
        $investment = DholeraInvestment::findOrFail($id);

        // Update the record with new data
        $investment->update($request->all());

        // Return the updated record
        return response()->json($investment);
    }

    // Delete a Dholera Investment by ID
    public function destroy($id)
    {
        // Find the investment record by ID
        $investment = DholeraInvestment::findOrFail($id);

        // Delete the record
        $investment->delete();

        // Return a success response
        return response()->json(null, 204);
    }
}