<?php

use App\Http\Controllers\Api\SensorController;
use App\Http\Controllers\Api\DeviceStatusController;
use Illuminate\Support\Facades\Route;

Route::post('/sensor', [SensorController::class, 'store']);
Route::post('/device/status', [DeviceStatusController::class, 'update']);
Route::get('/sensor', [SensorController::class, 'index']);
Route::get('/sensor/{id}', [SensorController::class, 'show']);
Route::put('/sensor/{id}', [SensorController::class, 'update']);
Route::delete('/sensor/{id}', [SensorController::class, 'destroy']);