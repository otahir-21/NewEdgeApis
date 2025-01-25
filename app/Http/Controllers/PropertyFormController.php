<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyForm;
class PropertyFormController extends Controller
{
    public function index(Request $request)
    {
        // Optionally, you can add pagination or filtering here
        $propertyForms = PropertyForm::all(); // Retrieves all records

        return response()->json($propertyForms, 200);
    }
    // Store the Rent/Buy Property form submission
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'company' => 'nullable|string',
            'phone' => 'required|string',
            'city_name' => 'required|string',
            'email' => 'required|email',
            'property' => 'required|string',
            'property_for' => 'required|string',
            'min_budget' => 'required|numeric',
            'max_budget' => 'required|numeric',

            'message' => 'nullable|string',
        ]);

        $propertyForm = PropertyForm::create($validatedData);
        return response()->json($propertyForm, 201);
    }
}