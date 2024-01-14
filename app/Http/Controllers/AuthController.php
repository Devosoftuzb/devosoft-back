<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request) 
    {
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return response()->json([
            'token' => $user->createToken($request->email)->plainTextToken,
        ]);
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken($request->name)->plainTextToken;

        return response()->json([
            'user' => $user, 
            'token' => $token, 
        ]);

    }


    public function logout(Request $request) 
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "Logged out"
        ]);
    }
}
