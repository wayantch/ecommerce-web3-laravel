<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Buat token dengan Sanctum
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                "message" => "Login successful",
                "user" => $user,
                "token" => $token
            ], 200);
        }

        return response()->json([
            "message" => "Invalid credentials"
        ], 401);
    }
}
