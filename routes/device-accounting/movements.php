<?php

use App\Http\Controllers\MovementController;
use Illuminate\Support\Facades\Route;
    
Route::get('/movements/search', [MovementController::class, 'search'])
->middleware('auth')
->name('movements.search');

Route::get('/movements/fetch_data', [MovementController::class, 'fetch_data'])
->middleware('auth')
->name('movements.fetch_data');

Route::get('/movements/validate', [MovementController::class, 'validateMovement'])
    ->middleware('auth')
    ->name('movements.validate');

Route::resource('movements', MovementController::class)->middleware('auth');
