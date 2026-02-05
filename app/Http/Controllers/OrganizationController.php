<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return response()->json($organizations);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'website' => 'nullable|url',
            'logo_url' => 'nullable|url',
            'phone' => 'nullable|string|max:50',
            'social_links' => 'nullable|array',
        ]);

        $organization = Organization::create($data);

        return response()->json($organization, 201);
    }

    public function show(Organization $organization)
    {
        return response()->json($organization);
    }

    public function update(Request $request, Organization $organization)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'website' => 'nullable|url',
            'logo_url' => 'nullable|url',
            'phone' => 'nullable|string|max:50',
            'social_links' => 'nullable|array',
        ]);

        $organization->update($data);

        return response()->json($organization);
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();
        return response()->json(null, 204);
    }
}

