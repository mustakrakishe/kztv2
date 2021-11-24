<?php

use App\Http\Controllers\SoftwareController;
use Illuminate\Support\Facades\Route;

Route::put('/software/{software?}', [SoftwareController::class, 'update'])->middleware('auth')->name('software.update');

Route::resource('software', SoftwareController::class)->except('update')->middleware('auth');
