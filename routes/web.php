<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodolistController;

/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD (Protected With SessionAuth)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    // File view yang kamu punya adalah resources/views/dashboard.blade.php
    return view('dashboard');
})->middleware('sessionAuth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| TODO CRUD (Protected)
|--------------------------------------------------------------------------
*/
// Semua operasi CRUD todo dilindungi oleh middleware sessionAuth
Route::resource('todos', TodolistController::class)->middleware('sessionAuth');

// Route khusus untuk toggle status (selesai / belum selesai)
Route::post('/todos/{id}/toggle', [TodolistController::class, 'toggle'])
    ->name('todos.toggle')
    ->middleware('sessionAuth');