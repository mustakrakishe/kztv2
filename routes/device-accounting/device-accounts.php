<?php

use App\Http\Controllers\DeviceAccountController;
use Illuminate\Support\Facades\Route;
    
Route::resource('device-accounts', DeviceAccountController::class)->middleware('auth');
