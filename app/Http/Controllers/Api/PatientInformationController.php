<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChronicDisease;
use Illuminate\Http\Request;

class PatientInformationController extends Controller
{
    //
    public function patientChronicDiseases($patient_id)
    {

        $chronicDisease = ChronicDisease::where('patient_id', $patient_id)->paginate(10);

    }

    public function patientRays() {}
    public function patientMedicalAnalysis() {}

    public function patientPrescription() {}
}
