<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\NumberOfReservations;
use App\Models\ReservationControl;
use App\Models\ChronicDiseases;
use App\Models\Reservation;
use App\Models\Patient;
use App\Models\Drug;
use App\Models\Ray;
use Carbon\Carbon;
use PDF;

class ReservationController extends Controller
{
    //
    public function index()
    {
        // get all reservations 
        $reservations = Reservation::all();
        // get reservation controls
        $reservation_controls = ReservationControl::all();
        $setting = $reservation_controls->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });


        return view('backend.pages.reservations.index', compact('reservations','setting'));
    }

    public function today_reservation_report(){

        $current_date = Carbon::now()->format('Y-m-d');
        // get reservation where res_date = current_date
        $reservations = Reservation::where('res_date', $current_date)->get();
        $cost_sum = Reservation::where('res_date', $current_date)->sum('cost'); 

        $data= [];
        $data['reservations'] = $reservations;
        $data['cost_sum'] = $cost_sum;
       
        $pdf = PDF::loadView('backend.pages.reservations.today_reservation_report',$data);
        return $pdf->stream( 'Report.pdf');
    }


    // get today_reservations

    public function today_reservations()
    {
        $collection = ReservationControl::all();
        $setting = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
            
        });

        // get current date on egypt
        $current_date = Carbon::now()->format('Y-m-d');
        // get reservation where res_date = current_date
        $reservations = Reservation::where('res_date', $current_date)->get();

        return view('backend.pages.reservations.today', compact('reservations','current_date','setting'));
    }


    public function add($id){
        
        // get all patients on patient table
        $patient = Patient::findOrFail($id);
        
        // get new instance from reservation model
        $reservation = new Reservation;

        $current_date = Carbon::now('Egypt')->format('Y-m-d');

        $today_reservation_res_num = Reservation::where('res_date', $current_date)->value('res_num');


        $number_of_res = NumberOfReservations::where('reservation_date',$current_date)->value('num_of_reservations');

        if($number_of_res  == null){
            return redirect()->route('backend.num_of_reservations.add');
        }
        return view('backend.pages.reservations.add', compact('patient','reservation','number_of_res','today_reservation_res_num'));
        
    }



    public function store(StoreReservationRequest $request)
    {

        try {

            $validated = $request->validated();


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
            $reservation->month =  substr($request->res_date, 5, 7 - 5);
            $reservation->status = $request->status;
            $reservation->save();
            
            return redirect()->route('backend.reservations.index')->with('success', 'Reservation added successfully');
        
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function reservation_status ($id,$status){

        $reservation = Reservation::findOrFail($id);
        $reservation->status = $status;
        $reservation->save();
        return redirect()->route('backend.reservations.index');



    }

    public function payment_status ($id,$payment){

        $reservation = Reservation::findOrFail($id);
        $reservation->payment = $payment;
        $reservation->save();
        return redirect()->route('backend.reservations.index');



    }


    public function show($id){
        
        $reservation = Reservation::findOrFail($id);
        $chronic_diseases = ChronicDiseases::where('reservation_id',$id)->get();
        $drugs = Drug::where('reservation_id',$id)->get();
        $rays = Ray::where('reservation_id',$id)->get();

        return view('backend.pages.reservations.show', compact('reservation','chronic_diseases','drugs','rays'));
    }



    public function edit($id){
        
        // get reservation based on reservation_id
        $reservation = Reservation::findOrFail($id);
        // get all patients from patients table
        $patients = Patient::all();

        // get current date in egypt
        $current_date = Carbon::now('Egypt')->format('Y-m-d');
        
        // get reservation_number of this reservation 
        $today_reservation_res_num = Reservation::where('res_date', $reservation->res_date)->value('res_num');

        // get number of reservations based on this reservation res_date
        $number_of_res = NumberOfReservations::where('reservation_date',$reservation->res_date)->value('num_of_reservations');

        return view('backend.pages.reservations.edit', compact('reservation','patients','number_of_res','today_reservation_res_num'));
    }

    public function update(StoreReservationRequest $request, $id){
        

        try {

            $validated = $request->validated();

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

            return redirect()->route('backend.reservations.index')->with('success', 'Reservation updated successfully');
        
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    
    }


          
    public function destroy($id){
        // get reservation based on reservation_id
        $reservation = Reservation::findOrFail($id);
        // delete selected reservation
        $reservation->delete();

        return redirect()->route('backend.reservations.index');

     }



     public function trash(){
        // get all deleted reservations 
        $reservations = Reservation::onlyTrashed()->get();
        return view('backend.pages.reservations.trash',compact('reservations'));
     }



     public function restore($id){
        // get deleted reservation based on reservation_id
        $reservations = Reservation::onlyTrashed()->findOrFail($id);
        // restore deleted reservation based on reservation_id
        $reservations->restore();

        return redirect()->route('backend.reservations.index');

     }


     public function forceDelete($id){
        // get deleted reservation based on reservation_id
        $reservations = Reservation::onlyTrashed()->findOrFail($id);
        // delete deleted reservation forever based on reservation_id
        $reservations->forceDelete();

        return redirect()->route('backend.reservations.index');

     }

     



}
