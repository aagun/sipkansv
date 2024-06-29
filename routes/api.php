<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// auth jwt
Route::group([
    'prefix' => 'auth',
    'middleware' => 'api'
], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::post('/me', [AuthController::class, 'me']);
    });
});
