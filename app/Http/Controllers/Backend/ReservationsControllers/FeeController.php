<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Models\OnlineReservation;
use App\Models\Reservation;
use Carbon\Carbon;

class FeeController extends Controller
{
    // function to get sum of cost of (today reservations)
    public function today()
    {

        $this->authorizeCheck('عرض الحسابات اليومية');

        // get current date on egypt
        $current_date = Carbon::now('Egypt')->format('Y-m-d');

        // get reservation based on reservation_date (today reservations)
        $reservations = Reservation::where('res_date', $current_date)->get();

        // get sum of cost of (today reservations)
        $cost_sum = Reservation::where('res_date', $current_date)->where('payment', 'paid')->sum('cost');

        $current_month = Carbon::now('Egypt')->format('m');

        $month_res = Reservation::where('month', $current_month)->get();

        $online_reservation = OnlineReservation::where('start_at', $current_date)->get();

        return view('backend.pages.fees.today', compact('current_date', 'reservations', 'cost_sum'));

    }

    public function month()
    {
        $this->authorizeCheck('عرض الحسابات الشهرية');

        $current_date = Carbon::now('Egypt')->format('Y-m-d');

        $current_month = Carbon::now('Egypt')->format('m');

        $reservations = Reservation::where('month', $current_month)->get();

        $cost_sum = $reservations->where('payment', 'paid')->sum('cost');

        return view('backend.pages.fees.month', compact('reservations', 'current_date', 'current_month', 'cost_sum'));

    }

    public function index()
    {
        $this->authorizeCheck('عرض جميع الحسابات');
        // get current date on egypt
        $current_date = Carbon::now('Egypt')->format('Y-m-d');
        // get all reservations
        $reservations = Reservation::all();

        return view('backend.pages.fees.index', compact('current_date', 'reservations'));

    }
}
