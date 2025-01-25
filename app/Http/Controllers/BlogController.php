<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Get all blogs
    public function index()
    {
        return Blog::all();
    }

    // Get a single blog by ID
    public function show($identifier)
    {
        // Check if the identifier is numeric (for ID) or a string (for route)
        if (is_numeric($identifier)) {
            // Retrieve by ID
            return Blog::findOrFail($identifier);
        } else {
            // Retrieve by route
            $blog = Blog::where('route', $identifier)->firstOrFail();
            return $blog;
        }
    }

    // Create a new blog
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|string',
            'posted_by' => 'nullable|string',
            'title' => 'required|string',
            'banner_image' => 'required|string',
            'route' => 'required|string',
            'long_description' => 'required|string',
            'feature_image' => 'nullable|string',
            'inner_page_img' => 'nullable|string',
            'seo' => 'nullable|array',
        ]);

        return Blog::create($request->all());
    }

    // Update an existing blog
    public function update(Request $request, $route)
    {
        // Find the blog by route or return 404 if not found
        $blog = Blog::where('route', $route)->firstOrFail();

        $request->validate([
            'date' => 'required|string',
            'posted_by' => 'nullable|string',
            'title' => 'required|string',
            'route' => 'required|string|unique:blogs,route,' . $blog->id, // Ensure route is unique, ignoring the current blog
            'long_description' => 'required|string',
            'banner_image' => 'required|string',
            'feature_image' => 'nullable|string',
            'inner_page_img' => 'nullable|string',
            'seo' => 'nullable|array',
        ]);

        $blog->update($request->all());

        return response()->json($blog);
    }

    // Delete a blog
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return response()->noContent();
    }
}
