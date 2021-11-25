<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Software;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceSoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function index(Device $device)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function create(Device $device)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Device $device)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device, Software $software)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device, Software $software)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device, Software $software)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device, Software $software)
    {
        //
    }

    /**
     * Validate the resource store/update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     *
     */
    public function validateDeviceSoftware(Request $request, Device $device)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
        ]);

        if ($validator->fails()) {
            return [
                'status' => 0,
                'errors' => $validator->errors(),
            ];
        }

        return ['status' => 1];
    }
}
