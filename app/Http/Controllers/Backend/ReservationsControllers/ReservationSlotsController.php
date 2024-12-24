<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\SlotsNumbersCheck;
use App\Models\ReservationSlots;
use DateTime;
use Illuminate\Http\Request;

class ReservationSlotsController extends Controller
{
    //
    use SlotsNumbersCheck;

    public function index()
    {

        $reservation_slots = ReservationSlots::all();

        return view('backend.dashboards.user.pages.reservation_slots.index', compact('reservation_slots'));
    }

    public function add()
    {

        $reservation_slots = new ReservationSlots();

        return view('backend.dashboards.user.pages.reservation_slots.add', compact('reservation_slots'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'date' => 'required|unique:reservation_slots,date',
            ]);


        $resNumber_check = $this->reservationNumberCheck($request->date);


        if($resNumber_check) {
            return redirect()->back()->with('toast_error', 'تم أضافة reservation number لهذا اليوم');
        } else {

            $data = $request->all();
            ReservationSlots::create($data);
            return redirect()->route('backend.reservation_slots.index')->with('toast_success', 'تم أضافة عدد للحجوزات لهذا اليوم بنجاج');

        }
    }

    public function edit($id)
    {

        $reservation_slot =  ReservationSlots::findOrFail($id);

        return view('backend.dashboards.user.pages.reservation_slots.edit', compact('reservation_slot'));
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
