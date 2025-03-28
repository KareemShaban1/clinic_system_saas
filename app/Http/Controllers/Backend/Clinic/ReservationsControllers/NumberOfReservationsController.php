<?php

namespace App\Http\Controllers\Backend\Clinic\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\SlotsNumbersCheck;
use Illuminate\Http\Request;
use App\Models\NumberOfReservations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class NumberOfReservationsController extends Controller
{
    //

    use SlotsNumbersCheck;
    public function index()
    {

        return view('backend.dashboards.clinic.pages.num_of_reservations.index');
    }

    public function data()
    {
        $num_of_reservations = NumberOfReservations::all();

        return DataTables::of($num_of_reservations)
            ->addColumn('action', function ($number) {
                $editUrl = route('clinic.num_of_reservations.edit', $number->id);
                $deleteUrl = route('clinic.num_of_reservations.destroy', $number->id);

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

        $num_of_reservations = new NumberOfReservations();

        return view('backend.dashboards.clinic.pages.num_of_reservations.add', compact('num_of_reservations'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'reservation_date' => 'required',
            'num_of_reservations' => 'required|integer',
        ]);

        $slots_check = $this->slotsCheck($request->reservation_date);


        if ($slots_check) {
            return redirect()->back()->with('toast_error', 'تم أضافة slots لهذا اليوم');
        } else {
            $data = $request->all();
            $data['clinic_id'] = Auth::user()->clinic_id;
            NumberOfReservations::create($data);
            return redirect()->route('clinic.patients.index')->with('toast_success', 'تم أضافة عدد الحجوزات لهذا اليوم بنجاح');
        }
    }

    public function edit($id)
    {

        $num_of_res =  NumberOfReservations::findOrFail($id);

        return view('backend.dashboards.clinic.pages.num_of_reservations.edit', compact('num_of_res'));
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
            return redirect()->route('clinic.num_of_reservations.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function destroy($id) {}
}
