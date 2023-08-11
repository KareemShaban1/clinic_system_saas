<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Requests\Backend\ {
    StoreReservationRequest,
    UpdateReservationRequest,
};
use App\Models\ {
    ChronicDisease,
    NumberOfReservations,
    SystemControl,
    Reservation,
    Patient,
    Drug,
    Ray,
    ReservationSlots,
    Settings,
};
use App\Http\Controllers\Controller;
use App\Http\Traits\AuthorizeCheck;
use App\Http\Traits\TimeSlotsTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;

class ReservationController extends Controller
{
    use TimeSlotsTrait , AuthorizeCheck;

    protected $reservation;
    protected $systemControl;
    protected $numberOfReservations;
    protected $settings;
    protected $patient;
    protected $chronic_disease;
    protected $drug;
    protected $ray;
    protected $reservationSlots;

    public function __construct(
        Reservation $reservation,
        SystemControl $systemControl,
        NumberOfReservations $numberOfReservations,
        Settings $settings,
        Patient $patient,
        ChronicDisease $chronic_disease,
        Drug $drug,
        Ray $ray,
        ReservationSlots $reservationSlots
    ) {
        $this->reservation = $reservation;
        $this->systemControl = $systemControl;
        $this->numberOfReservations = $numberOfReservations;
        $this->settings = $settings;
        $this->patient = $patient;
        $this->chronic_disease = $chronic_disease;
        $this->drug = $drug;
        $this->ray = $ray;
        $this->$reservationSlots = $reservationSlots;
    }

    // ...

    public function index()
    {
        $this->authorizeCheck('عرض الكشوفات');

        $reservations = $this->reservation->with('patient:patient_id,name')->get();
        $reservation_settings = $this->systemControl->pluck('value', 'key');
        $clinic_type = $this->settings->where('key', 'clinic_type')->value('value');

        return view('backend.pages.reservations.index', 
        compact('reservations', 'reservation_settings', 'clinic_type'));
    }



    public function todayReservations()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $reservations = $this->reservation->whereDate('res_date', Carbon::now())->get();
        $reservation_settings = $this->systemControl->pluck('value', 'key');
        $clinic_type = $this->settings->where('key', 'clinic_type')->value('value');


