<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use Illuminate\Http\Request;

class CredentialController extends Controller
{
    // Get all credentials
    public function index()
    {
        return response()->json(Credential::all(), 200);
    }

    // Get a single credential
    public function show($id)
    {
        $credential = Credential::find($id);
        if (!$credential) {
            return response()->json(['message' => 'Credential not found'], 404);
        }
        return response()->json($credential, 200);
    }

    // Create a new credential
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'credential' => 'required|string',
        ]);

        $credential = Credential::create($validated);
        return response()->json($credential, 201);
    }

    // Update an existing credential
    public function update(Request $request, $id)
    {
        $credential = Credential::find($id);
        if (!$credential) {
            return response()->json(['message' => 'Credential not found'], 404);
        }

        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'credential' => 'required|string',
        ]);

        $credential->update($validated);
        return response()->json($credential, 200);
    }

    // Delete a credential
    public function destroy($id)
    {
        $credential = Credential::find($id);
        if (!$credential) {
            return response()->json(['message' => 'Credential not found'], 404);
        }

        $credential->delete();
        return response()->json(['message' => 'Credential deleted successfully'], 200);
    }
}
