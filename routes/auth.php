<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::post('/register/validate', [RegisterController::class, 'xhrValidate'])
                ->middleware('guest')
                ->name('register.validate');

Route::post('/login/validate', [LoginController::class, 'xhrValidate'])
                ->middleware('guest')
                ->name('login.validate');