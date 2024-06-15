<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PositionController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('roles')
    ->controller(RoleController::class)
    ->group(function () {
        Route::post('/', 'createRole');
        Route::post('/search', 'searchRole');
        Route::put('/{id}', 'editRole');
        Route::delete('/{id}', 'updateRole');
    });

Route::prefix('positions')
    ->controller(PositionController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::put('/', 'update');
    });
