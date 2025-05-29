<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Patient;
use App\Traits\ApiHelperTrait;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    //
    use ApiHelperTrait;
    public function index()
    
    {
        $patient = Patient::with('clinics')->find(auth()->user()->id);

        return $this->returnJSON($patient->clinics, 'Clinics', true);
    }

    public function show(Request $request, $id)
    {
        $clinic = Clinic::find($id);

        return $this->returnJSON($clinic, 'Clinic', true);
    }

    
}
