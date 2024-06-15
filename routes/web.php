<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

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
