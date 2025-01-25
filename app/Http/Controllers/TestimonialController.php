<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    // Get all testimonials
    public function index()
    {
        $testimonials = Testimonial::all();
        return response()->json($testimonials);
    }

    // Get a single testimonial by ID
    public function show($id)
    {
        $testimonial = Testimonial::find($id);
        if (!$testimonial) {
            return response()->json(['message' => 'Testimonial not found'], 404);
        }
        return response()->json($testimonial);
    }

    // Add a new testimonial
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',                // Add 'type'
            'name' => 'required|string',
            'designation' => 'required|string',
            'user_img' => 'required|string',
            'review' => 'required|string',
            'video_url' => 'nullable|string',           // Add 'video_url'
        ]);

        $testimonial = Testimonial::create($validated);
        return response()->json($testimonial, 201);
    }

    // Update a testimonial
    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::find($id);
        if (!$testimonial) {
            return response()->json(['message' => 'Testimonial not found'], 404);
        }

        $validated = $request->validate([
            'type' => 'sometimes|required|string',       // Add 'type'
            'name' => 'sometimes|required|string',
            'designation' => 'sometimes|required|string',
            'user_img' => 'sometimes|required|string',
            'review' => 'sometimes|required|string',
            'video_url' => 'sometimes|nullable|string',  // Add 'video_url'
        ]);

        $testimonial->update($validated);
        return response()->json($testimonial);
    }

    // Delete a testimonial
    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
        if (!$testimonial) {
            return response()->json(['message' => 'Testimonial not found'], 404);
        }

        $testimonial->delete();
        return response()->json(['message' => 'Testimonial deleted successfully']);
    }
}