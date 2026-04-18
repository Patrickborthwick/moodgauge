<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MoodController;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/register', [AuthController::class, 'Register'])->name('register');
Route::post('/login', [AuthController::class, 'Login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/index', [MoodController::class, 'index'])->name('mood.index');


Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('mood.index');
    } else {
        return view('welcome');
    }
})->name('show.welcome');
