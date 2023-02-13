<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;


class FeeController extends Controller
{
    // function to get sum of cost of (today reservations)
    public function today(){
        
        // get current date on egypt
        $current_date = Carbon::now('Egypt')->format('Y-m-d');
        // get reservation based on reservation_date (today reservations)
        $reservations = Reservation::where('res_date', $current_date)->get();
        // get sum of cost of (today reservations)
        $cost_sum = Reservation::where('res_date', $current_date)->sum('cost'); 

        return view('admin.fees.today',compact('current_date','reservations','cost_sum'));
        
    }

    public function month(){
        // $current_month = Carbon::now('Egypt')->format('m');

        // $res_month = Carbon::parse($reservation->res_date)->format('m');

        // $reservations = Reservation::where('res_date',$current_month)->get();

        // foreach($reservations as $reservation){
        // // dd($reservation->res_date->format('M'));
        // dd($reservation);
        // }
        // $cost_sum = Reservation::where('res_date', $current_date)->sum('cost'); 
        // dd($cost_sum);
        // return view('admin.fees.today');
        
    }

    public function index(){
        // get current date on egypt
        $current_date = Carbon::now('Egypt')->format('Y-m-d');
        // get all reservations
        $reservations = Reservation::all();

        return view('admin.fees.index',compact('current_date','reservations'));
        
    }
}
