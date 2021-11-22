<?php

use App\Http\Controllers\SoftwareController;
use Illuminate\Support\Facades\Route;

Route::resource('software', SoftwareController::class)->middleware('auth');
