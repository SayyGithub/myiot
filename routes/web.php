<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\BerandaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->secure('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

    Route::get('/dashboard', function () {
        return redirect()->route('beranda');
    })->name('dashboard');

    Route::get('/reset-password-user', [PasswordController::class, 'edit'])->name('password.user.edit');
    Route::put('/reset-password-user', [PasswordController::class, 'update'])->name('password.user.update');

    Route::get('/device', [DeviceController::class, 'index'])->name('device.index');
    Route::get('/sensor', [SensorController::class, 'index'])->name('sensor.index');

    Route::middleware('role:admin')->group(function () {
        Route::get('/device/create', [DeviceController::class, 'create'])->name('device.create');
        Route::post('/device', [DeviceController::class, 'store'])->name('device.store');
        Route::get('/device/{device}/edit', [DeviceController::class, 'edit'])->name('device.edit');
        Route::put('/device/{device}', [DeviceController::class, 'update'])->name('device.update');
        Route::delete('/device/{device}', [DeviceController::class, 'destroy'])->name('device.destroy');

        Route::get('/sensor/create', [SensorController::class, 'create'])->name('sensor.create');
        Route::post('/sensor', [SensorController::class, 'store'])->name('sensor.store');
        Route::get('/sensor/{sensor}/edit', [SensorController::class, 'edit'])->name('sensor.edit');
        Route::put('/sensor/{sensor}', [SensorController::class, 'update'])->name('sensor.update');
        Route::delete('/sensor/{sensor}', [SensorController::class, 'destroy'])->name('sensor.destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

require __DIR__.'/auth.php';