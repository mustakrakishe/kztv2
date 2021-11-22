<?php

use App\Http\Controllers\HardwareController;
use Illuminate\Support\Facades\Route;

Route::resource('hardware', HardwareController::class)->middleware('auth');
