<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\OnlineReservation;
use App\Models\Medicine;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // get current date on egypt
        $current_date = Carbon::now('Egypt')->format('Y-m-d');

        // get count of all patients
        $patients_count = Patient::count();

        $user_count = User::count();

        // get all reservations
        $all_reservations_count = Reservation::count();

        // get all reservations
        $online_reservations_count = OnlineReservation::count();

        // get reservation where res_date = current_date
        $today_res_count = Reservation::where('res_date', $current_date)->count();

        // $medicines_count = Medicine::count();
        $medicines_count = 7759;

        $today_payment = Reservation::where('res_date', $current_date)->sum('cost');

        $current_month = Carbon::now('Egypt')->format('m');

        $month_payment = Reservation::where('month', $current_month)->where('payment', 'paid')->sum('cost');

        $patients= Patient::select('patient_id','name','phone')->withCount('reservations')->latest()->take(5)->get();
        
        $reservations = Reservation::with('patient:patient_id,name')->latest()->take(5)->get();

        $online_reservations = OnlineReservation::latest()->take(5)->get();


        return view('backend.pages.dashboard.index', compact(
            'patients_count',
            'all_reservations_count',
            'online_reservations_count',
            'today_res_count',
            'today_payment',
            'month_payment',
            'medicines_count',
            'user_count',
            'patients',
            'reservations',
            'online_reservations'
        ));
    }


}
