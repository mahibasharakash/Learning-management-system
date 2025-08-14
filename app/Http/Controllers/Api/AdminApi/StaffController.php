<?php

namespace App\Http\Controllers\Api\AdminApi;

use App\Models\Staffs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StaffController
{

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $paginate = $request->query('paginate', 0);

        $query = Staffs::query();

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
            'image' => 'nullable|file|image|max:2048',
            'name' => 'required|string',
            'joining_date' => 'nullable',
            'email' => 'required|email|unique:staffs,email',
            'password' => 'required|min:6|confirmed',
            'mobile_number' => 'nullable|string',
            'gender' => 'nullable',
            'designation' => 'nullable',
            'department' => 'nullable',
            'date_of_birth' => 'nullable',
            'educational_qualification' => 'nullable',
            'address' => 'nullable',
            'remove_image' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('', $filename, 'public');
            $validated['image'] = $path;
        }

        $user = Staffs::create($validated);

        return response()->json([
            'message' => 'Staff created successfully',
            'data' => $user,
        ]);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $user = Staffs::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $user = Staffs::findOrFail($id);

        $validated = $request->validate([
            'image' => 'nullable|file|image|max:2048',
            'name' => 'required|string',
            'joining_date' => 'nullable',
            'email' => 'required|email|unique:tutors,email,' . $id,
            'password' => 'required|min:6|confirmed',
            'mobile_number' => 'nullable|string',
            'gender' => 'nullable',
            'designation' => 'nullable',
            'department' => 'nullable',
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
            'message' => 'Staff updated successfully',
            'data' => $user,
        ]);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $user = Staffs::findOrFail($id);

        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();

        return response()->json([
            'message' => 'Staff deleted successfully',
        ]);
    }

    public function clear(): \Illuminate\Http\JsonResponse
    {
        $users = Staffs::all();
        foreach ($users as $user) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
        }

        Staffs::truncate();

        return response()->json([
            'message' => 'All users deleted successfully.',
        ]);
    }

}
