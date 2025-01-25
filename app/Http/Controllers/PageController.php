<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return response()->json(Page::all(), 200);
    }

    public function show($route)
    {
        $page = Page::where('route', $route)->first();

        if (!$page) {
            return response()->json(['error' => 'Page not found'], 404);
        }

        return response()->json($page, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:pages,name',
            'route' => 'required|string|unique:pages,route',
            'content' => 'nullable|array',
        ]);

        $page = Page::create($validated);

        return response()->json($page, 201);
    }

    public function update(Request $request, $route)
{
    // Find the page by route (or slug)
    $page = Page::where('route', $route)->first();

    if (!$page) {
        return response()->json(['error' => 'Page not found'], 404);
    }

    // Validate request data
    $validated = $request->validate([
        'name' => 'sometimes|string|unique:pages,name,' . $page->id,
        'route' => 'sometimes|string|unique:pages,route,' . $page->id,
        'content' => 'nullable|array',
    ]);

    // Update the page
    $page->update($validated);

    return response()->json($page, 200);
}


    public function destroy($id)
    {
        $page = Page::find($id);

        if (!$page) {
            return response()->json(['error' => 'Page not found'], 404);
        }

        $page->delete();

        return response()->json(['message' => 'Page deleted successfully'], 200);
    }
}