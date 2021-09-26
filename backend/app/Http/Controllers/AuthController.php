<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|min:6',
        ]);
        
        // return $request;
        $user = User::create($request->only('name', 'email', 'password'));
        $token = $user->createToken('register-token');
        return ['token' => $token->plainTextToken];
    }

    public function login(Request $request) 
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string|min:6',
        ]);
        
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('login-token');
        return ['token' => $token->plainTextToken];
    }

    public function logout(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        $user->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }
    public function logoutById($id)
    {
        $user = User::find($id);
        return $user->tokens()->get()->pluck('name');
        try {
            $user->tokens()->delete();
            return response()->json(['message' => 'Successfully logged out']);
        } catch (Exception $exception) {
            return response()->json(['error' => 'User not found']);
            // return response()->json(['error' => $exception->getMessage()]);
        }
    }
    public function userTokens($id)
    {
        $user = User::find($id);
        return $user->tokens()->get();
        // return $user->tokens()->get()->pluck('name');
    }
}
