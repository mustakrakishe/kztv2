<?php

use App\Http\Controllers\DeviceMovementController;
use Illuminate\Support\Facades\Route;
    
Route::resource('devices.movements', DeviceMovementController::class)->middleware('auth');
