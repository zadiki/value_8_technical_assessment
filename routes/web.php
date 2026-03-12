<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/password/request', function () {
    return view('password.request');
})->name('password.request');

Route::get('/password/reset', function () {
    return view('password.reset');
})->name('password.reset');

Route::get('/email/verify', function () {
    return view('verification.notice');
})->name('verification.notice');
