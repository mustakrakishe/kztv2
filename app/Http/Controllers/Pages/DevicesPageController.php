<?php

namespace App\Http\Controllers\Pages;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DeviceController;

class DevicesPageController extends Controller
{
    public function index(){
        $devices = DeviceController::fetch_devices();
        return view('devices', compact('devices'));
    }
}
