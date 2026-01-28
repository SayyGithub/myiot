<?php

use App\Http\Controllers\SensorController;

Route::get('/', [SensorController::class, 'index'])->name('sensor.index');

Route::get('/sensor/create', [SensorController::class, 'create'])->name('sensor.create');
Route::post('/sensor', [SensorController::class, 'store'])->name('sensor.store');
Route::delete('/sensor/{sensor}', [SensorController::class, 'destroy'])->name('sensor.destroy');
Route::resource('sensor', SensorController::class);