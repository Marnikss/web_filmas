<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RezisoriController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/rezisori', [RezisoriController::class, 'list']);
Route::get('/rezisori/create', [RezisoriController::class, 'create']);
Route::post('/rezisori/put', [RezisoriController::class, 'put']);
Route::get('/rezisori/update/{rezisori}', [RezisoriController::class, 'update']);
Route::post('/rezisori/patch/{rezisori}', [RezisoriController::class, 'patch']);
Route::post('/rezisori/delete/{rezisori}', [RezisoriController::class, 'delete']);

// Auth routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);
