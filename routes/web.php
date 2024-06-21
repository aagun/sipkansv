<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("/dashboard")
    ->name("dashboard.")
    ->group(function () {
        Route::get("/", function() {
            return view("components.dashboard.dashboard-layout");
        })->name("index");

        Route::get("/users", function() {
            return view("components.dashboard.users.dashboard-users");
        })->name("users");
        Route::get("/users/create", function() {
            return view("components.dashboard.users.form-users");
        })->name("users");
        Route::post("/users/create", function() {
            $request = request()->all();

            if ($request["password"] != $request["confirm-password"]) {
                return redirect()->back()->with("error", "Password tidak sama");
            }
        })->name("users");

        Route::prefix("/data")
        ->name("data.")
        ->group(function() {
            Route::get("/pangkat", function() {
                return view("components.dashboard.masterdata.rank");
            })->name("ranks");
            Route::get("/jabatan", function() {
                return view("components.dashboard.masterdata.position");
            })->name("position");
            Route::get("/golongan-ruang", function() {
                return view("components.dashboard.masterdata.comity");
            })->name("comity");
            Route::get("/pendidikan", function() {
                return view("components.dashboard.masterdata.education");
            })->name("education");
            Route::get("/unit-kerja", function() {
                return view("components.dashboard.masterdata.department");
            })->name("department");
            Route::get("/instansi", function() {
                return view("components.dashboard.masterdata.institution");
            })->name("institution");
        });
        
    });

Route::name("auth.")
    ->group(function () {
        Route::get("/login", function() {
            return view("login");
        })->name("login");
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
