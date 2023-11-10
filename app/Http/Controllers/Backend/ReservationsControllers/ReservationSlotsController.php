<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Models\ReservationSlots;
use DateTime;
use Illuminate\Http\Request;

class ReservationSlotsController extends Controller
{
    //

    public function index()
    {

        $reservation_slots = ReservationSlots::all();

        return view('backend.pages.reservation_slots.index', compact('reservation_slots'));
    }

    public function add()
    {

        $reservation_slots = new ReservationSlots;

        return view('backend.pages.reservation_slots.add', compact('reservation_slots'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'date' => 'required|unique:reservation_slots,date',        
            ]);

            $data = $request->all();
            ReservationSlots::create($data);

        // $reservation_slots = new ReservationSlots;

        // $reservation_slots->date = $request->date;
        // $reservation_slots->start_time = $request->start_time;
        // $reservation_slots->end_time = $request->end_time;
        // $reservation_slots->duration = $request->duration;
        // $reservation_slots->total_reservations = $request->total_reservations;
        // $reservation_slots->save();

        return redirect()->route('backend.reservation_slots.index');
    }

    public function edit($id)
    {

        $reservation_slot =  ReservationSlots::findOrFail($id);

        return view('backend.pages.reservation_slots.edit', compact('reservation_slot'));
    }

    public function update(Request $request, $id)
    {

        // $request->validate([
        //     'reservation_date' => 'required',
        //     'num_of_reservations' => 'required',
        //     ]);

        try {

            $reservation_slots = ReservationSlots::findOrFail($id);
            $data = $request->all();
            $reservation_slots->update($data);

            return redirect()->route('backend.reservation_slots.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    
}