        return view(
            'backend.pages.reservations.today',
            compact('reservations', 'reservation_settings', 'currentDate','clinic_type')
        );
    }

    public function todayReservationReport()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $reservations = $this->reservation->where('res_date', $currentDate)->get();
        $costSum = $reservations->sum('cost');

        $data = [
            'reservations' => $reservations,
            'cost_sum' => $costSum,
        ];

        $pdf = PDF::loadView('backend.pages.reservations.today_reservation_report', $data);
        return $pdf->stream('Report.pdf');
    }

    // ...

    public function add($id)
    {
        $this->authorizeCheck('أضافة كشف');

        $settings = $this->systemControl->pluck('value', 'key');
        

        $patient = $this->patient->findOrFail($id);

        $currentDate = Carbon::now('Egypt')->addHour()->format('Y-m-d');


        return view(
            'backend.pages.reservations.add',
            compact(
                'patient',
                'settings'
            )
        );
    }

    public function store(StoreReservationRequest $request)
    {
        $this->authorizeCheck('أضافة كشف'); 

        try {
            $request->validated();
            $data = $request->all();
            $data['month'] = substr($request->res_date, 5, 7 - 5);
            $data['acceptance'] = 'approved';

            $this->reservation->create($data);

            return redirect()->route('backend.reservations.index')->with('success', 'Reservation added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function show($id)
    {
        $this->authorizeCheck('عرض كشف'); 

        // get reservation based on id
        $reservation = $this->reservation->findOrFail($id);
        // get all chronic_diseases of reservation
        $chronic_diseases = $this->chronic_disease->where('reservation_id', $id)->get();
        // get all drugs of reservation
        $drugs =$this->drug->where('reservation_id', $id)->get();
        // get all rays of reservation
        $rays = $this->ray->where('reservation_id', $id)->get();

        return view('backend.pages.reservations.show', compact('reservation', 'chronic_diseases', 'drugs', 'rays'));
    }


    public function edit($id)
    {
        $this->authorizeCheck('تعديل كشف');

        $settings = $this->systemControl->pluck('value', 'key');

        $reservation = $this->reservation->findOrFail($id);

        // get res_num based on res_date
        $reservationResNum = $this->reservation->where('res_date', $reservation->res_date)->value('res_num');

        // number of reservation based on reservation_date
        $numberOfRes = $this->numberOfReservations->where('reservation_date', $reservation->res_date)->value('num_of_reservations');

        $reservationSlot = $this->reservation->where('res_date', $reservation->res_date)->value('slot');

        $reservationSlots = ReservationSlots::where('date', $reservation->res_date)->first();

        $slots = $reservationSlots
        ? $this->getTimeSlot($reservationSlots->duration, $reservationSlots->start_time, $reservationSlots->end_time)
        : [];

        if($reservation->res_num) {
            $reservationType = 'reservation_number';
        }
        if($reservation->slot) {
            $reservationType = 'slot';
        }
        return view(
            'backend.pages.reservations.edit',
            compact(
                'reservation',
                'numberOfRes',
                'reservationResNum',
                'settings',
                'slots',
                'reservationSlot',
                'reservationType'
            )
        );
    }


    public function update(UpdateReservationRequest $request, $id)
    {
        $this->authorizeCheck('تعديل كشف');

        try {
            $reservation = $this->reservation->findOrFail($id);
            $reservation->fill($request->validated());
            $reservation->save();

            return redirect()->route('backend.reservations.index')->with('success', 'Reservation updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function destroy($id)
    {
        $this->authorizeCheck('حذف كشف'); 
        $reservation = $this->reservation->findOrFail($id);
        $reservation->delete();

        return redirect()->route('backend.reservations.index');
    }

    public function trash()
    {
        $this->authorizeCheck('حذف كشف'); 
        $reservations = $this->reservation->onlyTrashed()->get();

        return view('backend.pages.reservations.trash', compact('reservations'));
    }

    public function restore($id)
    {
        $this->authorizeCheck('حذف كشف'); 
        $reservation = $this->reservation->onlyTrashed()->findOrFail($id);
        $reservation->restore();

        return redirect()->route('backend.reservations.index');
    }

    public function forceDelete($id)
    {
        $this->authorizeCheck('حذف كشف'); 
        $reservation = $this->reservation->onlyTrashed()->findOrFail($id);
        $reservation->forceDelete();

        return redirect()->route('backend.reservations.index');
    }



    public function getResNumberOrSlotAdd(Request $request)
    {

        $res_date =  $request->res_date;

        // if system use reservation numbers not slots
        $reservation_res_num = Reservation::where('res_date', $res_date)->pluck('res_num')->map(function ($item) {
            return intval($item);
        })->toArray();
        $number_of_res = NumberOfReservations::where('reservation_date', $res_date)->value('num_of_reservations');


        // if system use reservation slots not numbers
        $reservation_slots = Reservation::where('res_date', $res_date)
        ->where('slot', '<>', 'null')->pluck('slot')->toArray();
        $number_of_slot = ReservationSlots::where('date', $res_date)->first();
        $slots = $number_of_slot ? $this->getTimeSlot($number_of_slot->duration, $number_of_slot->start_time, $number_of_slot->end_time) : [];


        // Create an associative array or Laravel collection with the values
        $data = [
            'reservationsCount' => $number_of_res,
            'todayReservationResNum' => $reservation_res_num,
            'slots' => $slots,
            'number_of_slot' => $number_of_slot,
            'today_reservation_slots' =>  $reservation_slots
        ];

        // Return the data as JSON response
        return response()->json($data);

    }

    public function getResNumberOrSlotEdit(Request $request)
    {

        $res_date =  $request->res_date;
        $res_id = $request->res_id;

        $reservation = Reservation::findOrFail($res_id);

        // if system use reservation numbers not slots
        $reservation_res_num = Reservation::where('res_date', $res_date)->pluck('res_num')->map(function ($item) {
            return intval($item);
        })->toArray();
        $number_of_res = NumberOfReservations::where('reservation_date', $res_date)->value('num_of_reservations');


        // if system use reservation slots not numbers
        $reservation_slots = Reservation::where('res_date', $res_date)
        ->where('slot', '<>', 'null')->pluck('slot')->toArray();
        $number_of_slot = ReservationSlots::where('date', $res_date)->first();
        $slots = $number_of_slot ? $this->getTimeSlot($number_of_slot->duration, $number_of_slot->start_time, $number_of_slot->end_time) : [];


        // Create an associative array or Laravel collection with the values
        $data = [
            'reservation'=>$reservation,
            'reservationsCount' => $number_of_res,
            'todayReservationResNum' => $reservation_res_num,
            'slots' => $slots,
            'number_of_slot' => $number_of_slot,
            'today_reservation_slots' =>  $reservation_slots
        ];

        // Return the data as JSON response
        return response()->json($data);

    }
    
}
