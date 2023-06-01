<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
