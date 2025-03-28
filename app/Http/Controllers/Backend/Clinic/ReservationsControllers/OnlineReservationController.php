<?php

namespace App\Http\Controllers\Backend\Clinic\ReservationsControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OnlineReservation;
use App\Http\Traits\ZoomMeetingTrait;
use App\Models\Patient;
use MacsiDigital\Zoom\Facades\Zoom;
use Carbon\carbon;
use Yajra\DataTables\Facades\DataTables;

class OnlineReservationController extends Controller
{
    //
    use ZoomMeetingTrait;

    public function index()
    {
        $online_reservations = OnlineReservation::all();
        return view('backend.dashboards.clinic.pages.online_reservations.index', compact('online_reservations'));
    }

    public function data()
{
    $online_reservations = OnlineReservation::with('patient')->get();

    return DataTables::of($online_reservations)
        ->addColumn('patient_name', function ($row) {
            return $row->patient->name ?? '-';
        })
        ->addColumn('join_url', function ($row) {
            return '<a href="' . $row->join_url . '" target="_blank" class="text-danger">انضم الان</a>';
        })
        ->addColumn('action', function ($row) {
            return '
                <button type="button" class="btn btn-sm btn-danger delete" 
                        data-toggle="modal" 
                        data-target="#Delete_receipt' . $row->meeting_id . '">
                    <i class="fa fa-trash"></i>
                </button>';
        })
        ->rawColumns(['join_url', 'action'])
        ->make(true);
}

    public function add($id)
    {
        // get all patients on patient table
        $patient = Patient::findOrFail($id);
        // get new instance from reservation model
        $online_reservation = new OnlineReservation();

        $current_date = Carbon::now('Egypt')->format('Y-m-d');

        return view('backend.dashboards.clinic.pages.online_reservations.add', compact('patient', 'online_reservation'));
    }
    public function store(Request $request)
    {

        $meeting = $this->createMeeting($request);

        OnlineReservation::create([
            'integration' => true,
            'user_id' => auth()->user()->id,
            'id' => $request->id,
            'created_by' => auth()->user()->email,
            'meeting_id' => $meeting->id,
            'topic' => $request->topic,
            'start_at' => $request->start_time,
            'duration' => $meeting->duration,
            'password' => $meeting->password,
            'start_url' => $meeting->start_url,
            'join_url' => $meeting->join_url,
            'first_diagnosis' => $request->first_diagnosis,
            'final_diagnosis' => $request->final_diagnosis,
            'res_type' => $request->res_type,
            'cost' => $request->cost,
            'payment' => $request->res_type,

        ]);

        return redirect()->route('backend.online_reservations.index')->with('success', 'Reservation added successfully');


    }
    public function edit()
    {

    }
    public function update()
    {

    }
    public function show()
    {

    }

    public function destroy(Request $request)
    {
        try {

            $info = OnlineReservation::find($request->id);

            if($info->integration == true) {
                $meeting = Zoom::meeting()->find($request->meeting_id);
                $meeting->delete();
                // online_classe::where('meeting_id', $request->id)->delete();
                OnlineReservation::destroy($request->id);
            } else {
                // online_classe::where('meeting_id', $request->id)->delete();
                OnlineReservation::destroy($request->id);
            }

            return redirect()->route('backend.online_reservations.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
}
