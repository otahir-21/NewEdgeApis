<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return Blog::all();
    }

    public function show($id)
    {
        return Blog::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'posted_by' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'long_description' => 'required|string',
            'feature_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for feature image
            'inner_page_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for inner page image
            'seo' => 'required|array',
        ]);

        // Handle image uploads
        if ($request->hasFile('feature_image')) {
            $featureImagePath = $request->file('feature_image')->store('blogs', 'public');
        }

        if ($request->hasFile('inner_page_img')) {
            $innerPageImgPath = $request->file('inner_page_img')->store('blogs', 'public');
        }

        $blog = Blog::create([
            ...$validatedData,
            'feature_image' => $featureImagePath,
            'inner_page_img' => $innerPageImgPath,
        ]);

        return response()->json($blog, 201);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validatedData = $request->validate([
            'date' => 'date',
            'posted_by' => 'string|max:255',
            'title' => 'string|max:255',
            'route' => 'string|max:255',
            'long_description' => 'string',
            'feature_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for feature image
            'inner_page_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for inner page image
            'seo' => 'array',
        ]);

        // Handle image uploads
        if ($request->hasFile('feature_image')) {
            $featureImagePath = $request->file('feature_image')->store('blogs', 'public');
            $validatedData['feature_image'] = $featureImagePath;
        }

        if ($request->hasFile('inner_page_img')) {
            $innerPageImgPath = $request->file('inner_page_img')->store('blogs', 'public');
            $validatedData['inner_page_img'] = $innerPageImgPath;
        }

        $blog->update($validatedData);
        return response()->json($blog);
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return response()->json(null, 204);
    }
}