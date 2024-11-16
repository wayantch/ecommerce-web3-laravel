<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Login successful',
                'user' => auth()->user()
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }
}
