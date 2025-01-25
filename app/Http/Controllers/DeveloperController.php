<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Project;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeveloperController extends Controller
{

    public function index()
    {
        // Retrieve all developers
        $developers = Developer::all();

        // Format the response
        $formattedDevelopers = $developers->map(function ($developer) {
            // Check if project_id is set and is a valid JSON string, else default to an empty array
            $projectIds = is_null($developer->project_id)
                ? []
                : (is_array($developer->project_id)
                    ? $developer->project_id
                    : json_decode($developer->project_id, true) ?? []); // Decode only if it's a string

            // Fetch projects based on project_id
            $projects = Project::with(['zone', 'developer', 'propertyType', 'keyDetails', 'amenities'])
                               ->whereIn('id', $projectIds)
                               ->get();

            return [
        'id'=>$developer->id,
                'name' => $developer->name,
                'route' => $developer->route,
                'featured_img' => $developer->featured_img,
                'experience' => $developer->experience,
                'inner_page_image' => $developer->inner_page_image,
                'banner_image' => $developer->banner_image,
                'description' => $developer->description,
                'brochure' => $developer->brochure,
                'seo' => json_decode($developer->seo, true),
                // 'project_id' => $developer->project_id, // Keep the original project_id here
                // 'projects' => $projects->map(function ($project) {
                //     return $this->formatProjectResponse($project);
                // }),
            ];
        });

        return response()->json($formattedDevelopers, 200);
    }

    public function show($route)
    {
        // Get the developer by route
        $developer = Developer::where('route', $route)->first();

        if (!$developer) {
            return response()->json(['message' => 'Developer not found'], 404);
        }

        // Format the response
        $response = [
            'id' => $developer->id,
            'name' => $developer->name,
            'route' => $developer->route,
            'featured_img' => $developer->featured_img,
            'experience' => $developer->experience,
            'banner_image' => $developer->banner_image,
            'inner_page_image' => $developer->inner_page_image,
            'description' => $developer->description,
            'brochure' => $developer->brochure,
            'seo' => json_decode($developer->seo, true),
        ];

        return response()->json($response, 200);
    }


    // Method to format project response, can be reused
    protected function formatProjectResponse($project)
    {
        return [
            'id' => $project->id,

            'title' => $project->title,
            'route' => $project->route,

            'featured_img' => $project->featured_img,
            'price' => $project->price,
            'range' => $project->range,
            // Add more fields as needed
            'description' => $project->description,
            'created_at' => $project->created_at,
            'updated_at' => $project->updated_at,
            'zone' => [
                'id' => $project->zone->id,
                'title' => $project->zone->title,
                // Include other zone details if needed
            ],
            'developer' => [
                'id' => $project->developer->id,
                'name' => $project->developer->name,
                // Include other developer details if needed
            ],
            // Add other related fields
        ];
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'route' => 'required|string|unique:developers|max:255',
            'featured_img' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'inner_page_image' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'banner_image' => 'nullable|string|max:255',
            'brochure' => 'nullable|string|max:255',
            'seo.meta_title' => 'required|string|max:255',
            'seo.meta_description' => 'required|string|max:255',
            'seo.schema_markup' => 'nullable|string',
        ]);

        // Prepare the SEO data
        $seoData = [
            'meta_title' => $request->input('seo.meta_title'),
            'meta_description' => $request->input('seo.meta_description'),
            'schema_markup' => $request->input('seo.schema_markup', ''),
        ];

        // Create the developer
        $developer = Developer::create([
            'name' => $request->input('name'),
            'route' => $request->input('route'),
            'featured_img' => $request->input('featured_img'),
            'experience' => $request->input('experience'),
            'banner_image' => $request->input('banner_image'),
            'inner_page_image' => $request->input('inner_page_image'),
            'description' => $request->input('description'),
            'brochure' => $request->input('brochure'),
            'seo' => json_encode($seoData), // Ensure this is included
        ]);

        return response()->json($developer, 201);
    }

    public function update(Request $request, $route)
{
    // Find the developer by route
    $developer = Developer::where('route', $route)->first();
    if (!$developer) {
        return response()->json(['message' => 'Developer not found'], 404);
    }

    // Validate incoming request data
    $validator = Validator::make($request->all(), [
        'name' => 'string|max:255|nullable',
        'featured_img' => 'string|max:255|nullable',
        'experience' => 'string|max:255|nullable',
        'inner_page_image' => 'string|max:255|nullable',
        'description' => 'string|nullable',
        'banner_image' => 'string|max:255|nullable',
        'brochure' => 'string|max:255|nullable',
        'seo.meta_title' => 'string|max:255|nullable',
        'seo.meta_description' => 'string|max:255|nullable',
        'seo.schema_markup' => 'string|nullable',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Update fields based on the request
    $developer->name = $request->input('name', $developer->name);
    $developer->featured_img = $request->input('featured_img', $developer->featured_img);
    $developer->experience = $request->input('experience', $developer->experience);
    $developer->inner_page_image = $request->input('inner_page_image', $developer->inner_page_image);
    $developer->description = $request->input('description', $developer->description);
    $developer->brochure = $request->input('brochure', $developer->brochure);
    $developer->banner_image = $request->input('banner_image', $developer->banner_image);


    // Update the SEO data if it exists in the request
    if ($request->has('seo')) {
        $seoData = [
            'meta_title' => $request->input('seo.meta_title', json_decode($developer->seo, true)['meta_title'] ?? ''),
            'meta_description' => $request->input('seo.meta_description', json_decode($developer->seo, true)['meta_description'] ?? ''),
            'schema_markup' => $request->input('seo.schema_markup', json_decode($developer->seo, true)['schema_markup'] ?? ''),
        ];
        $developer->seo = json_encode($seoData); // Update the seo field
    }

    // Save the updated developer record
    $developer->save();

    // Return the updated developer as a JSON response
    return response()->json($developer, 200);
}

    // Delete a developer
    public function destroy($id)
    {
        $developer = Developer::find($id);
        if (!$developer) {
            return response()->json(['message' => 'Developer not found'], 404);
        }

        $developer->delete();
        return response()->json(['message' => 'Developer deleted successfully'], 204);
    }
}