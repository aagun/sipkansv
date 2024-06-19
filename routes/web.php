<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\GradeLevelController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('roles')
    ->controller(RoleController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/{id}', 'edit');
        Route::delete('/{id}', 'delete');
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
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::delete('/{id}', 'delete');
    });

Route::prefix('institutions')
    ->controller(InstitutionController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::delete('/{id}', 'delete');
    });

Route::prefix('grade-levels')
    ->controller(GradeLevelController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::delete('/{id}', 'delete');
    });

Route::prefix('educations')
    ->controller(EducationController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::delete('/{id}', 'delete');
    });

Route::prefix('users')
    ->controller(UserController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id}', 'detail');
        Route::delete('/{id}', 'delete');
    });
