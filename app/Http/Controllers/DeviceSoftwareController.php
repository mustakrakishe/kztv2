<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $software = $device->last_software ?? new Software(['device_id' => $device->id]);
        $software->date = Carbon::now()->format('Y-m-d\TH:i:s');


        return [
            'status' => 1,
            'view' => view('components.device-accounting.software.create.modal', compact('software'))->render(),
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
     * @param  string  $deviceId
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Software $software)
    {
        $validationResponse = $this->validateDeviceSoftware($request);

        if($validationResponse['status'] !== 1){
            return $validationResponse;
        }

        $input = $request->input();

        if (!$software) {
            $software = Software::create($input);
        } else {
            $generalSoftwareFields = array_filter((new Software())->fillable, function($value) {
                return !in_array($value, ['device_id', 'date']);
            });

            $issetGeneralInput = !!array_filter($input, function($value, $key) use ($generalSoftwareFields) {
                return $value && in_array($key, $generalSoftwareFields);
            }, ARRAY_FILTER_USE_BOTH);

            if (!$issetGeneralInput) {
                $deviceId = $software->device_id;
                $deleteResponse = $this->destroy($software);

                if ($deleteResponse['status'] === 1) {
                    $software = new Software(['device_id' => $request->device_id]);
                }
            } else {
                $software->update($input);
            }
        }

        return [
            'status' => 1,
            'view' => view('components.device-accounting.software.edit.form', compact('software'))->render(),
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function destroy(Software $software)
    {
        $software->delete();
        return ['status' => 1];
    }

    /**
     * Validate the resource store/update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     *
     */
    public function validateDeviceSoftware(Request $request)
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
