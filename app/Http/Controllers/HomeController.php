<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\TimeSlotsTrait;
use App\Models\Clinic;
use App\Models\Patient;
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

        $patients = Patient::count();
        $reservations = Reservation::count();

        return view('frontend.pages.home',compact('patients','reservations'));
    }

    public function clinics()
    {
        $clinics = Clinic::all();
        return view('frontend.pages.clinics',compact('clinics'));
    }


}
