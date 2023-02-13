<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\Settings;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class PatientController extends Controller
{
    // function to show all  patients 
    public function index()
    {
        // get all records in patients table 
        $patients = Patient::all();

        return view('admin.patients.index', compact('patients'));
    }


    // show user data based on patient_id
    public function show($id){
        
        // get patient based on patient_id
        $patient = Patient::find($id);

        $reservations_count = count(Reservation::where('patient_id',$id)->get());

        return view('admin.patients.show', compact('patient','reservations_count'));
    }

    public function patient_card($id){

        $patient = Patient::find($id);

        return view('admin.patients.patient_card',compact('patient'));
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

        $customPaper = array(0,0,567.00,283.80);

        
        $pdf = PDF::loadView('admin.patients.patient_pdf',$data);
        // $pdf->getMpdf()->format([100,100]);
        // $pdf->format([100,100]);
        return $pdf->stream( $patient->name .'.pdf');



    }


    public function add()
    {
       
        // return add view 
        return view('admin.patients.add');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'age' => 'nullable',
            'address' => 'required',
            'phone' => 'required',
            'email'=>'nullable',
            'blood_group'=>'required'

           ]);
           

        try {
            $patient = new Patient();
            $patient->name = $request->name;
            $patient->age = $request->age;
            $patient->address = $request->address;
            $patient->email = $request->email;
            $patient->phone = $request->phone;
            $patient->blood_group = $request->blood_group;
            $patient->save();
            return redirect()->route('admin.patients.index')->with('success', 'Patient added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function edit($id)
    {
        // get patient based on patient_id
        $patient = Patient::find($id);
        
        return view('admin.patients.edit', compact('patient'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'age' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);


       
            try{

        // get patient based on patient_id
        $patient = Patient::find($id);
        
        $patient->name = $request->name;
        $patient->age = $request->age;
        $patient->address = $request->address;
        $patient->email = $request->email;
        $patient->phone = $request->phone;
        $patient->blood_group = $request->blood_group;
        $patient->save();
        return redirect()->route('admin.patients.index')->with('success', 'Patient added successfully');
        
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

            return redirect()->route('admin.patients.index');

         }



         public function trash(){
            // get all deleted patients 
            $patients = Patient::onlyTrashed()->get();
            return view('admin.patients.trash',compact('patients'));
         }



         public function restore($id){
            // get deleted patient based on patient_id 
            $patients = Patient::onlyTrashed()->findOrFail($id);
            // restore deleted patient
            $patients->restore();

            return redirect()->route('admin.patients.index');

         }


         public function forceDelete($id){
            // get deleted patient based on patient_id 
            $patients = Patient::onlyTrashed()->findOrFail($id);
            // delete deleted patient forever
            $patients->forceDelete();

            return redirect()->route('admin.patients.index');

         }

         


}