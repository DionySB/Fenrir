<?php

use Illuminate\Support\Facades\Route;

Route::post('login', 'App\Http\Controllers\LoginController@login');

Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'App\Http\Controllers\LoginController@logout');
});
