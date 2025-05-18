<?php

namespace App\Http\Controllers\Backend\MedicalLaboratory;

use App\Http\Controllers\Controller;
use App\Http\Traits\TimeSlotsTrait;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\OnlineReservation;
use App\Models\ReservationSlots;
use App\Models\User;
use Carbon\Carbon;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    use TimeSlotsTrait;
    //
    // public function index()
    // {
    //     // get current date on egypt
    //     $current_date = Carbon::now('Egypt')->format('Y-m-d');

    //     // get count of all patients
    //     $patients_count = Patient::count();

    //     $patients = Patient::all();

    //     $user_count = User::count();

    //     // get all reservations
    //     $all_reservations_count = Reservation::count();

    //     $startDate = Carbon::now()->subDays(7);
    //     $endDate = Carbon::now();

    //     $reservations_date = Reservation::whereBetween('date', [$startDate, $endDate])->pluck('date');

    //     // get all reservations
    //     $online_reservations_count = OnlineReservation::count();

    //     // get reservation where date = current_date
    //     $today_res_count = Reservation::where('date', $current_date)->count();

    //     // $medicines_count = Medicine::count();
    //     $medicines_count = 7759;

    //     $today_payment = Reservation::where('date', $current_date)->sum('cost');

    //     $current_month = Carbon::now('Egypt')->format('m');

    //     $month_payment = Reservation::where('month', $current_month)->where('payment', 'paid')->sum('cost');

    //     $last_patients= Patient::select('id', 'name', 'phone')->withCount('reservations')->latest()->take(5)->get();

    //     $reservations = Reservation::with('patient:id,name')->latest()->take(5)->get();

    //     $online_reservations = OnlineReservation::latest()->take(5)->get();

    //     for($i = 0 ;$i<7 ;$i++) {
    //         $date = now()->subDays($i);
    //         $dateFormatted = $date->format('Y-m-d');
    //         $activeClass = $i == 0 ? 'active show' : '';
    //         $number_of_slot = ReservationSlots::where('date', '=', $dateFormatted)->first();
    //         $slots = $number_of_slot ? $this->getTimeSlot($number_of_slot->duration, $number_of_slot->start_time, $number_of_slot->end_time) : [];
    //     }


    //     $user_chart_options = [
    //         'chart_title' => 'Patients by months',
    //         'report_type' => 'group_by_date',
    //         'model' => 'App\Models\Patient',
    //         'group_by_field' => 'created_at',
    //         'chart_color'=>'155, 0, 0',
    //         'chart_height'=>'450px',
    //         'group_by_period' => 'day',
    //         'chart_type' => 'bar',
    //     ];
    //     $user_chart = new LaravelChart($user_chart_options);


    //     $reservation_chart_options = [
    //         'chart_title' => 'Res by months',
    //         'report_type' => 'group_by_date',
    //         'model' => 'App\Models\Reservation',
    //         'chart_color'=>'0, 0,67',
    //         'chart_height'=>'450px',
    //         'group_by_field' => 'created_at',
    //         'group_by_period' => 'day',
    //         'chart_type' => 'bar',
    //     ];
    //     $reservation_chart = new LaravelChart($reservation_chart_options);

    //     return view('backend.dashboards.clinic.pages.dashboard.index', compact(
    //         'user_chart',
    //         'reservation_chart',
    //         'patients_count',
    //         'all_reservations_count',
    //         'online_reservations_count',
    //         'today_res_count',
    //         'today_payment',
    //         'month_payment',
    //         'medicines_count',
    //         'user_count',
    //         'last_patients',
    //         'patients',
    //         'reservations',
    //         'online_reservations',
    //         'startDate',
    //         'endDate',
    //         'slots'
    //     ));
    // }

    public function index()
    {
        return view('backend.dashboards.medicalLaboratory.pages.dashboard.index');
    }

}
