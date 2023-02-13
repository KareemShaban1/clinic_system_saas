<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Drug;
use App\Models\Reservation;
use App\Models\ChronicDiseases;
use Carbon\Carbon;
use App\Models\NumberOfReservations;


class ReservationController extends Controller
{
    //
    public function index()
    {
        // get all reservations 
        $reservations = Reservation::all();
        return view('admin.reservations.index', compact('reservations'));
    }

    public function today()
    {
        // get current date on egypt
        $current_date = Carbon::now('Egypt')->format('Y-m-d');
        // get reservation where res_date = current_date
        $reservations = Reservation::where('res_date', $current_date)->get();

        return view('admin.reservations.today', compact('reservations'));
    }


    public function add($id){
        // get all patients on patient table
        $patient = Patient::findOrFail($id);
        // get new instance from reservation model
        $reservation = new Reservation;

        $current_date = Carbon::now('Egypt')->format('Y-m-d');

        $today_reservation_res_num = Reservation::where('res_date', $current_date)->value('res_num');


        $number_of_res = NumberOfReservations::where('reservation_date',$current_date)->value('num_of_reservations');

        
        // dd($number_of_res);
        return view('admin.reservations.add', compact('patient','reservation','number_of_res','today_reservation_res_num'));
        
    }



    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'res_date' => 'required',
            'res_num'=>'required',
            'res_type'=>'required',
            'status'=>'required',
            'payment'=>'required',
            'cost'=>'required',
            ]);

        try {

            // $reservation = Reservation::create($request->all());

            // make new instance from Reservation Model
            $reservation = new Reservation();

            $reservation->patient_id = $request->patient_id;
            $reservation->res_num = $request->res_num;
            $reservation->first_diagnosis = $request->first_diagnosis;
            // $reservation->final_diagnosis = $request->final_diagnosis;
            $reservation->res_type = $request->res_type;
            $reservation->cost = $request->cost;
            $reservation->payment = $request->payment;
            $reservation->res_date = $request->res_date;
            $reservation->status = $request->status;
            $reservation->save();
            
            return redirect()->route('admin.reservations.index')->with('success', 'Reservation added successfully');
        
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function reservation_status ($id,$status){

        $reservation = Reservation::findOrFail($id);
        $reservation->status = $status;
        $reservation->save();
        return redirect()->route('admin.reservations.index');



    }

    public function payment_status ($id,$payment){

        $reservation = Reservation::findOrFail($id);
        $reservation->payment = $payment;
        $reservation->save();
        return redirect()->route('admin.reservations.index');



    }


    public function show($id){
        
        $reservation = Reservation::findOrFail($id);
        $chronic_diseases = ChronicDiseases::where('reservation_id',$id)->get();
        $drugs = Drug::where('reservation_id',$id)->get();

        return view('admin.reservations.show', compact('reservation','chronic_diseases','drugs'));
    }



    public function edit($id){
        
        // get reservation based on reservation_id
        $reservation = Reservation::findOrFail($id);
        // get all patients from patients table
        $patients = Patient::all();
        return view('admin.reservations.edit', compact('reservation','patients'));
    }

    public function update(Request $request, $id){
        
        $request->validate([
            'patient_id' => 'required',
            'res_date' => 'required',
            'res_num'=>'required',
            'res_type'=>'required',
            'status'=>'required',
            'payment'=>'required',
            'cost'=>'required',
            ]);

        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->patient_id = $request->patient_id;
            $reservation->res_num = $request->res_num;
            $reservation->first_diagnosis = $request->first_diagnosis;
            // activated on doctor power only
            $reservation->final_diagnosis = $request->final_diagnosis;
            $reservation->res_type = $request->res_type;
            $reservation->cost = $request->cost;
            $reservation->payment = $request->payment;
            $reservation->res_date = $request->res_date;
            $reservation->status = $request->status;
            $reservation->save();

            return redirect()->route('admin.reservations.index')->with('success', 'Reservation updated successfully');
        
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    
    }


          
    public function destroy($id){
        // get reservation based on reservation_id
        $reservation = Reservation::findOrFail($id);
        // delete selected reservation
        $reservation->delete();

        return redirect()->route('admin.reservations.index');

     }



     public function trash(){
        // get all deleted reservations 
        $reservations = Reservation::onlyTrashed()->get();
        return view('admin.reservations.trash',compact('reservations'));
     }



     public function restore($id){
        // get deleted reservation based on reservation_id
        $reservations = Reservation::onlyTrashed()->findOrFail($id);
        // restore deleted reservation based on reservation_id
        $reservations->restore();

        return redirect()->route('admin.reservations.index');

     }


     public function forceDelete($id){
        // get deleted reservation based on reservation_id
        $reservations = Reservation::onlyTrashed()->findOrFail($id);
        // delete deleted reservation forever based on reservation_id
        $reservations->forceDelete();

        return redirect()->route('admin.reservations.index');

     }

     



}
