<?php

namespace App\Http\Controllers;

use App\Models\Software;
use Illuminate\Http\Request;

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

        return [
            'status' => 1,
            'view' => view('components.device-accounting.software\edit', compact('software'))->render(),
        ];
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
    public function update(Request $request, Software $software)
    {
        $input = $request->input();

        $generalSoftwareFields = array_filter($software->fillable, function($value) {
            return !in_array($value, ['device_id', 'date']);
        });

        $issetGeneralInput = !!array_filter($input, function($value, $key) use ($generalSoftwareFields) {
            return $value && in_array($key, $generalSoftwareFields);
        }, ARRAY_FILTER_USE_BOTH);

        if (!$issetGeneralInput) {
            $deviceId = $software->device_id;
            $deleteResponse = $this->destroy($software);

            if ($deleteResponse['status'] === 1) {
                return [
                    'status' => 1,
                    'view' => view('components.device-accounting.software.create', compact('deviceId'))->render(),
                ];
            }
        } elseif ($software->update($input)) {
            return [
                'status' => 1,
                'view' => view('components.device-accounting.software.edit', compact('software'))->render(),
            ];
        }

        return ['status' => 0];
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
}
