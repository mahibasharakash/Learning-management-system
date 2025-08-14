<?php

namespace App\Http\Controllers\Api\AdminApi;

use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TutorController
{

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $paginate = $request->query('paginate', 0);

        $query = Tutor::query();

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone_number', 'LIKE', "%{$search}%");
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
            'name' => 'required|string',
            'email' => 'required|email|unique:tutors,email',
            'password' => 'required|min:6|confirmed',
            'mobile_number' => 'nullable|string',
            'image' => 'nullable|file|image|max:2048',
            'gender' => 'nullable',
            'department' => 'nullable',
            'designation' => 'nullable',
            'joining_date' => 'nullable',
            'date_of_birth' => 'nullable',
            'address' => 'nullable',
            'educational_qualification' => 'nullable',
            'remove_image' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('', $filename, 'public');
            $validated['image'] = $path;
        }

        $user = Tutor::create($validated);

        return response()->json([
            'message' => 'Tutor created successfully',
            'data' => $user,
        ]);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $user = Tutor::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $user = Tutor::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:tutors,email,' . $id,
            'password' => 'required|min:6|confirmed',
            'mobile_number' => 'nullable|string',
            'image' => 'nullable|file|image|max:2048',
            'gender' => 'nullable',
            'department' => 'nullable',
            'designation' => 'nullable',
            'joining_date' => 'nullable',
            'date_of_birth' => 'nullable',
            'educational_qualification' => 'nullable',
            'address' => 'nullable',
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
            'message' => 'Tutor updated successfully',
            'data' => $user,
        ]);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $user = Tutor::findOrFail($id);

        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();

        return response()->json([
            'message' => 'Tutor deleted successfully',
        ]);
    }

    public function clear(): \Illuminate\Http\JsonResponse
    {
        $users = Tutor::all();
        foreach ($users as $user) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
        }

        Tutor::truncate();

        return response()->json([
            'message' => 'All users deleted successfully.',
        ]);
    }

}
