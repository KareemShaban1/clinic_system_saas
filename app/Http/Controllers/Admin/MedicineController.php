<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine;
class MedicineController extends Controller
{
    //
    public function index(){
        $medicines = Medicine::all();

        return view('admin.medicine.index',compact('medicines'));
    }

    public function add(){

        return view('admin.medicine.add');
    }

    public function store (Request $request){

        $request->validate([
            'name'=>'required'
        ],[
            'name.required'=>'حقل أسم الدواء مطلوب'
        ]);

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

        return redirect()->route('admin.medicines.index');

    }

    public function edit ($id){
        $medicine = Medicine::findOrFail($id);

        return view('admin.medicine.edit',compact('medicine'));

    }
    public function update (Request $request , $id) {

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

        return redirect()->route('admin.medicines.edit',$medicine->id);


    }

    public function show ($id){
        $medicine = Medicine::findOrFail($id);

        return view('admin.medicine.show',compact('medicine'));

    }


    public function destroy($id){
            
        // get patient based on patient_id
        $medicines = Medicine::findOrFail($id);
        // delete selected patient
        $medicines->delete();

        return redirect()->route('admin.medicines.index');

     }



     public function trash(){
        // get all deleted patients 
        $medicines = Medicine::onlyTrashed()->get();
        return view('admin.medicine.trash',compact('medicines'));
     }



     public function restore($id){
        // get deleted patient based on patient_id 
        $medicines = Medicine::onlyTrashed()->findOrFail($id);
        // restore deleted patient
        $medicines->restore();

        return redirect()->route('admin.medicines.index');

     }


     public function forceDelete($id){
        // get deleted patient based on patient_id 
        $medicines = Medicine::onlyTrashed()->findOrFail($id);
        // delete deleted patient forever
        $medicines->forceDelete();

        return redirect()->route('admin.medicines.index');

     }

}
