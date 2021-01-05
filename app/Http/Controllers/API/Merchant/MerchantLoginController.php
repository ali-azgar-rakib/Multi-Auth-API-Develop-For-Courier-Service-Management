<?php

namespace App\Http\Controllers\API\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerchantLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required | email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::guard('merchant')->attempt($credentials)) {
            $user = Auth::guard('merchant')->user();
            $token = $user->createToken('merchantToken')->accessToken;
            return \response()->json($token, 200);
        } else {
            return \response()->json('Some thing went wrong', 401);
        }
    }


    // info 
    public function info()
    {
        return Auth::guard('merchant-api')->user();
    }

    // logout 
    public function logout()
    {
        Auth::guard('merchant-api')->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        Auth::guard('merchant')->logout();
    }
}
