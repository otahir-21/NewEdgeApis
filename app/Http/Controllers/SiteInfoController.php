<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiteInfoRequest;
use App\Models\SiteInfo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiteInfoController extends Controller
{
    public function index(): JsonResponse
    {
        $siteInfo = SiteInfo::all(); // Fetch all records

        return response()->json($siteInfo);
    }
    // Store new site information
    public function store(StoreSiteInfoRequest $request): JsonResponse
    {
        $siteInfo = SiteInfo::create($request->validated());
        return response()->json($siteInfo, 201);
    }

    // Retrieve site information
    public function show(): JsonResponse
    {
        $siteInfo = SiteInfo::first();

        if (!$siteInfo) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($siteInfo);
    }

    // Update existing site information
    public function update(StoreSiteInfoRequest $request, $id): JsonResponse
    {
        $siteInfo = SiteInfo::find($id);

        if (!$siteInfo) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $siteInfo->update($request->validated());
        return response()->json($siteInfo);
    }

    // Delete site information
    public function destroy($id): JsonResponse
    {
        $siteInfo = SiteInfo::find($id);

        if (!$siteInfo) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $siteInfo->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}