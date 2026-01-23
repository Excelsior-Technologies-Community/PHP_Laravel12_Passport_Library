<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;


Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);


Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth')->group(function () {
Route::get('/dashboard', [AuthController::class, 'dashboard']);
Route::get('/logout', [AuthController::class, 'logout']);
});

Route::get('/', function () {
    return view('welcome');
});
