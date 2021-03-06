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

        $devices->load([
            'type',
            'status',
            'last_movement',
            'last_hardware',
            'last_software'
        ]);
            
        return view('devices', compact('devices'));
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
        //
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
        $device->load([
            'status',
            'type'
        ]);

        $types = Type::all();
        
        return [
            'status' => 1,
            'view_properties' => view('components.devices.properties.modal.content', compact('device', 'types'))->render(),
            'view_delete' => view('components.devices.delete.modal.content', compact('device'))->render(),
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
        $errors = $this->validateDevice($request);
        if($errors){
            return [
                'status' => 0,
                'errors' => $errors,
            ];
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
            'view' => view('components.devices.brief-info-table', compact('devices'))->render(),
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
            'model' => ['nullable', 'string', 'max:50'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return [];
    }
}
