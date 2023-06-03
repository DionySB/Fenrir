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
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\GymController;

Route::get('/', function () {
    return view('home.home');
});

Route::get('/gyms', [GymController::class, 'showGyms'])->name('gyms');

/*<===============================================================================================================================>*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});
/*<===============================================================================================================================>*/
Route::get('/reset-password', [ResetPasswordController::class, 'showEmailForm'])->name('password.email');
Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.send_reset_link');
Route::get('/reset-password/{token}/{email}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

/*<===============================================================================================================================>*/
Route::get('/home', function () {
    return view('home.home');
})->name('home');
/*<===============================================================================================================================>*/
Route::get('/users/{id}/verify-email/{hash}', [UserController::class, 'verifyEmail'])->name('verify.email');
/*<===============================================================================================================================>*/
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed']);
Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
/*<===============================================================================================================================>*/
Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
/*<===============================================================================================================================>*/
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('verified');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('verified');
/*<===============================================================================================================================>*/
Route::get('/', [NavbarController::class, 'home'])->name('home');
Route::get('/about', [NavbarController::class, 'about'])->name('about');
Route::get('/contact', [NavbarController::class, 'contact'])->name('contact');
Route::get('/search', [NavbarController::class, 'search'])->name('search');
Route::get('/newsletter', [NavbarController::class, 'newsletter'])->name('newsletter');


require __DIR__.'/auth.php';
