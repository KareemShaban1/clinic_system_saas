<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\SlotsNumbersCheck;
use Illuminate\Http\Request;
use App\Models\NumberOfReservations;
use Illuminate\Validation\Rule;

class NumberOfReservationsController extends Controller
{
    //

    use SlotsNumbersCheck;
    public function index()
    {

        $num_of_reservations = NumberOfReservations::all();

        return view('backend.pages.num_of_reservations.index', compact('num_of_reservations'));
    }

    public function add()
    {

        $num_of_reservations = new NumberOfReservations();

        return view('backend.pages.num_of_reservations.add', compact('num_of_reservations'));
    }

    public function store(Request $request)
    {

        $request->validate([
        'reservation_date' => 'required',
        'num_of_reservations' => 'required|integer',
        ]);

        $slots_check = $this->slotsCheck($request->reservation_date);


        if($slots_check) {
            return redirect()->back()->with('toast_error', 'تم أضافة slots لهذا اليوم');
        } else {
            $data = $request->all();
            NumberOfReservations::create($data);
            return redirect()->route('backend.patients.index')->with('toast_success', 'تم أضافة عدد الحجوزات لهذا اليوم بنجاح');
        }


    }

    public function edit($id)
    {

        $num_of_res =  NumberOfReservations::findOrFail($id);

        return view('backend.pages.num_of_reservations.edit', compact('num_of_res'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'reservation_date' => 'required',
            'num_of_reservations' => 'required|integer',
            'num_of_reservations' => Rule::unique('number_of_reservations')->where(function ($query) use ($request) {
                return $query->where('reservation_date', $request->reservation_date);
            }),
            ], [
                'num_of_reservations.unique' => 'عدد الحجوزات موجود بالنسبة لليوم'
            ]);

        try {
            $data = $request->all();
            $num_of_reservations = NumberOfReservations::findOrFail($id);
            $num_of_reservations->update($data);
            return redirect()->route('backend.num_of_reservations.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function destroy($id) {}
}