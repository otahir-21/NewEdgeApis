<?php

namespace App\Http\Controllers;

use App\Models\BrochureForm;
use Illuminate\Http\Request;

class BrochureFormController extends Controller
{
    // GET all forms
    public function index()
    {
        return BrochureForm::all();
    }

    // GET a single form
    public function show($id)
    {
        $brochureForm = BrochureForm::find($id);

        if (!$brochureForm) {
            return response()->json(['message' => 'Form not found'], 404);
        }

        return response()->json($brochureForm);
    }

    // POST a new form
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        $brochureForm = BrochureForm::create($validated);

        // Send a message to the phone number (e.g., Twilio)
        // Twilio::message($brochureForm->phone, 'Your brochure has been downloaded.');

        return response()->json([
            'message' => 'Form submitted successfully!',
            'data' => $brochureForm,
        ], 201);
    }

    // UPDATE an existing form
    public function update(Request $request, $id)
    {
        $brochureForm = BrochureForm::find($id);

        if (!$brochureForm) {
            return response()->json(['message' => 'Form not found'], 404);
        }

        $validated = $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:15',
            'email' => 'sometimes|required|email|max:255',
        ]);

        $brochureForm->update($validated);

        return response()->json([
            'message' => 'Form updated successfully!',
            'data' => $brochureForm,
        ]);
    }

    // DELETE a form
    public function destroy($id)
    {
        $brochureForm = BrochureForm::find($id);

        if (!$brochureForm) {
            return response()->json(['message' => 'Form not found'], 404);
        }

        $brochureForm->delete();

        return response()->json(['message' => 'Form deleted successfully!']);
    }
}
