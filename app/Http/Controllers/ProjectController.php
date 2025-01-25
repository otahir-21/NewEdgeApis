<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\KeyDetail;
use App\Models\Amenity;
use App\Models\Zone;
use App\Models\Developer;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::with(['zone', 'developer', 'propertyType', 'amenities','location'])->get();

        $formattedProjects = $projects->map(function ($project) {
            return $this->formatProjectResponse($project);
        });

        return response()->json($formattedProjects, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'route' => 'required|string|unique:projects|max:255',
            'featured_img' => 'nullable|string',
            'inner_page_image' => 'required|string',
            'banner_image'=> 'required|string',
            'featured_property'=> 'nullable|boolean',
            'price' => 'nullable|string',
            'range' => 'nullable|string',
            'zone_id' => 'nullable|integer|exists:zones,id',
            'developer_id' => 'nullable|integer|exists:developers,id',
            'bath' => 'nullable|string',
            'brochure' => 'nullable|string|max:255',
            'video_thumbnail' => 'nullable|string',

            'roi' => 'nullable|string',
            'tagline' => 'nullable|string',
            'property_location' => 'nullable|string',
            'company_type' => 'nullable|string',
            'lease_duration' => 'nullable|string',
            'monthly_rent' => 'nullable|string',
            'property_sub_type' => 'nullable|string',

            'bedroom' => 'nullable|string',
            'area' => 'nullable|string',
            'rera_no' => 'nullable|string',
            'description' => 'nullable|string',
            'video_url' => 'nullable|string',
            'property_type_id' => 'nullable|integer|exists:property_types,id',
            'slider_image' => 'nullable|array',
            'gallery_image' => 'nullable|array',
            'preleased_location' => 'nullable|string',

            'key_details' => 'required|array',
        'key_details.*.name' => 'required|string',
        'key_details.*.value' => 'required|string',
        'key_details.*.icon' => 'required|string',

            'farmhouse_location' => 'nullable|string',
            'location_id' => 'nullable|integer|exists:locations,id',
            // 'key_details' => 'nullable|array',
            'amenities' => 'nullable|array',
            'seo.meta_title' => 'nullable|string',
            'seo.meta_description' => 'nullable|string',
            'seo.schema_markup' => 'nullable|string',
            'project_status' => 'nullable|string',
        ]);

        // Create the project first
        $project = Project::create($validated);

        // Fetch amenities by IDs and associate them with the project
        if (!empty($request->amenities)) {
            $amenities = Amenity::whereIn('id', $request->amenities)->get();
            $project->amenities = $amenities;
        }

        // Fetch zone by ID and associate it with the project
        if (!empty($request->zone_id)) {
            $zone = Zone::find($request->zone_id);
            $project->zone = $zone;
        }

        // Fetch developer by ID and associate it with the project
        if (!empty($request->developer_id)) {
            $developer = Developer::find($request->developer_id);
            $project->developer = $developer;
        }

        // Fetch property type by ID and associate it with the project
        if (!empty($request->property_type_id)) {
            $propertyType = PropertyType::find($request->property_type_id);
            $project->property_type = $propertyType;
        }

        return response()->json($project, 201);
    }

    public function show($route)
{
    $project = Project::where('route', $route)->with([ 'amenities', 'zone', 'developer', 'propertyType', 'location'])->first();


    if (!$project) {
        return response()->json(['message' => 'Project not found'], 404);
    }

    return response()->json($this->formatProjectResponse($project));
}

    protected function formatProjectResponse($property)
{
    $amenities = \App\Models\Amenity::whereIn('id', $property->amenities)->get();

     // Decode key_details directly from the project table
     $formattedKeyDetails = $property->key_details;
    return [
        'id'=>$property->id,
        'title' => $property->title,
        'route' => $property->route,
        'featured_img' => $property->featured_img,
        'inner_page_image' => $property->inner_page_image,
        'banner_image'=>$property->banner_image,
        'price' => $property->price,
        'range' => $property->range,
        'zone_id' => $property->zone_id,
        'developer_id' => $property->developer_id,
        'bath' => $property->bath,
        'roi'=> $property->roi,
        'tagline'=> $property->tagline,
        'property_location'=> $property->property_location,
        'location_id'=> $property->location_id,
        'featured_property'=> $property->featured_property,
        'company_type' => $property->company_type,
        'lease_duration'=> $property->lease_duration,
        'monthly_rent'=> $property->monthly_rent,
        'property_sub_type' => $property->property_sub_type,
        'bedroom' => $property->bedroom,
        'area' => $property->area,
        'brochure' => $property->brochure,
        'video_thumbnail' => $property->video_thumbnail,

        'rera_no' => $property->rera_no,
        'description' => $property->description,
        'video_url' => $property->video_url,
        'property_type_id' => $property->property_type_id,
        'slider_image' => $property->slider_image,
        'gallery_image' => $property->gallery_image,
        'preleased_location' => $property->preleased_location,
        'farmhouse_location' => $property->farmhouse_location,
        'key_details' => $formattedKeyDetails,
        'amenities_id' => $amenities->pluck('id')->toArray(),
        'amenities' => $amenities->map(function ($amenity) {
    return [
        'id' => $amenity->id,
        'name' => $amenity->name,
        'route' => $amenity->route,
        'icon' => $amenity->icon,
    ];
}),
        'seo' => $property->seo,
        'project_status' => $property->project_status,
        'updated_at' => $property->updated_at,
        'created_at' => $property->created_at,
        'zone' => $property->zone ? [
            'id' => $property->zone->id,
            'title' => $property->zone->title,
            'route' => $property->zone->route,
            'created_at' => $property->zone->created_at,
            'updated_at' => $property->zone->updated_at,
        ] : null, // Handle null for zone
        'developer' => $property->developer ? [
            'id' => $property->developer->id,
            'name' => $property->developer->name,
            'route' => $property->developer->route,
            'featured_img' => $property->developer->featured_img,
            'experience' => $property->developer->experience,
            'inner_page_image' => $property->developer->inner_page_image,
            'description' => $property->developer->description,
            'brochure' => $property->developer->brochure,
            'project_id' => $property->developer->project_id,
            'created_at' => $property->developer->created_at,
            'updated_at' => $property->developer->updated_at,
        ] : null, // Handle null for developer
        'property_type' => $property->propertyType ? [
            'id' => $property->propertyType->id,
            'title' => $property->propertyType->title,
            'banner_image' => $property->propertyType->banner_image,
            'route' => $property->propertyType->route,
            'created_at' => $property->propertyType->created_at,
            'updated_at' => $property->propertyType->updated_at,
            'seo' => $property->seo ? [
        'meta_title' => $property->meta_title,
        'meta_description' => $property->meta_description,
        'schema_markup' => $property->schema_markup,
    ]:null
        ] : null, // Handle null for property type
        'location' => $property->location ? [
            'id' => $property->location->id,
            'title' => $property->location->title,
            'route' => $property->location->route,
            'zone' => $property->location->zone ? [
                'title' => $property->location->zone->title,
                'route' => $property->location->zone->route,
            ] : null, // Handle null for location zone
        ] : null, // Handle null for location

    ];
}

