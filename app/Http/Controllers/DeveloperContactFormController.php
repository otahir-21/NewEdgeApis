<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeveloperContactForm;

class DeveloperContactFormController extends Controller
{
    // Store the Developer Contact form submission
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'message' => 'nullable|string',
        ]);

        $contactForm = DeveloperContactForm::create($validatedData);
        return response()->json($contactForm, 201);
    }

    // Get all Developer Contact form submissions
    public function index()
    {
        $contactForms = DeveloperContactForm::all();
        return response()->json($contactForms, 200);
    }

    // Get a single Developer Contact form submission by ID
    public function show($id)
    {
        $contactForm = DeveloperContactForm::findOrFail($id);
        return response()->json($contactForm, 200);
    }

    // Update a Developer Contact form submission
    public function update(Request $request, $id)
    {
        $contactForm = DeveloperContactForm::findOrFail($id);

        $validatedData = $request->validate([
            'first_name' => 'sometimes|required|string',
            'last_name' => 'sometimes|required|string',
            'phone' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
            'message' => 'nullable|string',
        ]);

        $contactForm->update($validatedData);
        return response()->json($contactForm, 200);
    }

    // Delete a Developer Contact form submission
    public function destroy($id)
    {
        $contactForm = DeveloperContactForm::findOrFail($id);
        $contactForm->delete();
        return response()->json(null, 204);
    }
}