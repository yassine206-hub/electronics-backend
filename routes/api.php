<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ElectronicController;

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Electronics routes
Route::get('/electronics', [ElectronicController::class, 'index']);
Route::post('/electronics', [ElectronicController::class, 'store']);
Route::put('/electronics/{id}', [ElectronicController::class, 'update']);
Route::delete('/electronics/{id}', [ElectronicController::class, 'destroy']);

// Search route
Route::get('/electronics/search', [ElectronicController::class, 'search']);
Route::post('/electronics/{id}/upload', [ElectronicController::class, 'uploadImage']);