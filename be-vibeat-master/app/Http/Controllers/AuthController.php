<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login function
    public function login(Request $request)
    {
        Log::info('Login request', ['request' => $request->all()]);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            Log::info('User role', ['role' => $user->role]); // Log the role being retrieved
            $token = $user->createToken('auth_token')->plainTextToken;
            Log::info('User authenticated', ['user' => $user]);

            $redirectUrl = $user->role === 'admin' ? '/admin' : '/music-dashboard';

            return response()->json(['message' => 'Login successful', 'token' => $token, 'redirect_url' => $redirectUrl], 200);
        }

        Log::warning('Invalid login attempt', ['credentials' => $credentials]);
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Logout function
    public function logout(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $user->tokens()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }

    // Register function
    public function register(Request $request)
    {
        Log::info('Register request', ['request' => $request->all()]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            Log::error('Registration validation failed', ['errors' => $validator->errors()]);
            return response()->json($validator->errors(), 422);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user', // Default role is user
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;
            Log::info('User registered', ['user' => $user]);

            return response()->json(['message' => 'Registration successful', 'token' => $token], 200);
        } catch (\Exception $e) {
            Log::error('Registration error', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'Registration failed'], 500);
        }
    }
}
