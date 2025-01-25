<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function index()
{
    $items = PropertyType::all(); // Fetch all items

    $response = $items->map(function ($item) {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'route' => $item->route,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
            'banner_image' => $item->banner_image,

            'seo' => [
                'meta_title' => $item->meta_title,
                'meta_description' => $item->meta_description,
                'schema_markup' => $item->schema_markup,
            ],
        ];
    });

    return response()->json($response);
}

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'banner_image' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'schema_markup' => 'nullable|string',
        ]);

        $propertyType = PropertyType::create($request->all());

        return response()->json($propertyType, 201);
    }

    public function showByRoute($route)
    {
        // Fetch the property type by route
        $propertyType = PropertyType::where('route', $route)->firstOrFail();

        // Format the response to match the index method
        $response = [
            'id' => $propertyType->id,
            'title' => $propertyType->title,
            'route' => $propertyType->route,
            'created_at' => $propertyType->created_at,
            'updated_at' => $propertyType->updated_at,
            'banner_image' => $propertyType->banner_image,
            'seo' => [
                'meta_title' => $propertyType->meta_title,
                'meta_description' => $propertyType->meta_description,
                'schema_markup' => $propertyType->schema_markup,
            ],
        ];

        return response()->json($response);
    }

    public function destroy($route)
    {
        $propertyType = PropertyType::where('route', $route)->firstOrFail();
        $propertyType->delete();

        return response()->json(null, 204);
    }
    public function update(Request $request, $route)
{
    $request->validate([
        'title' => 'nullable|string|max:255',
        'route' => 'nullable|string|max:255',
        'meta_title' => 'nullable|string|max:255',
        'banner_image' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:255',
        'schema_markup' => 'nullable|string',
    ]);

    $propertyType = PropertyType::where('route', $route)->firstOrFail();

    // Update only the fields provided in the request
    $propertyType->update($request->only([
        'title',
        'route',
        'meta_title',
        'banner_image',
        'meta_description',
        'schema_markup',
    ]));

    return response()->json($propertyType);
}

}
