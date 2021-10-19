<?php

use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Route;

Route::resource('devices', DeviceController::class)->middleware('auth');