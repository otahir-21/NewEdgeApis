<?php

namespace App\Http\Controllers;

use App\Models\VideoContent;
use Illuminate\Http\Request;

class VideoContentController extends Controller
{
    // Create a new video content
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'video_url' => 'nullable|string',
            'video_thumbnail' => 'required|string',
        ]);

        $videoContent = VideoContent::create($validatedData);

        return response()->json($videoContent, 201);
    }

    // Get a single video content by ID
    public function show($id)
    {
        $videoContent = VideoContent::findOrFail($id);

        return response()->json($videoContent);
    }

    // Get all video contents
    public function index()
    {
        $videoContents = VideoContent::all();

        return response()->json($videoContents);
    }

    // Update a specific video content
    public function update(Request $request, $id)
    {
        $videoContent = VideoContent::findOrFail($id);

        $validatedData = $request->validate([
            'video_url' => 'required|url',
            'video_thumbnail' => 'required|string',
        ]);

        $videoContent->update($validatedData);

        return response()->json($videoContent);
    }

    // Delete a specific video content
    public function destroy($id)
    {
        $videoContent = VideoContent::findOrFail($id);
        $videoContent->delete();

        return response()->json(['message' => 'Video content deleted successfully']);
    }
}