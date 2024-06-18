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
