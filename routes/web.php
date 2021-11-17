<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('devices.index');
});

Auth::routes();

require __DIR__.'/devices.php';
require __DIR__.'/movements.php';
require __DIR__.'/hardware.php';
require __DIR__.'/software.php';
