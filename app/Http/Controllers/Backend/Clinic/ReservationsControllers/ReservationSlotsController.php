<?php

namespace App\Http\Controllers\Backend\Clinic\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\SlotsNumbersCheck;
use App\Models\ReservationSlots;
use DateTime;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReservationSlotsController extends Controller
{
    //
    use SlotsNumbersCheck;

    public function index()
    {

        $reservation_slots = ReservationSlots::all();

        return view('backend.dashboards.clinic.pages.reservation_slots.index', compact('reservation_slots'));
    }

    public function data()
    {
        $reservationSlots = ReservationSlots::all();

        return DataTables::of($reservationSlots)
            ->addColumn('action', function ($number) {
                $editUrl = route('backend.reservation_slots.edit', $number->id);
                $deleteUrl = route('backend.reservation_slots.destroy', $number->id);

                return '
                    <a href="' . $editUrl . '" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                ';
            })
            ->rawColumns(['action']) // Ensure the HTML in the action column is not escaped
            ->make(true);
    }

    public function add()
    {

        $reservation_slots = new ReservationSlots();

        return view('backend.dashboards.clinic.pages.reservation_slots.add', compact('reservation_slots'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'date' => 'required|unique:reservation_slots,date',
        ]);


        $resNumber_check = $this->reservationNumberCheck($request->date);


        if ($resNumber_check) {
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

        return view('backend.dashboards.clinic.pages.reservation_slots.edit', compact('reservation_slot'));
    }

    public function update(Request $request, $id)
    {


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
