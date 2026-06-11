<?php
use App\Http\Controllers\Api\DeviceStatusController;
use App\Http\Controllers\Api\SensorController;
use Illuminate\Support\Facades\Route;

Route::post('/device/status', [DeviceStatusController::class, 'update']);
Route::get('/sensor', [SensorController::class, 'index']);
Route::get('/sensor/{id}', [SensorController::class, 'show']);
Route::post('/sensor', [SensorController::class, 'store']);
Route::put('/sensor/{id}', [SensorController::class, 'update']);
Route::delete('/sensor/{id}', [SensorController::class, 'destroy']);