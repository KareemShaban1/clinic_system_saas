<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
class PatientController extends Controller
{
    //
    public function index(Request $request){

        return Patient::all();
    }
 
    public function show($id){

       
        return Patient::find($id) ?? response()->json(['status'=>'Not found'],404);
      
    }

    public function create(Request $request){

            $patient = new Patient();
            $patient->name = $request->get('name');
            $patient->age = $request->get('age');
            $patient->address = $request->get('address');
            $patient->email = $request->get('email');
            $patient->phone = $request->get('phone');
            $patient->blood_group = $request->get('blood_group');
            $patient->save();
            return $patient;
    }

    public function update(Request $request,$id){

        $patient = Patient::find($id);

        if(!$patient){
            return response()->json(['status'=>'Not Found'],404);
        }
        $patient->name = $request->get('name');
        $patient->age = $request->get('age');
        $patient->address = $request->get('address');
        $patient->email = $request->get('email');
        $patient->phone = $request->get('phone');
        $patient->blood_group = $request->get('blood_group');
        $patient->save();
        return $patient;
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
