<?php

namespace App\Http\Controllers\Backend\Clinic\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthorizeCheck;
use App\Models\OnlineReservation;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class FeeController extends Controller
{
    use AuthorizeCheck;
    // function to get sum of cost of (today reservations)
    public function today()
    {

        $this->authorizeCheck('view-fees');

        // get current date on egypt
        $current_date = Carbon::now('Egypt')->format('Y-m-d');

        // get reservation based on reservation_date (today reservations)
        $reservations = Reservation::where('date', $current_date)->get();

        // get sum of cost of (today reservations)
        $cost_sum = Reservation::where('date', $current_date)
            ->where('payment', 'paid')->sum('cost');

        $current_month = Carbon::now('Egypt')->format('m');

        $month_res = Reservation::where('month', $current_month)->get();

        $online_reservation = OnlineReservation::where('start_at', $current_date)->get();

        return view('backend.dashboards.clinic.pages.fees.today', compact('current_date', 'reservations', 'cost_sum'));
    }

    public function month()
    {
        $this->authorizeCheck('view-fees');

        $current_date = Carbon::now('Egypt')->format('Y-m-d');

        $current_month = Carbon::now('Egypt')->format('m');

        $reservations = Reservation::where('month', $current_month)->get();

        $cost_sum = $reservations->where('payment', 'paid')->sum('cost');

        return view('backend.dashboards.clinic.pages.fees.month', compact('reservations', 'current_date', 'current_month', 'cost_sum'));
    }

    public function index()
    {
        $this->authorizeCheck('view-fees');
        // get current date on egypt
        $current_date = Carbon::now('Egypt')->format('Y-m-d');
        // get all reservations
        $reservations = Reservation::all();

        return view('backend.dashboards.clinic.pages.fees.index', compact('current_date', 'reservations'));
    }

    public function data(Request $request)
    {
        $filter = $request->input('filter', 'today');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $query = Reservation::query();
    
        switch ($filter) {
            case 'today':
                $query->whereDate('date', Carbon::today());
                break;
            case 'week':
                $query->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('date', Carbon::now()->month)
                      ->whereYear('date', Carbon::now()->year);
                break;
            case 'custom':
                if ($startDate && $endDate) {
                    $query->whereBetween('date', [$startDate, $endDate]);
                }
                break;
        }
    
        // Clone the query to get total before applying pagination
        $totalCost = $query->sum('cost');
    
        return DataTables::of($query)
            ->addColumn('patient_name', fn($r) => $r->patient->name ?? '-')
            ->addColumn('reservation_number', fn($r) => $r->reservation_number)
            ->addColumn('payment', fn($r) => $r->payment === 'paid' ? trans('backend/fees_trans.Paid') : trans('backend/fees_trans.Not_Paid'))
            ->addColumn('cost', fn($r) => $r->cost)
            ->addColumn('date', fn($r) => $r->date)
            ->addColumn('total', fn($r) => $r->total)
            ->with(['total_cost' => $totalCost]) 
            ->make(true);
    }
    
}
