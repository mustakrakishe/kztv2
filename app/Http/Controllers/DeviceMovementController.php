<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Status;
use App\Models\Movement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceMovementController extends Controller
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
        $device->load('last_movement');
        $device->last_movement->date = Carbon::now()->format('Y-m-d\TH:i:s');
        $statuses = Status::all();

        return [
            'status' => 1,
            'view' => view('components.device-accounting.movements.create', compact('device', 'statuses'))->render(),
        ];
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
     * @param  \App\Models\Movement  $movement
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device, Movement $movement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @param  \App\Models\Movement  $movement
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device, Movement $movement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @param  \App\Models\Movement  $movement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device, Movement $movement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @param  \App\Models\Movement  $movement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device, Movement $movement)
    {
        //
    }

    /**
     * Validate the movement store/update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     *
     */
    public function validateDeviceMovement(Request $request, Device $device)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'date' => ['required', 'date'],
            'location' => ['required', 'string']
        ]);
        
        $validator->after(function ($validator) use ($request, $device){
            $movement = $device->last_movement;
            $movement->location = $request->location;

            if ($movement->isClean()) {
                $validator->errors()->add(
                    'location', trans('The device is alrady has the specified location.'),
                );
            }
        });

        if ($validator->fails()) {
            return [
                'status' => 0,
                'errors' => $validator->errors(),
            ];
        }

        return ['status' => 1];
    }
}
