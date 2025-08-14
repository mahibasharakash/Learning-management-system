<?php

namespace App\Http\Controllers\Api\AdminApi;

use App\Models\LibraryAssets;
use Illuminate\Http\Request;

class LibraryAssetsController
{

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $paginate = $request->query('paginate', 0);

        $query = LibraryAssets::query();

        if ($search = trim($request->query('search', ''))) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('subject', 'LIKE', "%{$search}%")
                    ->orWhere('author_name', 'LIKE', "%{$search}%");
            });
        }

        if ($paginate === 1) {
            $data = $query->get();
        } else {
            $limit = 20;
            $perPage = (int) $request->query('per_page', $limit);
            if ($perPage < 1) {
                $perPage = $limit;
            }
            $data = $query->paginate($perPage);
        }

        return response()->json($data);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'subject' => 'required|string',
            'author_name' => 'required|string',
            'publish_date' => 'required|string',
            'department' => 'nullable',
            'asset_type' => 'required|string',
            'purchase_date' => 'required|string',
            'price' => 'required|string',
            'status' => 'required|string',
            'asset_details' => 'required|string',
        ]);

        $data = LibraryAssets::create($validated);

        return response()->json([
            'message' => 'Student created successfully',
            'data' => $data,
        ]);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $data = LibraryAssets::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $data = LibraryAssets::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'subject' => 'required|string',
            'author_name' => 'required|string',
            'publish_date' => 'required|string',
            'department' => 'nullable',
            'asset_type' => 'required|string',
            'purchase_date' => 'required|string',
            'price' => 'required|string',
            'status' => 'required|string',
            'asset_details' => 'required|string',
        ]);

        $data->update($validated);

        return response()->json([
            'message' => 'Student updated successfully',
            'data' => $data,
        ]);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $data = LibraryAssets::findOrFail($id);

        $data->delete();

        return response()->json([
            'message' => 'Student deleted successfully',
        ]);
    }

    public function clear(): \Illuminate\Http\JsonResponse
    {
        LibraryAssets::truncate();
        return response()->json([
            'message' => 'All users deleted successfully.',
        ]);
    }

}
