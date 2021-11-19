<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Device;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Device::paginate()->withPath(route('devices.fetch_data'));
        $types = Type::all();
        $statuses = Status::all();

        $devices->load([
            'type',
            'status',
            'last_movement',
            'last_hardware',
            'last_software'
        ]);
            
        return view('device-accounting.devices', compact('devices', 'types', 'statuses'));
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
        $validation = $this->validateDevice($request);
        if(!$validation['status']){
            return $validation;
        }

        $device = Device::create([
            'inventory_code' => $request->inventory_code,
            'identification_code' => $request->identification_code,
            'model' => $request->model,
            'comment' => $request->comment,
            'type_id' => $request->type_id,
        ]);

        return [
            'status' => 1,
            'device' => $device,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return array
     */
    public function edit(Device $device)
    {
        $types = Type::all();
        $statuses = Status::all();

        $device->load([
            'type',
            'status',
            'last_movement',
            'last_hardware',
            'last_software'
        ]);
        
        return [
            'status' => 1,
            'view' => view('components.device-accounting.devices.edit', compact('device', 'types', 'statuses'))->render(),
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return array
     */
    public function update(Request $request, Device $device)
    {
        $validation = $this->validateDevice($request);
        if(!$validation['status']){
            return $validation;
        }

        if($device->update($request->input())){
            return ['status' => 1];
        }

        return ['status' => 0];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        $device->delete();
        return ['status' => 1];
    }

    // Additional methods

    /**
     * Get device pagination page
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fetch_data(Request $request){
        $urlQueryWithoutPage = http_build_query($request->collect()->except('page')->toArray());

        if(isset($request->search_string)){
            $keywords = preg_split('/\s+/', trim($request->search_string));
            $devices = Device::search($keywords);
        }
        else{
            $devices = Device::getModel();
        }

        $devices = $devices->paginate()->withPath(route('devices.fetch_data', $urlQueryWithoutPage));

        $devices->load([
            'type',
            'status',
            'last_movement',
            'last_hardware',
            'last_software'
        ]);

        return [
            'status' => 1,
            'view' => view('components.device-accounting.devices.table', compact('devices'))->render(),
        ];
    }

    /**
     * Validate the device store/update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     *
     */
    public function validateDevice(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'inventory_code' => ['nullable', 'numeric'],
            'identification_code' => ['nullable', 'numeric'],
            'type_id' => ['required', 'integer'],
            'model' => ['nullable', 'string', 'max:50'],
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
