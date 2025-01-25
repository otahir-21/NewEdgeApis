<?php

// namespace App\Http\Controllers;

// use App\Models\AhmadabadInvestment;
// use Illuminate\Http\Request;

// class AhmadabadInvestmentController extends Controller
// {
//     public function show($id)
// {
//     // Retrieve investment by ID
//     $investment = AhmadabadInvestment::findOrFail($id);

//     // Return the investment as a JSON response
//     return response()->json($investment);
// }
//     public function index()
// {
//     // Retrieve all investment records
//     $investments = AhmadabadInvestment::all();

//     // Return the investments as a JSON response
//     return response()->json($investments);
// }
//     // Create a new investment entry
//     public function store(Request $request)
//     {
//         $request->validate([
//             'intro_title' => 'required|string',
//             'intro_description' => 'required|string',
//             'intro_featured_img' => 'required|string',
//             'benefits' => 'required|array',
//             'why_invest_title' => 'required|string',
//             'why_invest_description' => 'required|string',
//             'why_invest_featured_img' => 'required|string',
//             'benefits2' => 'required|array',
//             'location1_title' => 'required|string',
//             'location1_link' => 'required|string',
//             'location1_featured_img' => 'required|string',
//             'location2_title' => 'required|string',
//             'location2_link' => 'required|string',
//             'location2_featured_img' => 'required|string',
//         ]);

//         // Organize benefits and benefits2
//         $benefits = $request->input('benefits');
//         $benefits2 = $request->input('benefits2');

//         // Make sure each item in benefits and benefits2 follows the structure
//         foreach ($benefits as &$benefit) {
//             $benefit = [
//                 'title' => $benefit['title'],
//                 'description' => $benefit['description'],
//                 'featured_img' => $benefit['featured_img'],
//             ];
//         }

//         foreach ($benefits2 as &$benefit2) {
//             $benefit2 = [
//                 'title' => $benefit2['title'],
//                 'description' => $benefit2['description'],
//                 'featured_img' => $benefit2['featured_img'],
//             ];
//         }

//         // Create the investment record
//         $investment = AhmadabadInvestment::create([
//             'intro_title' => $request->input('intro_title'),
//             'intro_description' => $request->input('intro_description'),
//             'intro_featured_img' => $request->input('intro_featured_img'),
//             'benefits' => $benefits,  // Saving array
//             'why_invest_title' => $request->input('why_invest_title'),
//             'why_invest_description' => $request->input('why_invest_description'),
//             'why_invest_featured_img' => $request->input('why_invest_featured_img'),
//             'benefits2' => $benefits2, // Saving array
//             'location1_title' => $request->input('location1_title'),
//             'location1_link' => $request->input('location1_link'),
//             'location1_featured_img' => $request->input('location1_featured_img'),
//             'location2_title' => $request->input('location2_title'),
//             'location2_link' => $request->input('location2_link'),
//             'location2_featured_img' => $request->input('location2_featured_img'),
//         ]);

//         return response()->json($investment, 201);
//     }

//     // Update a specific investment by ID
//     public function update(Request $request, $id)
//     {
//         $investment = AhmadabadInvestment::findOrFail($id);

//         $request->validate([
//             'intro_title' => 'required|string',
//             'intro_description' => 'required|string',
//             'intro_featured_img' => 'required|string',
//             'benefits' => 'required|array',
//             'why_invest_title' => 'required|string',
//             'why_invest_description' => 'required|string',
//             'why_invest_featured_img' => 'required|string',
//             'benefits2' => 'required|array',
//             'location1_title' => 'required|string',
//             'location1_link' => 'required|string',
//             'location1_featured_img' => 'required|string',
//             'location2_title' => 'required|string',
//             'location2_link' => 'required|string',
//             'location2_featured_img' => 'required|string',
//         ]);

//         // Organize benefits and benefits2
//         $benefits = $request->input('benefits');
//         $benefits2 = $request->input('benefits2');

