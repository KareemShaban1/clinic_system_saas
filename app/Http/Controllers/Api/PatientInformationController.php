<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChronicDisease;
use App\Models\GlassesDistance;
use App\Models\MedicalAnalysis;
use App\Models\Prescription;
use App\Models\Ray;
use App\Models\Reservation;

class PatientInformationController extends Controller
{
    //
    public function patientChronicDiseases($id)
    {

        $chronicDiseases = ChronicDisease::where('id', $id)->paginate(10);

        if(!$chronicDiseases) {
            return $this->apiResponse(null, 'Chronic Disease Not Found', 404, false);
        }

        return $this->apiResponse($chronicDiseases, 'Patient Chronic Disease');


    }

    public function patientRays($id)
    {
        $rays = Ray::where('id', $id)->paginate(10);

        if(!$rays) {
            return $this->apiResponse(null, 'Rays Not Found', 404, false);
        }

        return $this->apiResponse($rays, 'Patient Rays');
    }
    public function patientMedicalAnalysis($id)
    {
        $medicalAnalysis = MedicalAnalysis::where('id', $id)->paginate(10);

        if(!$medicalAnalysis) {
            return $this->apiResponse(null, 'Medical Analysis Not Found', 404, false);
        }

        return $this->apiResponse($medicalAnalysis, 'Patient Medical Analysis');
    }

    public function patientGlassesDistance($id)
    {
        // Retrieve reservations for the patient
        $reservations = Reservation::where('id', $id)->pluck('id');

        // Retrieve glasses distance records for the reservations
        $glassesDistance = GlassesDistance::whereIn('id', $reservations)->paginate(10);

        // Check if glasses distance records were found
        if ($glassesDistance->isEmpty()) {
            return $this->apiResponse(null, 'No glasses distance records found for the patient', 404, false);
        }

        // Return the glasses distance records
        return $this->apiResponse($glassesDistance, 'Glasses distance records retrieved successfully');
    }


    public function patientPrescription($id)
    {

        // Retrieve reservations for the patient
        $reservations = Reservation::where('id', $id)->pluck('id');

        $prescriptions = Prescription::whereIn('id', $reservations)->paginate(10);

        if(!$prescriptions) {
            return $this->apiResponse(null, 'Prescriptions Not Found', 404, false);
        }

        return $this->apiResponse($prescriptions, 'Prescriptions Medical Analysis');
    }
}
