<?php

use App\Http\Controllers\Administrator;
use Illuminate\Support\Facades\Route;


Route::post('login', [Administrator\AdminAuthController::class, 'login']);
Route::post('register', [Administrator\AdminAuthController::class, 'register']);

Route::middleware(['auth:sanctum', 'isTopLevelAdmin'])->group(function () {
    Route::patch('update_profile/{administrator}', [Administrator\AccountsManagerController::class, 'update_profile']);
    Route::delete('delete_profile/{administrator}', [Administrator\AccountsManagerController::class, 'delete_profile']);
    Route::get('list_adminstrators/{withDeleted?}', [Administrator\AccountsManagerController::class, 'list_admintrators']);
    Route::get('get_profile/{administrator}', [Administrator\AccountsManagerController::class, 'get_profile']);
    Route::get('get_admin_with_relations/{administrator}', [Administrator\AccountsManagerController::class, 'get_admin_with_relations']);

    Route::resource('attires',  Administrator\AttireTypeController::class);
    Route::resource('services',  Administrator\ServiceController::class);

    Route::get('transactions', [Administrator\TransactionController::class, 'index']);
    Route::get('transactions/{id}', [Administrator\TransactionController::class, 'show']);

});
