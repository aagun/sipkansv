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
use App\Http\Controllers\InvestmentTypeController;
use App\Http\Controllers\BusinessEntityTypeController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\ObservationController;
use App\Http\Controllers\SubSectorController;
use App\Http\Controllers\KbliController;
use App\Http\Controllers\BusinessScaleController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\SubDistrictController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('roles')
    ->controller(RoleController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/{id?}', 'edit');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

Route::prefix('positions')
    ->controller(PositionController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

Route::prefix('ranks')
    ->controller(RankController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

Route::prefix('departments')
    ->controller(DepartmentController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

Route::prefix('institutions')
    ->controller(InstitutionController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

Route::prefix('grade-levels')
    ->controller(GradeLevelController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

Route::prefix('educations')
    ->controller(EducationController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
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

// Jesni Penanaman Modal
Route::prefix('investment-types')
    ->controller(InvestmentTypeController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

// Status Badan Usaha
Route::prefix('bet')
    ->controller(BusinessEntityTypeController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

// Jenis Rekomendasi
Route::prefix('recommendations')
    ->controller(RecommendationController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

// Jenis Pengawasan
Route::prefix('observations')
    ->controller(ObservationController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

// Sub Sektor
Route::prefix('sub-sectors')
    ->controller(SubSectorController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

// KBLI
Route::prefix('kblis')
    ->controller(KbliController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

// Skala Bisnis
Route::prefix('business-scales')
    ->controller(BusinessScaleController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

// Data Provinsi
Route::prefix('provinces')
    ->controller(ProvinceController::class)
    ->group(function () {
        Route::post('/search', 'search');
        Route::get('/{id?}', 'detail');
    });

Route::prefix('districts')
    ->controller(DistrictController::class)
    ->group(function () {
        Route::post('/search', 'search');
        Route::get('/{id?}', 'detail');
    });

Route::prefix('sub-districts')
    ->controller(SubDistrictController::class)
    ->group(function () {
        Route::post('/search', 'search');
        Route::get('/{id?}', 'detail');
    });


