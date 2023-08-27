<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\ApiBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class LoginController
 * @package App\Http\Controllers\Api\V1\Auth
 */
class LoginController extends ApiBaseController
{
    /**
     * Handle user login.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validate login credentials from the request
        $credentials = $request->validate([
            'email' => 'required|email|string|exists:users,email',
            'password' => [
                'required',
            ],
            'remember' => 'boolean'
        ]);

        // Extract 'remember' field from credentials, if present
        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);

        // Attempt to authenticate user with provided credentials
        if (!Auth::attempt($credentials, $remember)) {
            return $this->sendError("The provided credentials are not correct", [], 422);
        }

        // Get the authenticated user
        $user = Auth::user();

        // Create a new API token for the user
        $token = $user->createToken($user->name)->plainTextToken;

        // Return successful login response
        return $this->sendResponse([
            'user' => $user,
            'token' => $token
        ], 'User successfully logged in.', 201);
    }
}
