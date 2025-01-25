<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    // Get all form submissions
    public function index()
    {
        return response()->json(Form::all(), 200);
    }

    // Add a new form submission
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'company' => 'nullable|string',
            'phone' => 'required|string',
            'property_name'=> 'nullable|string',
            'message'=> 'nullable|string',
            'city_name' => 'required|string',
            'property_for' => 'nullable|string',
            'min_budget' => 'required|numeric',
            'max_budget' => 'required|numeric',
            'recordType' => 'required|string',
        ]);

        $form = Form::create($validatedData);
        return response()->json($form, 201);
    }
    // Delete a form submission by ID
public function destroy($id)
{
    // Find the form submission by ID
    $form = Form::find($id);

    // Check if the form submission exists
    if (!$form) {
        return response()->json(['message' => 'Form submission not found'], 404);
    }

    // Delete the form submission
    $form->delete();

    return response()->json(['message' => 'Form submission deleted successfully'], 200);
}
}