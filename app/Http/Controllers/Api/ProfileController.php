<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getUser()
    {
        // Mengembalikan data pengguna yang terautentikasi
        return response()->json([
            'user' => Auth::user()
        ]);
    }
}
