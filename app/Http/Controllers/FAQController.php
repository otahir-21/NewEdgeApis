<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FAQ;

class FAQController extends Controller
{
    // Get all FAQs
    public function index()
    {
        return response()->json(FAQ::all(), 200);
    }

    // Get a single FAQ by ID
    public function show($id)
    {
        $faq = FAQ::find($id);
        if (!$faq) {
            return response()->json(['message' => 'FAQ not found'], 404);
        }
        return response()->json($faq, 200);
    }

    // Add a new FAQ
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $faq = FAQ::create($validatedData);
        return response()->json($faq, 201);
    }

    // Update an existing FAQ
    public function update(Request $request, $id)
    {
        $faq = FAQ::find($id);
        if (!$faq) {
            return response()->json(['message' => 'FAQ not found'], 404);
        }

        $validatedData = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $faq->update($validatedData);
        return response()->json($faq, 200);
    }

    // Delete an FAQ
    public function destroy($id)
    {
        $faq = FAQ::find($id);
        if (!$faq) {
            return response()->json(['message' => 'FAQ not found'], 404);
        }

        $faq->delete();
        return response()->json(['message' => 'FAQ deleted successfully'], 200);
    }
}