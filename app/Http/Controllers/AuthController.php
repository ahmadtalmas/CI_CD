<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        dd($request->all());

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'invalid credentials',
            ], 401);
        }

        $user = Auth::user();

        return response()->json([
            'message' => 'login successfully',
            'user' => $user,
        ]);
    }
}
