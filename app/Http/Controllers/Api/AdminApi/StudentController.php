<?php

namespace App\Http\Controllers\Api\AdminApi;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentController
{

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $paginate = $request->query('paginate', 0);

        $query = Student::query();

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('mobile_number', 'LIKE', "%{$search}%");
            });
        }

        if ($paginate == 1) {
            $users = $query->get();
        } else {
            $limit = 20;
            $perPage = (int) $request->query('per_page', $limit);
            if ($perPage < 1) {
                $perPage = $limit;
            }
            $users = $query->paginate($perPage);
        }

        return response()->json($users);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'image' => 'nullable|file|image|max:2048',
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6|confirmed',
            'registration_date' => 'required|string',
            'roll_id' => 'required|string',
            'course' => 'required|string',
            'gender' => 'required|string',
            'mobile_number' => 'required|string',
            'blood_group' => 'required|string',
            'date_of_birth' => 'required|string',
            'parent_name' => 'required|string',
            'parent_mobile_number' => 'required|string',
            'address' => 'required|string',
            'remove_image' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('', $filename, 'public');
            $validated['image'] = $path;
        }

        $user = Student::create($validated);

        return response()->json([
            'message' => 'Student created successfully',
            'data' => $user,
        ]);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $user = Student::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $user = Student::findOrFail($id);

        $validated = $request->validate([
            'image' => 'nullable|file|image|max:2048',
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email,' . $id,
            'password' => 'required|min:6|confirmed',
            'registration_date' => 'required|string',
            'roll_id' => 'required|string',
            'course' => 'required|string',
            'gender' => 'required|string',
            'mobile_number' => 'required|string',
            'blood_group' => 'required|string',
            'date_of_birth' => 'required|string',
            'parent_name' => 'required|string',
            'parent_mobile_number' => 'required|string',
            'address' => 'required|string',
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
        $user = Student::findOrFail($id);

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
        $users = Student::all();
        foreach ($users as $user) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
        }

        Student::truncate();

        return response()->json([
            'message' => 'All users deleted successfully.',
        ]);
    }

}
