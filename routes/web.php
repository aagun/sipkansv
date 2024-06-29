<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
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
use App\Http\Controllers\VillageController;
use App\Http\Controllers\ActivityReportController;
use App\Http\Controllers\ActivityController;

Route::get('/', fn () => redirect('/login'));

Route::prefix("/dashboard")
    ->name("dashboard.")
    ->group(function () {
        Route::prefix('/users')
            ->group(function () {
                Route::get("/", fn () => view("components.dashboard.dashboard-layout"))->name("index");
                Route::get("/users", fn () =>view("components.dashboard.users.dashboard-users"))->name("users");
                Route::get("/users/create", fn () => view("components.dashboard.users.form-users"))->name("users");
            });

        Route::prefix("/data")->name("data.")
            ->group(function() {
                Route::get("/pangkat", fn () => view("components.dashboard.masterdata.rank"))->name("ranks");
                Route::get("/jabatan", fn () => view("components.dashboard.masterdata.position"))->name("position");
                Route::get("/golongan-ruang", fn () => view("components.dashboard.masterdata.comity"))->name("comity");
                Route::get("/pendidikan", fn () => view("components.dashboard.masterdata.education"))->name("education");
                Route::get("/unit-kerja", fn () => view("components.dashboard.masterdata.department"))->name("department");
                Route::get("/instansi", fn () => view("components.dashboard.masterdata.institution"))->name("institution");
            });

    });

Route::name("auth.")
    ->group(function () {
        Route::get("/login", fn () => view("login"))->name("login");
        Route::post("/login", function() {
            $data = ["username" => "admin", "password" => "123456"];
            $admin = Arr::first($data, fn($d) => $d == request()->input("username"));
            if ($admin == null ) {
                return redirect()->back()->with("error", "Username yang anda masukkan salah!");
            }

            if ($data["password"] != request()->input("password") ) {
                return redirect()->back()->with("error", "Password yang anda masukkan salah!");
            }

            Session::put(["isLoged" => true]);
            Session::put(["token" => "124fj154KL132cI06P541pP20541"]);

            return redirect()->route("dashboard.index");
        })->name("loginForm");
    });

Route::prefix('roles')
    ->middleware('jwt.auth')
    ->controller(RoleController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    }); 

// Jabatan
Route::prefix('positions')
    ->middleware('jwt.auth')
    ->controller(PositionController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

// Pangkat
Route::prefix('ranks')
    ->middleware('jwt.auth')
    ->controller(RankController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

// Unit Kerja
Route::prefix('departments')
    ->middleware('jwt.auth')
    ->controller(DepartmentController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

// Instansi
Route::prefix('institutions')
    ->middleware('jwt.auth')
    ->controller(InstitutionController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

// Golongan
Route::prefix('grade-levels')
    ->middleware('jwt.auth')
    ->controller(GradeLevelController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

// Pendidikan
Route::prefix('educations')
    ->middleware('jwt.auth')
    ->controller(EducationController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

// Pengguna
Route::prefix('users')
    ->middleware('jwt.auth')
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
    ->middleware('jwt.auth')
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
    ->middleware('jwt.auth')
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
    ->middleware('jwt.auth')
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
    ->middleware('jwt.auth')
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
    ->middleware('jwt.auth')
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
    ->middleware('jwt.auth')
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
    ->middleware('jwt.auth')
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
    ->middleware('jwt.auth')
    ->controller(ProvinceController::class)
    ->group(function () {
        Route::post('/search', 'search');
        Route::get('/{id?}', 'detail');
    });

// Data Kabupaten
Route::prefix('districts')
    ->middleware('jwt.auth')
    ->controller(DistrictController::class)
    ->group(function () {
        Route::post('/search', 'search');
        Route::get('/{id?}', 'detail');
    });

// Data Kecamatan
Route::prefix('sub-districts')
    ->middleware('jwt.auth')
    ->controller(SubDistrictController::class)
    ->group(function () {
        Route::post('/search', 'search');
        Route::get('/{id?}', 'detail');
    });

// Data Desa
Route::prefix('villages')
    ->middleware('jwt.auth')
    ->controller(VillageController::class)
    ->group(function () {
        Route::post('/search', 'search');
        Route::get('/{id?}', 'detail');
    });

// Data Kegiatan
Route::prefix('activities')
    ->middleware('jwt.auth')
    ->controller(ActivityController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
        Route::delete('/{id?}', 'delete');
    });

// Laporan Kegiatan
Route::prefix('activity-reports')
    ->middleware('jwt.auth')
    ->controller(ActivityReportController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/{id?}', 'detail');
    });
