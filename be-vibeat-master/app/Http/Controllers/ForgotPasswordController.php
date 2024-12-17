<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Check if the email exists in the users' list
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            Log::warning('Failed to send password reset link - email not found', ['email' => $request->email]);
            return response()->json(['message' => 'Failed to send password reset email. Please try again.'], 400);
        }

        // No need to actually send the reset link, just for simulation
        return response()->json(['message' => 'Valid email. Redirecting...'], 200);
    }
}
