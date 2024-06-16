<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\DepartmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('roles')
    ->controller(RoleController::class)
    ->group(function () {
        Route::post('/', 'createRole');
        Route::post('/search', 'searchRole');
        Route::put('/{id}', 'editRole');
        Route::delete('/{id}', 'deleteRole');
    });

Route::prefix('positions')
    ->controller(PositionController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::delete('/{id}', 'delete');
    });

Route::prefix('ranks')
    ->controller(RankController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::delete('/{id}', 'delete');
    });

Route::prefix('departments')
    ->controller(DepartmentController::class)
    ->group(function () {
        Route::post('/', 'create');
    });
