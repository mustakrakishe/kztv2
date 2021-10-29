<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceMovementController;
use Illuminate\Support\Facades\Route;

Route::get('/devices/search', [DeviceController::class, 'search'])
    ->middleware('auth')
    ->name('devices.search');

Route::get('/devices/fetch_data', [DeviceController::class, 'fetch_data'])
    ->middleware('auth')
    ->name('devices.fetch_data');
    
Route::resource('devices', DeviceController::class)->middleware('auth');

Route::resource('devices.movements', DeviceMovementController::class)->middleware('auth');
