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
        $movement = $device->last_movement;
        $movement->date = Carbon::now()->format('Y-m-d\TH:i:s');

        $statuses = Status::all();

        return [
            'status' => 1,
            'view' => view('components.device-accounting.movements.create.modal', compact('movement', 'statuses'))->render(),
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
        $validationResponse = $this->validateDeviceMovement($request, $device);

        if($validationResponse['status'] !== 1){
            return $validationResponse;
        }

        $movement = new Movement($request->input());
        $movement->device_id = $device->id;

        if ($movement->save()) {
            $device->touch();
            return ['status' => 1];
        }

        return ['status' => 0];
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
     * @param  string  $deviceId
     * @param  \App\Models\Movement  $movement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $deviceId, Movement $movement)
    {
        $validationResponse = $this->validateDeviceMovement($request);

        if($validationResponse['status'] !== 1){
            return $validationResponse;
        }

        if ($movement->update($request->input())) {
            return ['status' => 1];
        }

        return ['status' => 0];
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
    public function validateDeviceMovement(Request $request, Device $device = null)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'date' => ['required', 'date'],
            'location' => ['required', 'string']
        ]);
        
        $validator->after(function ($validator) use ($request, $device){
            if ($device) {
                $movement = $device->last_movement;
                $movement->location = $request->location;
    
                if ($movement->isClean()) {
                    $validator->errors()->add(
                        'location', trans('The device is alrady has the specified location.'),
                    );
                }
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
