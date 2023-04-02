<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\Settings;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use PDF;
use App\Http\Traits\AuthorizeCheck;

class PatientController extends Controller
{
    use AuthorizeCheck;

    // function to show all  patients 
    public function index()
    {
        $this->authorizeCheck('المرضى');
        // get all records in patients table 
        $patients = Patient::all();

        return view('backend.pages.patients.index', compact('patients'));
    }


    // show user data based on patient_id
    public function show($id){
        
        // get patient based on patient_id
        $patient = Patient::find($id);

        $reservations_count = Reservation::where('patient_id',$id)->count();

        return view('backend.pages.patients.show', compact('patient','reservations_count'));
    }

    public function patient_card($id){

        $patient = Patient::find($id);

        return view('backend.pages.patients.patient_card',compact('patient'));
    }

    
    public function patient_pdf($id){

               
        $patient = Patient::find($id);

        $collection = Settings::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
            
        });
    
        $data= [];
        $data['patient'] = $patient;
        $data['settings']=$setting['setting'];
        
        $pdf = PDF::loadView('backend.pages.patients.patient_pdf',$data);
        
        return $pdf->stream( $patient->name .'.pdf');



    }


    public function add()
    {
        // return add view 
        return view('backend.pages.patients.add');
    }

    
    public function store(StorePatientRequest $request)
    {
        
           
        try {
            $validated = $request->validated();
            $patient = new Patient();
            $patient->name = $request->name;
            $patient->age = $request->age;
            $patient->address = $request->address;
            $patient->email = $request->email;
            $patient->phone = $request->phone;
            $patient->blood_group = $request->blood_group;
            $patient->save();
            return redirect()->route('backend.patients.index')->with('success', 'Patient added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function edit($id)
    {
        // get patient based on patient_id
        $patient = Patient::find($id);
        
        return view('backend.pages.patients.edit', compact('patient'));
    }


    public function update(UpdatePatientRequest $request, $id)
    {


        try{
                $validated = $request->validated();


        // get patient based on patient_id
        $patient = Patient::find($id);
        
        $patient->name = $request->name;
        $patient->age = $request->age;
        $patient->address = $request->address;
        $patient->email = $request->email;
        $patient->phone = $request->phone;
        $patient->blood_group = $request->blood_group;
        $patient->save();
        return redirect()->route('backend.patients.index')->with('success', 'Patient added successfully');
        
        } 
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

         }

      
         public function destroy($id){
            
            // get patient based on patient_id
            $patient = Patient::findOrFail($id);
            // delete selected patient
            $patient->delete();

            return redirect()->route('backend.patients.index');

         }



         public function trash(){
            // get all deleted patients 
            $patients = Patient::onlyTrashed()->get();
            return view('backend.pages.patients.trash',compact('patients'));
         }



         public function restore($id){
            // get deleted patient based on patient_id 
            $patients = Patient::onlyTrashed()->findOrFail($id);
            // restore deleted patient
            $patients->restore();

            return redirect()->route('backend.patients.index');

         }


         public function forceDelete($id){
            // get deleted patient based on patient_id 
            $patients = Patient::onlyTrashed()->findOrFail($id);
            // delete deleted patient forever
            $patients->forceDelete();

            return redirect()->route('backend.patients.index');

         }

         


}