<?php

use App\Http\Controllers\MovementController;
use Illuminate\Support\Facades\Route;
    
Route::resource('movements', MovementController::class)->middleware('auth');
