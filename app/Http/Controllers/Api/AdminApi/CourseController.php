<?php

namespace App\Http\Controllers\Api\AdminApi;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController
{

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $paginate = $request->query('paginate', 0);

        $query = Course::with('tutor');

        if ($search = trim($request->query('search', ''))) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('code', 'LIKE', "%{$search}%")
                    ->orWhere('course_duration', 'LIKE', "%{$search}%");
            });
        }

        if ($paginate === 1) {
            $courses = $query->get();
        } else {
            $limit = 20;
            $perPage = (int) $request->query('per_page', $limit);
            if ($perPage < 1) {
                $perPage = $limit;
            }
            $courses = $query->paginate($perPage);
        }

        return response()->json($courses);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'image' => 'nullable|file|image|max:2048',
            'name' => 'required|string',
            'code' => 'required|string',
            'course_details' => 'required|string',
            'from_start' => 'required|string',
            'course_duration' => 'required|string',
            'price' => 'required|string',
            'tutor' => 'nullable',
            'maximum_students' => 'required|string',
            'remove_image' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('', $filename, 'public');
            $validated['image'] = $path;
        }

        $user = Course::create($validated);

        return response()->json([
            'message' => 'Student created successfully',
            'data' => $user,
        ]);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $user = Course::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $user = Course::findOrFail($id);

        $validated = $request->validate([
            'image' => 'nullable|file|image|max:2048',
            'name' => 'required|string',
            'code' => 'required|string',
            'course_details' => 'required|string',
            'from_start' => 'required|string',
            'course_duration' => 'required|string',
            'price' => 'required|string',
            'tutor' => 'nullable',
            'maximum_students' => 'required|string',
            'remove_image' => 'nullable|boolean',
        ]);

        if ($request->has('remove_image') && $request->remove_image) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $validated['image'] = null;
        }

        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $image = $request->file('image');
            $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('', $filename, 'public');
            $validated['image'] = $path;
        }

        $user->update($validated);

        return response()->json([
            'message' => 'Student updated successfully',
            'data' => $user,
        ]);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $user = Course::findOrFail($id);

        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();

        return response()->json([
            'message' => 'Student deleted successfully',
        ]);
    }

    public function clear(): \Illuminate\Http\JsonResponse
    {
        $users = Course::all();
        foreach ($users as $user) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
        }

        Course::truncate();

        return response()->json([
            'message' => 'All users deleted successfully.',
        ]);
    }

}
