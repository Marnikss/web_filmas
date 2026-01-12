<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RezisoriController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmaController;
use App\Http\Controllers\KategorijaController;
use App\Http\Controllers\DataController;

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

// Filmas routes
Route::get('/filmas', [FilmaController::class, 'list']);
Route::get('/filmas/create', [FilmaController::class, 'create']);
Route::post('/filmas/put', [FilmaController::class, 'put']);
Route::get('/filmas/update/{filmas}', [FilmaController::class, 'update']);
Route::post('/filmas/patch/{filmas}', [FilmaController::class, 'patch']);
Route::post('/filmas/delete/{filmas}', [FilmaController::class, 'delete']);

// Kategorijas routes
Route::get('/kategorijas', [KategorijaController::class, 'list']);
Route::get('/kategorijas/create', [KategorijaController::class, 'create']);
Route::post('/kategorijas/put', [KategorijaController::class, 'put']);
Route::get('/kategorijas/update/{kategorijas}', [KategorijaController::class, 'update']);
Route::post('/kategorijas/patch/{kategorijas}', [KategorijaController::class, 'patch']);
Route::post('/kategorijas/delete/{kategorijas}', [KategorijaController::class, 'delete']);

// Data/API
Route::get('/data/get-top-filmas', [DataController::class, 'getTopFilmas']);
Route::get('/data/get-filmas/{filmas}', [DataController::class, 'getFilmas']);
Route::get('/data/get-related-filmas/{filmas}', [DataController::class,'getRelatedFilmas']);