//         foreach ($benefits as &$benefit) {
//             $benefit = [
//                 'title' => $benefit['title'],
//                 'description' => $benefit['description'],
//                 'featured_img' => $benefit['featured_img'],
//             ];
//         }

//         foreach ($benefits2 as &$benefit2) {
//             $benefit2 = [
//                 'title' => $benefit2['title'],
//                 'description' => $benefit2['description'],
//                 'featured_img' => $benefit2['featured_img'],
//             ];
//         }

//         $investment->update([
//             'intro_title' => $request->input('intro_title'),
//             'intro_description' => $request->input('intro_description'),
//             'intro_featured_img' => $request->input('intro_featured_img'),
//             'benefits' => $benefits,
//             'why_invest_title' => $request->input('why_invest_title'),
//             'why_invest_description' => $request->input('why_invest_description'),
//             'why_invest_featured_img' => $request->input('why_invest_featured_img'),
//             'benefits2' => $benefits2,
//             'location1_title' => $request->input('location1_title'),
//             'location1_link' => $request->input('location1_link'),
//             'location1_featured_img' => $request->input('location1_featured_img'),
//             'location2_title' => $request->input('location2_title'),
//             'location2_link' => $request->input('location2_link'),
//             'location2_featured_img' => $request->input('location2_featured_img'),
//         ]);

//         return response()->json($investment);
//     }
// }

namespace App\Http\Controllers;

use App\Models\AhmadabadInvestment;
use Illuminate\Http\Request;

class AhmadabadInvestmentController extends Controller
{
    // Display a specific investment record by ID
    public function show($id)
    {
        // Retrieve investment by ID
        $investment = AhmadabadInvestment::findOrFail($id);

        // Return the investment as a JSON response
        return response()->json($investment);
    }

    // List all investment records
    public function index()
    {
        // Retrieve all investment records
        $investments = AhmadabadInvestment::all();

        // Return the investments as a JSON response
        return response()->json($investments);
    }

