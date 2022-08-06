<?php

use App\Http\Controllers\Administrator;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Enum\GroupEnum;

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

    Route::post('booking', [Administrator\BookingRecordController::class, 'store']);
    Route::post('remove-booking', [Administrator\BookingRecordController::class, 'delete']); //add middleware to ensure only superadmin can delete

    // Service Method
    Route::get('get-service-method/{hours}/{serviceId}/{group}', [Administrator\ServiceMethodController::class, 'get_service_method_cost']);
    Route::post('store-service-method', [Administrator\ServiceMethodController::class, 'store']);
    Route::delete('service-method/{serviceMethod}', [Administrator\ServiceMethodController::class, 'delete']);
    Route::get('all-service-methods', [Administrator\ServiceMethodController::class, 'index']);
    Route::get('deleted-service-methods', [Administrator\ServiceMethodController::class, 'deleted']);

    //Service Cost
    Route::post('service-cost', [Administrator\ServiceCostController::class, 'store']);
    Route::delete('service-cost/{serviceCost}', [Administrator\ServiceCostController::class, 'delete']);
    Route::get('service-cost/{service}/{attire}', [Administrator\ServiceCostController::class, 'get_service_cost']);

    //group
    Route::get('groups' , function(){
        return response()->json(
            GroupEnum::cases(),
            200
        );
    });
    

});
