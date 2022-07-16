<?php

use App\Http\Controllers\Administrator;
use Illuminate\Support\Facades\Route;

Route::get('register', [Administrator\AdminAuthController::class, 'register']);
Route::post('register', [Administrator\AdminAuthController::class, 'register']);
Route::post('login', [Administrator\AdminAuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('read', [Administrator\AdminAuthController::class, 'read']);
});
