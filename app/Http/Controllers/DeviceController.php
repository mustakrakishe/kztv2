<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        //
    }

    // Additional methods

    /**
     * Get device pagination page
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fetch_data(Request $request){
        $devices = null;
        $paginationPathParameters = [];

        if(isset($request->search_string)){
            $keywords = preg_split('/\s+/', trim($request->search_string));
            $devices = Device::search($keywords)
                ->paginate()
                ->withPath(route('devices.fetch_data', ['search_string' => $request->search_string]));
        }
        else{
            $devices = Device::paginate()->withPath(route('devices.fetch_data'));
        }

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
     * Display a listing of the keywords mutched resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function search(Request $request)
    {
        $keywords = preg_split('/\s+/', trim($request->search_string));

        return Device::search($keywords)
            ->paginate()
            ->withPath(route('devices.fetch_data', ['search_string' => $request->search_string]));
    }
}
