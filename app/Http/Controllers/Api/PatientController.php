<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePatientRequest;
use App\Http\Requests\Api\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    use ApiResponseTrait;
    //

    public function __construct()
    {
        // apply middleware on all controller methods except index , show
        $this->middleware('auth:sanctum')->except('index', 'show');
    }


    public function index()
    {

        // بتحولها بشكل أتوماتيك laravel ال  json response ل model مش محتاج أحول ال

        $patients =  PatientResource::collection(Patient::get());

        return $this->apiResponse($patients, 'All Patient', 200);


        // we use resource when we want to customize json response
    }

    public function show($id)
    {

        $patient = Patient::find($id);

        if($patient) {

            return $this->apiResponse(new PatientResource($patient), 'ok', 200);
        }
        return $this->apiResponse('null', 'Patient Not Fount', 401);

    }

    public function store(StorePatientRequest $request)
    {


        $request->validated();

        $user = $request->user();
        if (!$user->tokenCan('أضافة مريض')) {
            return response([
                'message' => 'Not Allowed'
            ], 403);
        }
        $patient = new PatientResource(Patient::create($request->all()));

        return $this->apiResponse($patient, 'Patient Created Successfully', 200);
    }

    public function update(UpdatePatientRequest $request, $id)
    {

        $patient = Patient::find($id);

        $request->validated();

        $user = $request->user();
        if (!$user->tokenCan('تعديل مريض')) {
            return response([
                'message' => 'Not Allowed'
            ], 403);
        }

        if ($patient) {
            $patient->update($request->all());
            return $this->apiResponse(new PatientResource($patient), 'Patient Updated Successfully', 200);
        }

        return $this->apiResponse(null, 'Patient Not Found', 401);

    }

    public function delete($id)
    {

        $patient = Patient::find($id);

        $user = Auth::guard('sanctum')->user();
        if (!$user->tokenCan('حذف مريض')) {
            return response([
                'message' => 'Not Allowed'
            ], 403);
        }
        if(!$patient) {
            return $this->apiResponse(null, 'Patient Not Found', 401);
        }
        $patient->delete();
        return $this->apiResponse(null, 'Patient Deleted Successfully', 200);
    }



    public function restore($id)
    {

        $patient = Patient::onlyTrashed()->find($id);

        if(!$patient) {
            return $this->apiResponse(null, 'Patient Not Found', 401);
        }

        $patient->restore();

        return $this->apiResponse(null, 'Patient Restored Successfully', 200);

    }

    public function forceDelete($id)
    {
        $patient = Patient::onlyTrashed()->find($id);

        if(!$patient) {
            return $this->apiResponse(null, 'Patient Not Found', 401);
        }
        $patient->forceDelete();

        return $this->apiResponse(null, 'Patient Force Deleted Successfully', 200);

    }


}
