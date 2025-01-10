<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Use the paginate method to paginate users, with a default of 10 users per page
        $users = User::paginate(10);

        // Return the paginated response
        return response()->json($users);
    }


    /**
     * Fetch current user profile.
     */
    public function showProfile()
    {
        return response()->json(Auth::user());
    }

    /**
     * Update user profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $user->update($request->only('name', 'email', 'bio', 'avatar'));

        return response()->json(['message' => 'Profile updated successfully', 'user' => $user]);
    }
}
