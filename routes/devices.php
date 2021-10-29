<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MovementController;
use Illuminate\Support\Facades\Route;

Route::get('/devices/search', [DeviceController::class, 'search'])
    ->middleware('auth')
    ->name('devices.search');

Route::get('/devices/fetch_data', [DeviceController::class, 'fetch_data'])
    ->middleware('auth')
    ->name('devices.fetch_data');
    
Route::resource('devices', DeviceController::class)->middleware('auth');

Route::resource('movements', MovementController::class)->middleware('auth');
