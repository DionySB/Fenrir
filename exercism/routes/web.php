<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\EmailVerificationPromptController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ConfirmablePasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VerificationController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home.home');
})->name('home');

// Login of user
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Reset Password
Route::get('/password/request', [ResetPasswordController::class, 'showResetForm'])->name('password.request');
Route::post('/password/email', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Register of user
Route::get('/users/{id}/verify-email/{hash}', [UserController::class, 'verifyEmail'])->name('verify.email');

Route::middleware(['auth', 'profile.verification'])->group(function () {
Route::middleware('auth')->group(function () {
        Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed']);
        Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

        Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
        Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::middleware('verified')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        });
    });
});
require __DIR__.'/auth.php';
