<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\EmailVerificationPromptController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ConfirmablePasswordController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('auth')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
});

