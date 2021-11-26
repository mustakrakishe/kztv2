<?php

use App\Http\Controllers\DeviceSoftwareController;
use Illuminate\Support\Facades\Route;

Route::get('/devices/software/validate', [DeviceSoftwareController::class, 'validateDeviceSoftware'])
    ->middleware('auth')
    ->name('devices.software.validate');

Route::resource('devices.software', DeviceSoftwareController::class)->middleware('auth');
