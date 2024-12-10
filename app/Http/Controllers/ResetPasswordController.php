<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Check if the email exists in the users' list
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            Log::warning('Password reset failed - user not found', ['email' => $request->email]);
            return response()->json(['message' => 'Failed to reset password. Please try again.'], 400);
        }

        // Update the user's password
        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();

        Log::info('Password reset successful', ['email' => $request->email]);
        return response()->json(['message' => 'Password has been reset successfully. Returning to the login page...'], 200);
    }
}
