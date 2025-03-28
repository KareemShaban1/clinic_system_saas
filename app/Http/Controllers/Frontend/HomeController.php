<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Traits\TimeSlotsTrait;
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

        return view('frontend.home',compact('patients','reservations'));
    }

    public function dashboard()
    {
        // get all reservations
        $all_reservations_count = Reservation::where('id', Auth::user('patient')->id)->count();

        $approved_reservations_count = Reservation::where('id', Auth::user('patient')->id)
        ->where('acceptance', 'approved')
        ->count();

        $not_approved_reservations_count = Reservation::where('id', Auth::user('patient')->id)
        ->where('acceptance', 'not_approved')
        ->count();
        return view(
            'backend.dashboards.patient.pages.dashboard.index',
            compact(
                'all_reservations_count',
                'approved_reservations_count',
                'not_approved_reservations_count'
            )
        );
    }


}
