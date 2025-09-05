<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => ['required', 'string'], // changed 'username' rule to string
            'password' => ['required', 'string'],
        ]);

        // Find admin by username
        $admin = Admin::where('username', $request->username)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Create Sanctum token
        $token = $admin->createToken('admin-api-token')->plainTextToken;

        return response()->json([
            'admin' => [
                'id' => $admin->id,
                'first_name' => $admin->first_name,
                'last_name' => $admin->last_name,
                'username' => $admin->username,
                'email' => $admin->email,
                'is_super' => $admin->is_super,
                'is_active' => $admin->is_active,
                'avatar' => $admin->avatar ? asset('storage/' . $admin->avatar) : null,
            ],
            'token' => $token,
        ]);
    }
}
