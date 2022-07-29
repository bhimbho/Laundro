<?php

use App\Http\Controllers\Administrator;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;


Route::post('login', [Administrator\AdminAuthController::class, 'login']);
Route::post('register', [Administrator\AdminAuthController::class, 'register']);
Route::get('roles', [Controllers\RoleController::class, 'index']);

Route::middleware(['auth:sanctum', 'isTopLevelAdmin'])->group(function () {
    Route::patch('update_profile/{administrator}', [Administrator\AccountsManagerController::class, 'update_profile']);
    Route::delete('delete_profile/{administrator}', [Administrator\AccountsManagerController::class, 'delete_profile']);
    Route::get('list_administrators/{withDeleted?}', [Administrator\AccountsManagerController::class, 'list_admintrators']);
    Route::get('get_profile/{administrator}', [Administrator\AccountsManagerController::class, 'get_profile']);
    Route::get('get_admin_with_relations/{administrator}', [Administrator\AccountsManagerController::class, 'get_admin_with_relations']);

    Route::resource('attires',  Administrator\AttireTypeController::class);
    Route::resource('services',  Administrator\ServiceController::class);
    Route::resource('delivery_methods',  Administrator\DeliveryMethodController::class);

    Route::get('transactions', [Administrator\TransactionController::class, 'index']);
    Route::get('transactions/{id}', [Administrator\TransactionController::class, 'show']);

    

});
