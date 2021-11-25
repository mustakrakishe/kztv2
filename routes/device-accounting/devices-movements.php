<?php

use App\Http\Controllers\DeviceMovementController;
use Illuminate\Support\Facades\Route;

Route::get('/devices/movements/validate', [DeviceMovementController::class, 'validateDeviceMovement'])
    ->middleware('auth')
    ->name('devices.movements.validate');
    
Route::resource('devices.movements', DeviceMovementController::class)->middleware('auth');
