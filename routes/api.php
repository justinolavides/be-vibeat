<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\MusicController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [ResetPasswordController::class, 'reset']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user/profile', [UserController::class, 'showProfile']); // Fetch current user profile
    Route::put('/user/profile', [UserController::class, 'updateProfile']); // Update user profile
    Route::delete('/users/{id}', [UserController::class, 'destroy']); // Delete Users

    // Additional routes for music and playlists
    Route::get('/music', [MusicController::class, 'getAllMusic']);
    Route::get('/top-charts', [MusicController::class, 'getTopCharts']);
    Route::get('/listen-again', [MusicController::class, 'getListenAgain']);
    
    
});