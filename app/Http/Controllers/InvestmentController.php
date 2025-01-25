<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;

class InvestmentController extends Controller
{
    // Get all Investments
    public function index()
    {
        return Investment::all();
    }

    // Get a single Investment
    public function show($id)
    {
        return Investment::findOrFail($id);
    }

    // Add a new Investment
    public function store(Request $request)
    {
        $request->validate([
            'intro.title' => 'required|string',
            'intro.description' => 'required|string',
            'intro.featured_img' => 'required|string',
            'key_details' => 'required|array',
            'expertTips.title' => 'required|string',
            'expertTips.featured_img' => 'required|string',
            'tips' => 'required|array',
            'factors' => 'required|array',
            'phases' => 'required|array',
            'whyInvest.title' => 'required|string',
            'whyInvest.description' => 'required|string',
            'whyInvest.featured_img' => 'required|string',
            'offerings' => 'required|array',
            'opportunity1.title' => 'required|string',
            'opportunity1.featured_img' => 'required|string',
            'opportunity2.title' => 'required|string',
            'opportunity2.featured_img' => 'required|string',
        ]);

        $investment = Investment::create([
            'intro_title' => $request->input('intro.title'),
            'intro_description' => $request->input('intro.description'),
            'intro_featured_img' => $request->input('intro.featured_img'),
            'key_details' => json_encode($request->input('key_details')),
            'expert_tips' => json_encode($request->input('expertTips')),
            'tips' => json_encode($request->input('tips')),
            'factors' => json_encode($request->input('factors')),
            'phases' => json_encode($request->input('phases')),
            'why_invest_title' => $request->input('whyInvest.title'),
            'why_invest_description' => $request->input('whyInvest.description'),
            'why_invest_featured_img' => $request->input('whyInvest.featured_img'),
            'offerings' => json_encode($request->input('offerings')),
            'opportunity1_title' => $request->input('opportunity1.title'),
            'opportunity1_featured_img' => $request->input('opportunity1.featured_img'),
            'opportunity2_title' => $request->input('opportunity2.title'),
            'opportunity2_featured_img' => $request->input('opportunity2.featured_img'),
        ]);

        return response()->json($investment, 201);
    }


    // Update an existing Investment
    public function update(Request $request, $id)
    {
        $investment = Investment::findOrFail($id);
        $investment->update($request->all());
        return response()->json($investment, 200);
    }

    // Delete an Investment
    public function destroy($id)
    {
        Investment::findOrFail($id)->delete();
        return response()->json(['message' => 'Investment deleted'], 200);
    }
}