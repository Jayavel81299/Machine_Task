<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/projects', App\Http\Controllers\ProjectController::class);
    Route::resource('/users', App\Http\Controllers\UserController::class);
    Route::resource('/tasks', App\Http\Controllers\TaskController::class);
    Route::post('/get-members', [App\Http\Controllers\TaskController::class, 'getMembers'])->name('getmembers');
});
