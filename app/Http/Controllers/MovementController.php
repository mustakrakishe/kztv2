<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movements = Movement::latest('date')
            ->orderByDesc('id')
            ->paginate()
            ->withPath(route('movements.fetch_data'));

        $movements->load([
            'device.type',
            'status',
        ]);
            
        return view('device-accounting.movements', compact('movements'));
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
     * @param  \App\Models\Movement  $movement
     * @return \Illuminate\Http\Response
     */
    public function show(Movement $movement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movement  $movement
     * @return \Illuminate\Http\Response
     */
    public function edit(Movement $movement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movement  $movement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movement $movement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movement  $movement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movement $movement)
    {
        //
    }

    // Additional methods

    /**
     * Get resource pagination page
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fetch_data(Request $request){
        $urlQueryWithoutPage = http_build_query($request->collect()->except('page')->toArray());
        
        $movements = Movement::getModel();

        if (isset($request->search_string)) {
            $keywords = preg_split('/\s+/', trim($request->search_string));
            $movements = $movements->search($keywords);
        }

        $movements = $movements->paginate()->withPath(route('movements.fetch_data', $urlQueryWithoutPage));

        $movements->load([
            'device.type',
            'status',
        ]);

        return [
            'status' => 1,
            'view' => view('components.device-accounting.movements.index.table', compact('movements'))->render(),
        ];
    }
}
