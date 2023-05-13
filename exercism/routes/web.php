<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

// Rotas de autenticação
Route::get('/login', 'Auth\AuthenticatedSessionController@create')->name('login');
Route::post('/login', 'Auth\AuthenticatedSessionController@store');
Route::post('/logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');

// Rotas de registro
Route::get('/register', 'Auth\RegisteredUserController@create')->name('register');
Route::post('/register', 'Auth\RegisteredUserController@store');

// Rotas de recuperação de senha
Route::get('/forgot-password', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/forgot-password', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/reset-password/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/reset-password', 'Auth\ResetPasswordController@reset')->name('password.update');

// Rotas de verificação de email
Route::get('/email/verify', 'Auth\EmailVerificationPromptController@__invoke')->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', 'Auth\VerifyEmailController@__invoke')->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');
Route::post('/email/verification-notification', 'Auth\EmailVerificationNotificationController@__invoke')->middleware(['auth', 'throttle:6,1'])->name('verification.send');


