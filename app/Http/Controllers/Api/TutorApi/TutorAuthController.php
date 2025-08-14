<?php

namespace App\Http\Controllers\Api\TutorApi;

use App\Models\Tutor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TutorAuthController
{

    public function Login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $admin = Tutor::where('email', $request->email)->first();
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $token = $admin->createToken('tutor-token')->plainTextToken;
        return response()->json([
            'message' => 'Login successful',
            'token'   => $token,
            'admin'   => $admin
        ], 200);
    }

    public function Registration(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $admin = Tutor::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $admin->createToken('tutor-token')->plainTextToken;
        return response()->json([
            'message' => 'Registration successful',
            'token'   => $token,
            'admin'   => $admin
        ], 201);
    }

    public function Forgot(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:tutors,email'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        return response()->json(['message' => 'Password reset instructions sent'], 200);
    }

    public function Reset(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|exists:admins,email',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $admin = Tutor::where('email', $request->email)->first();
        $admin->update(['password' => Hash::make($request->password)]);
        return response()->json(['message' => 'Password reset successful'], 200);
    }

    public function Details(Request $request): JsonResponse
    {
        return response()->json($request->user(), 200);
    }

    public function ChangeDetails(Request $request): JsonResponse
    {
        $admin = $request->user();
        $validator = Validator::make($request->all(), [
            'name'  => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:admins,email,' . $admin->id,
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $admin->update($request->only(['name', 'email']));
        return response()->json(['message' => 'Details updated', 'admin' => $admin], 200);
    }

    public function ChangePassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'password'     => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $admin = $request->user();
        if (!Hash::check($request->old_password, $admin->password)) {
            return response()->json(['message' => 'Old password is incorrect'], 400);
        }
        $admin->update(['password' => Hash::make($request->password)]);
        return response()->json(['message' => 'Password changed successfully'], 200);
    }

    public function Logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

}
