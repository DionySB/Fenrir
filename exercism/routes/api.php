<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Rotas de autenticação
Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');

// Rotas de usuários
Route::middleware('auth:sanctum')->get('/users', 'UserController@index');
Route::middleware('auth:sanctum')->get('/users/{id}', 'UserController@show');
Route::middleware('auth:sanctum')->put('/users/{id}', 'UserController@update');
Route::middleware('auth:sanctum')->delete('/users/{id}', 'UserController@destroy');

// Rota de logout
Route::middleware('auth:sanctum')->post('/logout', 'Auth\LoginController@logout');

