<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticatedSessionController;

Route::put('user/{id}/trash', 'UserController@trash');
Route::put('user/{id}/untrash', 'UserController@untrash');

Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);