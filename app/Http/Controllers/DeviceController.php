<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Device;
use App\Models\Status;
use App\Models\Hardware;
use App\Models\Movement;
use App\Models\Software;
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

        $default = new class {};
        $default->device = new Device();
        $default->movement = new Movement();
        $default->hardware = new Hardware();
        $default->software = new Software();
            
        return view('device-accounting.devices', compact('devices', 'types', 'statuses'))->with([
            'contextMenuView' => view('components.device-accounting.devices.index.context-menu')->render(),
            'createDeviceAccountView' => view('components.device-accounting.device-accounts.create', compact('default', 'types', 'statuses'))->render(),
        ]);
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
        // 
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
        if (!$validation['status']) {
            return $validation;
        }

        if ($device->update($request->input())) {
            return ['status' => 1];
        }

        return ['status' => 0];
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return array
     */
    public function deleteConfirmation(Device $device)
    {
        return [
            'status' => 1,
            'view' => view('components.device-accounting.devices.delete.confirmation', compact('device'))->render(),
        ];
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
        
        $devices = Device::getModel();

        if (isset($request->search_string)) {
            $keywords = preg_split('/\s+/', trim($request->search_string));
            $devices = $devices->search($keywords);
            
            // return [
            //     'status' => 1,
            //     'view' => $devices->toSql(),
            // ];
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
            'view' => view('components.device-accounting.devices.index.table', compact('devices'))->render(),
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
            'inventory_code' => ['nullable', 'numeric', 'max:2147483647'],
            'identification_code' => ['nullable', 'numeric', 'max:2147483647'],
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
