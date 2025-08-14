<?php

namespace App\Http\Controllers\Api\AdminApi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Mail\Message;
use App\Models\Admin;

class AdminAuthController
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
        $admin = Admin::where('email', $request->email)->first();
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $token = $admin->createToken('admin-token')->plainTextToken;
        return response()->json([
            'message' => 'Login successful',
            'admin_token'   => $token,
            'admin'   => $admin
        ], 200);
    }

    public function Forgot(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:admins,email',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $admin = Admin::where('email', $request->email)->first();
        $reset_code = Str::upper(Str::random(6));
        $admin->update(['reset_code' => $reset_code]);
        Mail::raw("Your verification code is: " . $reset_code, function (Message $message) use ($admin) {
            $message->to($admin->email)->subject('Your Verification Code');
        });
        return response()->json([
            'message' => 'Reset Code has been Send into mail',
        ]);
    }

    public function Reset(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'      => 'required|email|exists:admins,email',
            'reset_code' => 'required',
            'password'   => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $admin = Admin::where('email', $request->email)->first();
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
            'image' => 'required|max:2048',
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'date_of_birth' => 'nullable',
            'mobile_number' => 'nullable',
            'address' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('', 'public');
            $admin->image = $imagePath;
        }
        $admin->update($request->only(['name', 'email', 'date_of_birth', 'mobile_number', 'address']));
        $admin->save();
        return response()->json([
            'message' => 'Details updated',
            'admin' => $admin
        ], 200);
    }

    public function ChangePassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $admin = $request->user();
        if (!$admin) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        if (!Hash::check($request->current_password, $admin->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 400);
        }
        $admin->password = Hash::make($request->password);
        $admin->save();
        return response()->json(['message' => 'Password changed successfully'], 200);
    }

    public function Logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

}
