<?php

use App\Http\Controllers\DeviceHardwareController;
use Illuminate\Support\Facades\Route;

Route::get('/devices/hardware/validate', [DeviceHardwareController::class, 'validateDeviceHardware'])
    ->middleware('auth')
    ->name('devices.hardware.validate');

Route::resource('devices.hardware', DeviceHardwareController::class)->middleware('auth');
