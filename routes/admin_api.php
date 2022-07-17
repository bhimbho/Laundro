<?php

use App\Http\Controllers\Administrator;
use Illuminate\Support\Facades\Route;


Route::post('login', [Administrator\AdminAuthController::class, 'login']);
Route::middleware(['auth:sanctum', 'isTopLevelAdmin'])->group(function () {
    Route::post('register', [Administrator\AdminAuthController::class, 'register']);
    Route::patch('updateAdminRecord/{administrator}', [Administrator\AdminAuthController::class, 'updateAdminRecord']);
    Route::delete('deleteAdminProfile/{administrator}', [Administrator\AdminAuthController::class, 'deleteAdminProfile']);
});
