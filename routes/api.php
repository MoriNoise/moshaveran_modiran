<?php

use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\GroupMessageController;
use Illuminate\Support\Facades\Route;

// Apply ForceJsonApi middleware to all API routes
Route::middleware(['force.json'])->group(function () {

    // Admin API login
    Route::post('login', [AdminAuthController::class, 'login']);

    // Protected routes (requires Sanctum token)
    Route::middleware('auth:sanctum')->get('group-messages', [GroupMessageController::class, 'index']);
});
