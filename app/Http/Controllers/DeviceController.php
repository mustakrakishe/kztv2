<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Device::with('type')
            ->with('status')
            ->with('last_movement')
            ->with('last_hardware')
            ->with('last_software')
            ->paginate();
            
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
     * Display a listing of the keywords mutched resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        $keywords = preg_split('/\s+/', trim($request->keywords));

        $devicesQueryBuilder = Device::with('type')
            ->with('status')
            ->with('last_movement')
            ->with('last_hardware')
            ->with('last_software');

        foreach($keywords as $keyword){

            $devicesQueryBuilder->where(function ($query) use ($keyword) {
                foreach(Device::$searchable as $column){
                    $query->orWhereRaw($column . '::text like ' . "'%$keyword%'");
                }
            });
        }

        $devices = $devicesQueryBuilder->paginate();
        
        return view('components.devices.brief-info-table', compact('devices'))->render();
    }
}
