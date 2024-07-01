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
                Route::get("/", fn () =>view("components.dashboard.users.dashboard-users"))->name("users");
                Route::get("/create", fn () => view("components.dashboard.users.form-users"))->name("users");
            });

        Route::prefix('/kegiatan')
            ->group(function () {
                Route::get("/", fn () => view("components.dashboard.activity.activity"))->name("index");
                Route::get("/create", fn () => view("components.dashboard.activity.form-activity"))->name("users");
            });

        Route::prefix("/data")->name("data.")
            ->group(function() {
                Route::get("/golongan", fn () => view("pages.masterdata.grade-level"))->name("grade-level");
                Route::get("/instansi", fn () => view("pages.masterdata.institution"))->name("institution");
                Route::get("/pangkat", fn () => view("pages.masterdata.rank"))->name("rank");
                Route::get("/jabatan", fn () => view("pages.masterdata.position"))->name("position");
                Route::get("/jenis-penanaman-modal", fn () => view("pages.masterdata.investment-type"))->name("investment-type");
                Route::get("/jenis-pengawasan", fn () => view("pages.masterdata.observation"))->name("observation");
                Route::get("/kegiatan", fn () => view("pages.masterdata.activity"))->name("activity");
                Route::get("/pendidikan", fn () => view("pages.masterdata.education"))->name("education");
                Route::get("/rekomendasi", fn () => view("pages.masterdata.recommendation"))->name("recommendation");
                Route::get("/skala-bisnis", fn () => view("pages.masterdata.business-scale"))->name("business-scale");
                Route::get("/status-badan-usaha", fn () => view("pages.masterdata.business-entity-type"))->name("business-entity-type");
                Route::get("/sub-sektor", fn () => view("pages.masterdata.sub-sector"))->name("sub-sector");
                Route::get("/unit-kerja", fn () => view("pages.masterdata.department"))->name("department");
                Route::get("/kbli", fn () => view("pages.masterdata.kbli"))->name("kbli");
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
    ->controller(RoleController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'edit');
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
        Route::get('/spv', 'getListSupervisor');
        Route::get('/mgr', 'getListManager');
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

// Data Kabupaten
Route::prefix('districts')
    ->controller(DistrictController::class)
    ->group(function () {
        Route::post('/search', 'search');
        Route::get('/{id?}', 'detail');
    });

// Data Kecamatan
Route::prefix('sub-districts')
    ->controller(SubDistrictController::class)
    ->group(function () {
        Route::post('/search', 'search');
        Route::get('/{id?}', 'detail');
    });

// Data Desa
Route::prefix('villages')
    ->controller(VillageController::class)
    ->group(function () {
        Route::post('/search', 'search');
        Route::get('/{id?}', 'detail');
    });

// Data Kegiatan
Route::prefix('activities')
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
    ->controller(ActivityReportController::class)
    ->group(function () {
        Route::post('/', 'create');
        Route::post('/search', 'search');
        Route::put('/', 'update');
        Route::get('/export', 'export');
        Route::get('/{id?}', 'detail');
    });
