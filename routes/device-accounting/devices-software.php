<?php

use App\Http\Controllers\DeviceSoftwareController;
use Illuminate\Support\Facades\Route;

Route::get('/devices/software/validate', [DeviceSoftwareController::class, 'validateDeviceSoftware'])
    ->middleware('auth')
    ->name('devices.software.validate');

Route::put('devices/software/{software?}', [DeviceSoftwareController::class, 'update'])->middleware('auth')->name('devices.software.update');

Route::resource('devices.software', DeviceSoftwareController::class)->except('update')->middleware('auth');
