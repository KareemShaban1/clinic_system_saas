<?php

namespace App\Http\Controllers\Backend\Patient;

use App\Http\Controllers\Controller;
use App\Http\Traits\TimeSlotsTrait;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\ReservationSlots;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    use TimeSlotsTrait;

    public function dashboard()
    {
        // patient clinics
        $clinics = Auth::user()->clinic();
        $clinics_count = $clinics->count();

        // get all reservations
        $all_reservations_count = Reservation::where('id', Auth::user()->id)->count();

        $approved_reservations_count = Reservation::where('id', Auth::user()->id)
        ->where('acceptance', 'approved')
        ->count();

        $not_approved_reservations_count = Reservation::where('id', Auth::user()->id)
        ->where('acceptance', 'not_approved')
        ->count();
        return view(
            'backend.dashboards.patient.pages.dashboard.index',
            compact(
                'clinics_count',
                'all_reservations_count',
                'approved_reservations_count',
                'not_approved_reservations_count'
            )
        );
    }


}
