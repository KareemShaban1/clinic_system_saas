<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Traits\TimeSlotsTrait;
use App\Models\Reservation;
use App\Models\ReservationSlots;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use TimeSlotsTrait;

    //
    public function index()
    {
        
        return view('frontend.home');
    }

    public function dashboard()
    {
          // get all reservations 
          $all_reservations_count = Reservation::where('patient_id',Auth::user('patient')->patient_id)->count();
          
          $approved_reservations_count = Reservation::
          where('patient_id',Auth::user('patient')->patient_id)
          ->where('status','active')
          ->count();
          
          $not_approved_reservations_count = Reservation::
          where('patient_id',Auth::user('patient')->patient_id)
          ->where('status','inactive')
          ->count();
          return view('frontend.Patient_Dashboard.dashboard.index',
          compact(
            'all_reservations_count',
            'approved_reservations_count',
            'not_approved_reservations_count'
    ));
    }

    
}
