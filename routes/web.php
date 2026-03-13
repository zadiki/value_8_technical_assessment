<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Display the Login Form
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    // Handle the Register Submission
    Route::post('register', [AuthenticatedSessionController::class, 'register']);

    // Handle the Login Submission
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('resetpassword', function () {
        return view('auth.reset-password');
    })->name('reset-password');
    // Handle password reset submission
    Route::post('resetpassword', function () {
        // Handle password reset logic here
    })->name('reset-password.post');
});

Route::middleware('auth')->group(function () {
    // The Dashboard (where users go after login)
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // Handle Logout
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    Route::get('register', [AuthenticatedSessionController::class, 'createRegistration'])
        ->name('register');
});
