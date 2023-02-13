<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NumberOfReservations;

class NumberOfReservationsController extends Controller
{
    //

    public function index(){

        $num_of_reservations = NumberOfReservations::all();
        
        return view('admin.num_of_reservations.index',compact('num_of_reservations'));
    }

    public function add(){

        $num_of_reservations =new NumberOfReservations;
        
        return view('admin.num_of_reservations.add',compact('num_of_reservations'));
    }

    public function store(Request $request){

        $request->validate([
            'reservation_date' => 'required',
            'num_of_reservations' => 'required',
            
            ]);

            $num_of_reservations = new NumberOfReservations;

            $num_of_reservations->reservation_date = $request->reservation_date;
            $num_of_reservations->num_of_reservations = $request->num_of_reservations;
            $num_of_reservations->save();

            return redirect()->route('admin.num_of_reservations.index');


    }

    public function edit($id){

        $num_of_res =  NumberOfReservations::findOrFail($id);

        return view('admin.num_of_reservations.edit',compact('num_of_res'));


    }

    public function update(Request $request,$id){

        $request->validate([
            'reservation_date' => 'required',
            'num_of_reservations' => 'required',
            ]);

            try{

            $num_of_reservations = NumberOfReservations::findOrFail($id);
            $num_of_reservations->reservation_date = $request->reservation_date;
            $num_of_reservations->num_of_reservations = $request->num_of_reservations;
            $num_of_reservations->save();

            return redirect()->route('admin.num_of_reservations.index');

        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }



    }
}
