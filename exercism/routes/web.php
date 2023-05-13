<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\EmailVerificationPromptController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ConfirmablePasswordController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', AuthenticatedSessionController::class)->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                    ->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                    ->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                    ->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])
                    ->name('password.update');

    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                    ->name('verification.notice');
    Route::get('/verify-email/{id}/{hash}', [EmailVerificationController::class, '__invoke'])
                    ->middleware(['signed', 'throttle:6,1'])
                    ->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'store'])
                    ->middleware(['throttle:6,1'])
                    ->name('verification.send');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware(['auth'])
                ->name('logout');
