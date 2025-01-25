<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'user_type' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['0' => 400, 'error' => 'Validation failed', 'details' => $validator->errors()], 400);
        }

        // Retrieve user by email and user_type
        $user = User::where('email', $request->email)
                    ->where('user_type', $request->user_type)
                    ->first();

        // Check if user exists and password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['0' => 401, 'error' => 'Credentials do not match'], 401);
        }

        // Create a new access token
        $tokenResult = $user->createToken('API_Token');
        $token = $tokenResult->accessToken;

        // Return response with user details
        return response()->json([
            '0' => 200,
            'success' => 'Logged in successfully',
            'user' => [
                'id' => $user->id,
                'first_name' => 'Admin', // Assuming first_name, can be retrieved if stored
                'last_name' => 'admin',  // Assuming last_name, can be retrieved if stored
                'email' => $user->email,
                'mobile' => '0555532701', // Assuming mobile, modify based on your data
                'email_verified_at' => $user->email_verified_at,
                'user_type' => $user->user_type,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at
            ],
            'token' => $token
        ], 200)->header('x_auth_token', $token)
          ->header('access-control-expose-headers', 'x_auth_token');
    }

    public function registerUser(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'user_type' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['0' => 400, 'error' => 'Validation failed', 'details' => $validator->errors()], 400);
        }

        // Create new user
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
        ]);

        // Create a new access token
        $tokenResult = $user->createToken('API_Token');
        $token = $tokenResult->accessToken;

        // Return response with user details
        return response()->json([
            '0' => 201,
            'success' => 'User registered successfully',
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'user_type' => $user->user_type,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at
            ],
            'token' => $token
        ], 201)->header('x_auth_token', $token)
          ->header('access-control-expose-headers', 'x_auth_token');
    }
}