<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Movement;
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
     * @return array
     */
    public function update(Request $request, Device $device, Movement $movement)
    {
        $errors = $this->validateMovement($request);
        if($errors){
            return [
                'status' => 0,
                'errors' => $errors,
            ];
        }

        if($movement->update($request->input())){
            return [
                'status' => 1,
                'view' => view('components.devices.properties.modal.content.movements.table.row', compact('movement'))->render(),
            ];
        }

        return ['status' => 0];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @param  \App\Models\Movement  $movement
     * @return array
     */
    public function destroy(Device $device, Movement $movement)
    {
        if(Movement::where('device_id', $device->id)->count() > 1){
            $movement->delete();
            return ['status' => 1];
        }

        return ['status' => 0];
    }


    /**
     * Validate the specified resource request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateMovement(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'date' => ['required', 'date'],
            'location' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return [];
    }
}
