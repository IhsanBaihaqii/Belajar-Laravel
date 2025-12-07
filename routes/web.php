<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Fungsi Login
Route::get('/login', [LoginController::class, "index"])->name("login.index");
Route::post('/login', [LoginController::class, "proses"])->name("login.proses");

// Fungsi Logout
Route::get('/logout', [LogoutController::class, "index"])->name("logout.index");
