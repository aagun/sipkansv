<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\RoleController;

// auth jwt
Route::group([
    'prefix' => 'auth',
    'middleware' => 'api'
], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::post('/me', [AuthController::class, 'me']);
    });
});

// Route::prefix('roles')
// ->controller(RoleController::class)
// ->group(function () {
//     Route::middleware('auth:api')->group(function () {
//         Route::post('/', 'create');
//         Route::post('/search', 'search');
//         Route::put('/', 'edit');
//         Route::get('/{id?}', 'detail');
//         Route::delete('/{id?}', 'delete');
//     });
// });