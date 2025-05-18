<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RadiologyCenter;
use App\Http\Requests\StoreRadiologyCenterRequest;
use App\Http\Requests\UpdateRadiologyCenterRequest;

class RadiologyCenterController extends Controller
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
     * @param  \App\Http\Requests\StoreRadiologyCenterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRadiologyCenterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RadiologyCenter  $radiologyCenter
     * @return \Illuminate\Http\Response
     */
    public function show(RadiologyCenter $radiologyCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RadiologyCenter  $radiologyCenter
     * @return \Illuminate\Http\Response
     */
    public function edit(RadiologyCenter $radiologyCenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRadiologyCenterRequest  $request
     * @param  \App\Models\RadiologyCenter  $radiologyCenter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRadiologyCenterRequest $request, RadiologyCenter $radiologyCenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RadiologyCenter  $radiologyCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(RadiologyCenter $radiologyCenter)
    {
        //
    }
}
