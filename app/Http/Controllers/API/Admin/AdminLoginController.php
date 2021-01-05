<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();
            $token = $user->createToken('AdminToken')->accessToken;
            return \response()->json(['token' => $token, 'admin' => $user], 200);
        } else {
            return \response()->json(['error' => 'Something went wrong'], 401);
        }
    }

    public function info()
    {
        return Auth::guard('admin-api')->user();
    }

    // admin logout 
    public function logout()
    {
        Auth::guard('admin-api')->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        Auth::guard('admin')->logout();
    }
}