    // Create a new investment entry
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'intro_title' => 'required|string',
            'intro_description' => 'required|string',
            'intro_featured_img' => 'required|string',
            'benefits' => 'required|array',
            'why_invest_title' => 'required|string',
            'why_invest_description' => 'required|string',
            'why_invest_featured_img' => 'required|string',
            'benefits2' => 'required|array',
            'location1_title' => 'required|string',
            'location1_link' => 'required|string',
            'location1_featured_img' => 'required|string',
            'location2_title' => 'required|string',
            'location2_link' => 'required|string',
            'location2_featured_img' => 'required|string',
            'intro_title_ar' => 'nullable|string',
            'intro_description_ar' => 'nullable|string',
            'why_invest_title_ar' => 'nullable|string',
            'why_invest_description_ar' => 'nullable|string',
            'location1_title_ar' => 'nullable|string',
            'location2_title_ar' => 'nullable|string',
        ]);

        // Organize benefits and benefits2 into their expected structure
        $benefits = $request->input('benefits');
        $benefits2 = $request->input('benefits2');

        foreach ($benefits as &$benefit) {
            $benefit = [
                'title' => $benefit['title'],
                'description' => $benefit['description'],
                'featured_img' => $benefit['featured_img'],
            ];
        }

        foreach ($benefits2 as &$benefit2) {
            $benefit2 = [
                'title' => $benefit2['title'],
                'description' => $benefit2['description'],
                'featured_img' => $benefit2['featured_img'],
            ];
        }

        // Create a new investment record with Arabic fields
        $investment = AhmadabadInvestment::create([
            'intro_title' => $request->input('intro_title'),
            'intro_description' => $request->input('intro_description'),
            'intro_featured_img' => $request->input('intro_featured_img'),
            'benefits' => $benefits,
            'why_invest_title' => $request->input('why_invest_title'),
            'why_invest_description' => $request->input('why_invest_description'),
            'why_invest_featured_img' => $request->input('why_invest_featured_img'),
            'benefits2' => $benefits2,
            'location1_title' => $request->input('location1_title'),
            'location1_link' => $request->input('location1_link'),
            'location1_featured_img' => $request->input('location1_featured_img'),
            'location2_title' => $request->input('location2_title'),
            'location2_link' => $request->input('location2_link'),
            'location2_featured_img' => $request->input('location2_featured_img'),
            'intro_title_ar' => $request->input('intro_title_ar'),
            'intro_description_ar' => $request->input('intro_description_ar'),
            'why_invest_title_ar' => $request->input('why_invest_title_ar'),
            'why_invest_description_ar' => $request->input('why_invest_description_ar'),
            'location1_title_ar' => $request->input('location1_title_ar'),
            'location2_title_ar' => $request->input('location2_title_ar'),
        ]);

        return response()->json($investment, 201);
    }

    // Update a specific investment by ID
    public function update(Request $request, $id)
    {
        // Retrieve investment record
        $investment = AhmadabadInvestment::findOrFail($id);

        // Validate the incoming data
        $request->validate([
            'intro_title' => 'required|string',
            'intro_description' => 'required|string',
            'intro_featured_img' => 'required|string',
            'benefits' => 'required|array',
            'why_invest_title' => 'required|string',
            'why_invest_description' => 'required|string',
            'why_invest_featured_img' => 'required|string',
            'benefits2' => 'required|array',
            'location1_title' => 'required|string',
            'location1_link' => 'required|string',
            'location1_featured_img' => 'required|string',
            'location2_title' => 'required|string',
            'location2_link' => 'required|string',
            'location2_featured_img' => 'required|string',
            'intro_title_ar' => 'nullable|string',
            'intro_description_ar' => 'nullable|string',
            'why_invest_title_ar' => 'nullable|string',
            'why_invest_description_ar' => 'nullable|string',
            'location1_title_ar' => 'nullable|string',
            'location2_title_ar' => 'nullable|string',
        ]);

        // Organize benefits and benefits2 into the correct structure
        $benefits = $request->input('benefits');
        $benefits2 = $request->input('benefits2');

        foreach ($benefits as &$benefit) {
            $benefit = [
                'title' => $benefit['title'],
                'description' => $benefit['description'],
                'featured_img' => $benefit['featured_img'],
            ];
        }

        foreach ($benefits2 as &$benefit2) {
            $benefit2 = [
                'title' => $benefit2['title'],
                'description' => $benefit2['description'],
                'featured_img' => $benefit2['featured_img'],
            ];
        }

        // Update the investment record with the provided data
        $investment->update([
            'intro_title' => $request->input('intro_title'),
            'intro_description' => $request->input('intro_description'),
            'intro_featured_img' => $request->input('intro_featured_img'),
            'benefits' => $benefits,
            'why_invest_title' => $request->input('why_invest_title'),
            'why_invest_description' => $request->input('why_invest_description'),
            'why_invest_featured_img' => $request->input('why_invest_featured_img'),
            'benefits2' => $benefits2,
            'location1_title' => $request->input('location1_title'),
            'location1_link' => $request->input('location1_link'),
            'location1_featured_img' => $request->input('location1_featured_img'),
            'location2_title' => $request->input('location2_title'),
            'location2_link' => $request->input('location2_link'),
            'location2_featured_img' => $request->input('location2_featured_img'),
            'intro_title_ar' => $request->input('intro_title_ar'),
            'intro_description_ar' => $request->input('intro_description_ar'),
            'why_invest_title_ar' => $request->input('why_invest_title_ar'),
            'why_invest_description_ar' => $request->input('why_invest_description_ar'),
            'location1_title_ar' => $request->input('location1_title_ar'),
            'location2_title_ar' => $request->input('location2_title_ar'),
        ]);

        return response()->json($investment);
    }
}