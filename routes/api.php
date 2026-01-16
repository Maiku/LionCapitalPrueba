<?php

use App\CRM\Properties\Controllers\AvailablePropertiesController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class,'logout']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/properties/available-for-operations',[AvailablePropertiesController::class, 'index'])->middleware('auth:sanctum');
