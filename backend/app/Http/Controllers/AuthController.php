<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * Register User
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|max:255|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('register-token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];
        return \response($response, 201);
    }

     /**
     * Login User
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|max:255',
        ]);

        if(Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            $user = auth()->user();
            $token = $user->createToken('login-token')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token,
            ];
            return \response($response, 201);
        };
        return \response(['error' => 'Login failed']);
    }

    
     /**
     * Logout User
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $user = User::where('email', auth()->user()->email)->first();
        $user->tokens()->delete();
        $response = [
            'user' => $user,
            'message' => "{$user->name} Successfully logged out"
        ];
        return \response($response, 205);
        // return $user;
        // return $user->tokens()->get();
    }

    
    /**
     * Get Currently Logged-in User Tokens
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function userTokens(Request $request, $id)
    {
        return $request;
        $user = User::find($id);
        if($user) {
            return $user->tokens()->get(['id', 'tokenable_id', 'name']);
        }
        $user = User::where('email',$request->email)->first();
        return $user->tokens()->get('id', 'tokenable_id', 'name');
    }
}
