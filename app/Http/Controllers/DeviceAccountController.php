<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Device;
use App\Models\Status;
use App\Models\Hardware;
use App\Models\Movement;
use App\Models\Software;
use Illuminate\Http\Request;

class DeviceAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = (object) array_map(function($form) {
            parse_str($form, $arr);
            return $arr;
        }, $request->except('_token'));

        $device = Device::create($input->device);

        $movement = new Movement($input->movement);
        $movement->device_id = $device->id;
        $movement->save();

        $hardware = new Hardware($input->hardware);
        $hardware->device_id = $device->id;
        $hardware->save();

        if ($input->software['description'] || $input->software['comment']) {
            $software = new Software($input->software);
            $software->device_id = $device->id;
            $software->save();
        }

        return ['status' => 1];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $deviceId
     * @return \Illuminate\Http\Response
     */
    public function edit($deviceId)
    {
        $types = Type::all();
        $statuses = Status::all();

        $device = Device::find($deviceId)
            ->load([
                'type',
                'status',
                'last_movement',
                'last_hardware',
                'last_software',
            ]);
        
        return [
            'status' => 1,
            'view' => view('components.device-accounting.device-accounts.edit', compact('device', 'types', 'statuses'))->render(),
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
