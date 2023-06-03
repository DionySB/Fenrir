<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\Api\AuthController;

Route::controller(AuthController::class)->group(function () {
  Route::post('signin', 'signin');
  Route::post('signup', 'signup');
  Route::get('logout', 'logout')->middleware('auth:sanctum');
});

Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'create']);
Route::put('users/{id}/trash', [UserController::class, 'trash']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::put('users/{id}/untrash', [UserController::class, 'untrash']);
Route::delete('users/{id}', [UserController::class, 'destroy']);

Route::get('addresses', [AddressController::class, 'index']);
Route::get('address/{id}', [AddressController::class, 'show']);
Route::post('addresses', [AddressController::class, 'create']);
Route::put('addresses/{id}/trash', [AddressController::class, 'trash']);
Route::put('addresses/{id}', [AddressController::class, 'update']);
Route::put('addresses/{id}/untrash', [AddressController::class, 'untrash']);
Route::delete('addresses/{id}', [AddressController::class, 'destroy']);

Route::get('gyms', [GymController::class, 'index']);
Route::get('gyms/{id}', [GymController::class, 'show']);
Route::post('gyms', [GymController::class, 'create']);
Route::put('gyms/{id}/trash', [GymController::class, 'trash']);
Route::put('gyms/{id}', [GymController::class, 'update']);
Route::put('gyms/{id}/untrash', [GymController::class, 'untrash']);
Route::delete('gyms/{id}', [GymController::class, 'destroy']);