public function update(Request $request)
{
    // Validate incoming request data
    $validated = $request->validate([
        'route' => 'required|string|max:255|exists:projects,route',
        'title' => 'nullable|string|max:255',
        'featured_img' => 'nullable|boolean',
        'inner_page_image' => 'nullable|string',
        'banner_image' => 'nullable|string',
        'price' => 'nullable|string',
        'range' => 'nullable|string',
        'zone_id' => 'nullable|integer|exists:zones,id',
        'developer_id' => 'nullable|integer|exists:developers,id',
        'bath' => 'nullable|string',
        'bedroom' => 'nullable|string',
        'farmhouse_location' => 'nullable|string',
        'area' => 'nullable|string',
        'rera_no' => 'nullable|string',
        'brochure' => 'nullable|string|max:255',
        'video_thumbnail' => 'nullable|string',
        'description' => 'nullable|string',
        'featured_property'=> 'nullable|boolean',
        'video_url' => 'nullable|string',
        'property_type_id' => 'nullable|integer|exists:property_types,id',
        'slider_image' => 'nullable|array',
        'gallery_image' => 'nullable|array',
        'key_details' => 'nullable|array',
        'preleased_location' => 'nullable|string',
        'amenities' => 'nullable|array',
        'location_id' => 'nullable|integer|exists:locations,id',
        'seo.meta_title' => 'nullable|string',
        'seo.meta_description' => 'nullable|string',
        'seo.schema_markup' => 'nullable|string',
        'project_status' => 'nullable|string',
    ]);

    // Find the project by the unique route
    $project = Project::where('route', $validated['route'])->first();

    if (!$project) {
        return response()->json(['message' => 'Project not found'], 404);
    }

    // Update project attributes with validated data
    $project->fill(collect($validated)->except(['key_details', 'amenities', 'seo'])->toArray());

    // Handle SEO data if provided
    if (isset($validated['seo'])) {
        $project->seo = $validated['seo'];
    }

    // Update key details if provided
    if (!empty($request->key_details)) {
        $project->key_details = $request->key_details; // Store as an array directly
    }

    // Update amenities if provided
    if (!empty($request->amenities)) {
        $amenities = Amenity::whereIn('id', $request->amenities)->get();
        $project->amenities()->sync($amenities);
    }

    // Update relationships by ID if provided
    if (!empty($request->zone_id)) {
        $zone = Zone::find($request->zone_id);
        if ($zone) {
            $project->zone()->associate($zone);
        } else {
            // \Log::warning('Zone not found:', ['zone_id' => $request->zone_id]);
        }
    }

    if (!empty($request->developer_id)) {
        $developer = Developer::find($request->developer_id);
        if ($developer) {
            $project->developer()->associate($developer);
        } else {
            // \Log::warning('Developer not found:', ['developer_id' => $request->developer_id]);
        }
    }

    if (!empty($request->property_type_id)) {
        $propertyType = PropertyType::find($request->property_type_id);
        if ($propertyType) {
            $project->propertyType()->associate($propertyType); // Ensure the method name is correct
        } else {
            // \Log::warning('Property Type not found:', ['property_type_id' => $request->property_type_id]);
        }
    }

    // Save the updated project
    $project->save();

    return response()->json($this->formatProjectResponse(property: $project), 200); // Return formatted response
}

    // Method to delete a project
    public function destroy($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $project->delete();

        return response()->json(['message' => 'Project deleted successfully']);
    }

}
