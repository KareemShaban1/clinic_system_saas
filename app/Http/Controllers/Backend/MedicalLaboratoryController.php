<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MedicalLaboratory;
use App\Http\Requests\StoreMedicalLaboratoryRequest;
use App\Http\Requests\UpdateMedicalLaboratoryRequest;

class MedicalLaboratoryController extends Controller
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
     * @param  \App\Http\Requests\StoreMedicalLaboratoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMedicalLaboratoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicalLaboratory  $medicalLaboratory
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalLaboratory $medicalLaboratory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicalLaboratory  $medicalLaboratory
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicalLaboratory $medicalLaboratory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMedicalLaboratoryRequest  $request
     * @param  \App\Models\MedicalLaboratory  $medicalLaboratory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMedicalLaboratoryRequest $request, MedicalLaboratory $medicalLaboratory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicalLaboratory  $medicalLaboratory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalLaboratory $medicalLaboratory)
    {
        //
    }
}
