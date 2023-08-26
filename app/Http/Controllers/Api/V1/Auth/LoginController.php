<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\ApiBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends ApiBaseController
{
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email|string|exists:users,email',
            'password'=>[
                'required',
            ],
            'remember' => 'boolean'
        ]);

        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);

        if(!Auth::attempt($credentials,$remember)){
            return $this->sendError("The Provided credentials are not correct",[],422);
        }
        $user = Auth::user();
        $token = $user->createToken($user->name)->plainTextToken;
        return $this->sendResponse([
            'user' => $user,
            'token' => $token
        ],'User successfully logged in.',201);
    }
}
