<?php

namespace App\Http\Controllers;

use App\Models\Software;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SoftwareController extends Controller
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
        $software = Software::create([
            'date' => $request->date,
            'description' => $request->description,
            'comment' => $request->comment,
            'device_id' => $request->device_id,
        ]);

        return ['status' => 1];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function show(Software $software)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function edit(Software $software)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Software $software = null)
    {
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
     * Validate the device hardware store/update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     *
     */
    public function validateDeviceHardware(Request $request, Device $device)
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
