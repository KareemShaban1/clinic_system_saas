<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedicalAnalysisResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\MedicalAnalysis;

class MedicalAnalysisController extends Controller
{
    use ApiResponseTrait;
    //
    public function index(){
        
        $medical_analysis =  MedicalAnalysisResource::collection(MedicalAnalysis::all());

        return $this->apiResponse($medical_analysis, 'All Medical Analysis', 200);

    }
}