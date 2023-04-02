<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\OnlineReservation;
use App\Models\Medicine;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function index()
    
    {
        // get current date on egypt
        $current_date = Carbon::now('Egypt')->format('Y-m-d');

        // get count of all patients
        $patients_count = Patient::all()->count();
       

        // get all reservations 
        $all_reservations_count = Reservation::all()->count();

         // get all reservations 
         $online_reservations_count = OnlineReservation::all()->count();

        // get reservation where res_date = current_date
        $today_res_count = Reservation::where('res_date', $current_date)->count();

        $medicines_count = Medicine::all()->count();

        // 

        
        $today_payment = Reservation::where('res_date', $current_date)->sum('cost'); 

        $current_month = Carbon::now('Egypt')->format('m');

        $month_payment = Reservation::where('month', $current_month)->where('payment','paid')->sum('cost');

        

        
        return view('backend.pages.dashboard.index',compact(
            'patients_count',
            'all_reservations_count',
            'online_reservations_count',
            'today_res_count',
            'today_payment',
            'month_payment',
            'medicines_count'));
    }

    
}
