<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Requests\Backend\ {
    StoreReservationRequest,
    UpdateReservationRequest,
};
use App\Models\ {
    ChronicDisease,
    NumberOfReservations,
    ReservationControl,
    Reservation,
    Patient,
    Drug,
    Ray,
    ReservationSlots,
    Settings,
};
use App\Http\Controllers\Controller;
use App\Http\Traits\TimeSlotsTrait;
use Carbon\Carbon;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;

class ReservationController extends Controller
{
    use TimeSlotsTrait;

    protected $reservation;
    protected $reservationControl;
    protected $numberOfReservations;
    protected $settings;
    protected $patient;
    protected $chronic_disease;
    protected $drug;
    protected $ray;
    protected $reservationSlots;

    public function __construct(
        Reservation $reservation,
        ReservationControl $reservationControl,
        NumberOfReservations $numberOfReservations,
        Settings $settings,
        Patient $patient,
        ChronicDisease $chronic_disease,
        Drug $drug,
        Ray $ray,
        ReservationSlots $reservationSlots
    ) {
        $this->reservation = $reservation;
        $this->reservationControl = $reservationControl;
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
        $reservations = $this->reservation->get();
        $settings = $this->reservationControl->pluck('value', 'key');
        $clinic_type = $this->settings->where('key', 'clinic_type')->value('value');

        return view('backend.pages.reservations.index', compact('reservations', 'settings', 'clinic_type'));
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

    public function todayReservations()
    {
        $reservations = $this->reservation->whereDate('res_date', Carbon::now())->get();
        $settings = $this->reservationControl->pluck('value', 'key');

        return view('backend.pages.reservations.today', compact('reservations', 'settings'));
    }

    // ...

    public function add($id)
    {
        $slots = [];
        $reservationSlots = null;
        $todayReservationSlots = null;
        $todayReservationResNum = null;
        $numberOfRes = null;

        $settings = $this->reservationControl->pluck('value', 'key');;

        $patient = $this->patient->findOrFail($id);

        $currentDate = Carbon::now('Egypt')->addHour()->format('Y-m-d');

        // if system use reservation numbers not slots
        if ($settings['reservation_slots'] == 0) {
            $todayReservationResNum = $this->reservation->where('res_date', $currentDate)->value('res_num');
            $numberOfRes = $this->numberOfReservations->where('reservation_date', $currentDate)->value('num_of_reservations');
            if ($numberOfRes === null) {
                return redirect()->route('backend.num_of_reservations.add');
            }
        }
        // if system use reservation slots not numbers
        if ($settings['reservation_slots'] == 1) {
            $todayReservationSlots = $this->reservation->where('res_date', $currentDate)->value('slot');
            $reservationSlots = $this->reservationSlots->where('date', $currentDate)->first();
            if ($reservationSlots === null) {
                return redirect()->route('backend.reservation_slots.add');
            }
            $slots = $this->getTimeSlot($reservationSlots->duration, $reservationSlots->start_time, $reservationSlots->end_time);
        }

        return view('backend.pages.reservations.add', compact('patient', 'reservation', 'numberOfRes', 'todayReservationSlots', 'todayReservationResNum', 'slots', 'settings'));
    }

    public function store(StoreReservationRequest $request)
    {
        try {
            $data = $request->validated();
            $data['month'] = substr($request->res_date, 5, 7 - 5);
            $this->reservation->create($data);

            return redirect()->route('backend.reservations.index')->with('success', 'Reservation added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function reservationStatus($id, $res_status)
    {
        $reservation = $this->reservation->findOrFail($id);
        $reservation->res_status = $res_status;
        $reservation->save();

        return redirect()->route('backend.reservations.index');
    }


    public function paymentStatus($id, $payment)
    {
        $reservation = $this->reservation->findOrFail($id);
        $reservation->payment = $payment;
        $reservation->save();

        return redirect()->route('backend.reservations.index');
    }

    public function show($id)
    {
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
        $settings = $this->reservationControl->pluck('value', 'key');

        $reservation = $this->reservation->findOrFail($id);

        // get res_num based on res_date
        $reservationResNum = $this->reservation->where('res_date', $reservation->res_date)->value('res_num');

        // number of reservation based on reservation_date
        $numberOfRes = $this->numberOfReservations->where('reservation_date', $reservation->res_date)->value('num_of_reservations');

        $reservationSlot = $this->reservation->where('res_date', $reservation->res_date)->value('slot');

        $reservationSlots = ReservationSlots::where('date', $reservation->res_date)->first();

        // dd($reservation,$reservationSlot ,$reservationSlots );
        $slots = $reservationSlots
        ? $this->getTimeSlot($reservationSlots->duration, $reservationSlots->start_time, $reservationSlots->end_time)
        : [];

        return view(
            'backend.pages.reservations.edit',
            compact(
                'reservation',
                'numberOfRes',
                'reservationResNum',
                'settings',
                'slots',
                'reservationSlot'
            )
        );
    }


}
