<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Reservation;
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
       
        // get reservation where res_date = current_date
        $today_res_count = Reservation::where('res_date', $current_date)->count();

        $medicines_count = Medicine::all()->count();

        // 
        $cost_sum = Reservation::where('res_date', $current_date)->sum('cost'); 
        

        
        return view('admin.dashboard.index',compact('patients_count','today_res_count','cost_sum','medicines_count'));
    }

    
}
