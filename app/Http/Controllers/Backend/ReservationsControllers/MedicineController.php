<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Http\Requests\StoreMedicineRequest;

class MedicineController extends Controller
{
    //
    public function index(){
        $medicines = Medicine::all();

        return view('backend.pages.medicine.index',compact('medicines'));
    }


    // add medicine just return medicine view

    public function add(){

        return view('backend.pages.medicine.add');
    }



    public function store (StoreMedicineRequest $request){

        $request->validate();

try{   

    $medicine = new Medicine;
        $medicine->drugbank_id = $request->drugbank_id;
        $medicine->name = $request->name;
        $medicine->brand_name = $request->brand_name;
        $medicine->drug_dose = $request->drug_dose;
        $medicine->type = $request->type;
        $medicine->categories = $request->categories;
        $medicine->description = $request->description;
        $medicine->side_effect = $request->side_effect;

        $medicine->save();

        return redirect()->route('backend.medicines.index');

 } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Something went wrong');
    }
        

    }

    public function edit ($id){
        $medicine = Medicine::findOrFail($id);

        return view('backend.pages.medicine.edit',compact('medicine'));

    }
    public function update (Request $request , $id) {

        try{  
            $medicine = Medicine::findOrFail($id);

            $medicine->drugbank_id = $request->drugbank_id;
            $medicine->name = $request->name;
            $medicine->brand_name = $request->brand_name;
            $medicine->drug_dose = $request->drug_dose;
            $medicine->type = $request->type;
            $medicine->categories = $request->categories;
            $medicine->description = $request->description;
            $medicine->side_effect = $request->side_effect;
    
            $medicine->save();
            
            // to check that the medicine has been updated
            return redirect()->route('backend.medicines.edit',$medicine->id);

          } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

      


    }

    public function show ($id){
        $medicine = Medicine::findOrFail($id);

        return view('backend.pages.medicine.show',compact('medicine'));

    }


    public function destroy($id){
            
        // get patient based on patient_id
        $medicines = Medicine::findOrFail($id);
        // delete selected patient
        $medicines->delete();

        return redirect()->route('backend.medicines.index');

     }



     public function trash(){
        // get all deleted patients 
        $medicines = Medicine::onlyTrashed()->get();
        return view('backend.pages.medicine.trash',compact('medicines'));
     }



     public function restore($id){
        // get deleted patient based on patient_id 
        $medicines = Medicine::onlyTrashed()->findOrFail($id);
        // restore deleted patient
        $medicines->restore();

        return redirect()->route('backend.medicines.index');

     }


     public function forceDelete($id){
        // get deleted patient based on patient_id 
        $medicines = Medicine::onlyTrashed()->findOrFail($id);
        // delete deleted patient forever
        $medicines->forceDelete();

        return redirect()->route('backend.medicines.index');

     }

}
