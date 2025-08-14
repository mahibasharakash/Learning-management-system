<?php

namespace App\Http\Controllers\Api\AdminApi;

use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController
{

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $paginate = $request->query('paginate', 0);

        $query = Holiday::query();

        if ($search = trim($request->query('search', ''))) {
            $query->where(function ($q) use ($search) {
                $q->where('department_name', 'LIKE', "%{$search}%")
                    ->orWhere('head_of_department', 'LIKE', "%{$search}%");
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
            'type' => 'required|string',
            'start_date' => 'required|string',
            'end_date' => 'required|string',
            'details' => 'required|string',
        ]);

        $data = Holiday::create($validated);

        return response()->json([
            'message' => 'Student created successfully',
            'data' => $data,
        ]);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $data = Holiday::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $data = Holiday::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'type' => 'required|string',
            'start_date' => 'required|string',
            'end_date' => 'required|string',
            'details' => 'required|string',
        ]);

        $data->update($validated);

        return response()->json([
            'message' => 'Student updated successfully',
            'data' => $data,
        ]);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $data = Holiday::findOrFail($id);

        $data->delete();

        return response()->json([
            'message' => 'Student deleted successfully',
        ]);
    }

    public function clear(): \Illuminate\Http\JsonResponse
    {
        Holiday::truncate();
        return response()->json([
            'message' => 'All users deleted successfully.',
        ]);
    }

}
