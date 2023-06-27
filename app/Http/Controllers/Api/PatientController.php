<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePatientRequest;
use App\Http\Requests\Api\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use Illuminate\Http\Request;
use App\Models\Patient;
class PatientController extends Controller
{
    //
    public function index(Request $request){

        // بتحولها بشكل أتوماتيك laravel ال  json response ل model مش محتاج أحول ال 

        $patients = Patient::all();
        return  PatientResource::collection($patients);

        // we use resource when we want to customize json response 
    } 
 
    public function show(Patient $patient){

        return new PatientResource($patient);

        //// return patient based on id or return json response when patient is not found
        // return Patient::find(1) ?? response()->json(['status'=>'Not found'],404);
      
    }

    public function store(StorePatientRequest $request){

            
            $request->validated();
            
            $patient = Patient::create($request->all());

            return new PatientResource($patient);
           
    }

    public function update(UpdatePatientRequest $request,$id){

        $patient = Patient::find($id);

        if(!$patient){
            return response()->json(['status'=>'Not Found'],404);
        }
        $patient->update($request->all());
        return new PatientResource($patient);
}

public function delete($id){

    $patient = Patient::find($id);

    if(!$patient){
        return response()->json(['status'=>'Not Found'],404);
    }
    
    $patient->delete();
    return response()->json(['status'=>'deleted'],200);
}
 
public function restore($id){
    $patient = Patient::onlyTrashed()->find($id);

    if(!$patient){
        return response()->json(['status'=>'Not Found'],404);
    }
    
    $patient->restore();

    return response()->json(['status'=>'restored'],200);

}

public function forceDelete($id){
    $patient = Patient::onlyTrashed()->find($id);
    if(!$patient){
        return response()->json(['status'=>'Not Found'],404);
    }
    
    $patient->forceDelete();

    return response()->json(['status'=>'deleted forever'],200);

}


}
