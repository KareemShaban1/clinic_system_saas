<?php

namespace App\Http\Controllers\Frontend;

use App\Events\PatientMakeAppointment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreReservationRequest;
use App\Http\Traits\TimeSlotsTrait;

use App\Models\{
    ChronicDisease,
    Drug,
    GlassesDistance,
    NumberOfReservations,
    Patient,
    Ray,
    Reservation,
    ReservationSlots,
    Settings,
    SystemControl
};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;

class AppointmentsController extends Controller
{
    use TimeSlotsTrait;
    //


    public function index()
    {
        $id = Auth::user('patient')->id;


        // get all reservations
        $reservations = Reservation::where('patient_id', '=', $id)
        ->where('acceptance', '=', 'approved')->get();


        // get reservation controls
        $reservation_controls = SystemControl::all();

        $setting = $reservation_controls->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });


        return view('backend.dashboards.patient.pages.appointment.index', compact('reservations', 'setting'));
    }

    public function add()
    {

        $slots = [];
        $reservation_slots = null;
        $today_reservation_reservation_number = null;
        $number_of_res = null;

        // get reservation settings
        $settings = SystemControl::pluck('value','key');

        $user_id = Auth::user('patient')->id;

        // get patient based on id
        $patient = Patient::where('id', '=', $user_id)->first();

        $current_date = Carbon::now('Egypt')->format('Y-m-d');



        /// get today reservations get there numbers from Reservation table
        $today_reservation_reservation_number = Reservation::where('date', $current_date)->value('reservation_number');

        /// get today reservations get there numbers from NumberOfReservations table
        $number_of_res = NumberOfReservations::where('reservation_date', $current_date)->value('num_of_reservations');

        $today_reservation_slots = Reservation::where('slot', $current_date)->value('slot');

        $reservation_slots = ReservationSlots::where('date', $current_date)->first();

        if ($reservation_slots) {
            $slots = $reservation_slots ?
            $this->getTimeSlot($reservation_slots->duration, $reservation_slots->start_time, $reservation_slots->end_time)
            : [];
        }


        return view(
            'backend.dashboards.patient.pages.appointment.add',
            compact('patient',  'number_of_res', 'today_reservation_reservation_number', 'slots', 'settings')
        );
    }


    public function store(StoreReservationRequest $request)
    {

        $data = $request->all();
        $data["cost"] = 100;
        $data["payment"] = 'not paid';
        $data["acceptance"] = 'not_approved';
        $data["res_status"] = 'waiting';
        $data['month'] = substr($request->date, 5, 7 - 5);
        $data['patient_id'] = Auth::user()->id;
        $data['clinic_id'] = Auth::user()->clinic_id;
        // dd($data);
        $reservation = Reservation::create($data);

        // event(new PatientMakeAppointment($reservation));

        return redirect()->route('frontend.appointment.index')->with('success', 'Reservation added successfully');
    }


    public function show_ray($id)
    {
        // get reservation based on id
        $rays = Ray::where('patient_id', $id)->get();

        return view('backend.dashboards.patient.pages.appointment.show_ray', compact('rays'));
    }


    public function show_chronic_disease($id)
    {

        // get drugs based on id
        $chronic_diseases = ChronicDisease::where('patient_id', $id)->get();

        return view('backend.dashboards.patient.pages.appointment.show_chronic_disease', compact('chronic_diseases'));
    }

    public function show_glasses_distance($id)
    {
        $glasses_distances = GlassesDistance::where('patient_id', $id)->first();

        $reservation = Reservation::findOrFail($id);

        $collection = Settings::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });

        $data = [];
        $data['settings'] = $setting['setting'];
        $data['glasses_distance'] = $glasses_distances;
        $data['reservation'] = $reservation;


        $pdf = PDF::loadView('backend.dashboards.patient.pages.appointment.show_glasses_distance', $data);

        return $pdf->stream('Glasses' . '.pdf');
    }



    public function getResNumberOrSlot(Request $request)
    {

        $date =  $request->date;

        // if system use reservation numbers not slots
        $reservation_reservation_number = Reservation::where('date', $date)->pluck('reservation_number')->map(function ($item) {
            return intval($item);
        })->toArray();
        $number_of_res = NumberOfReservations::where('reservation_date', $date)->value('num_of_reservations');


        // if system use reservation slots not numbers
        $reservation_slots = Reservation::where('date', $date)
        ->where('slot', '<>', 'null')->pluck('slot')->toArray();
        $number_of_slot = ReservationSlots::where('date', $date)->first();
        $slots = $number_of_slot ? $this->getTimeSlot($number_of_slot->duration, $number_of_slot->start_time, $number_of_slot->end_time) : [];


        // Create an associative array or Laravel collection with the values
        $data = [
            'reservationsCount' => $number_of_res,
            'todayReservationResNum' => $reservation_reservation_number,
            'slots' => $slots,
            'number_of_slot' => $number_of_slot,
            'today_reservation_slots' =>  $reservation_slots
        ];

        // Return the data as JSON response
        return response()->json($data);

    }



    public function arabic_prescription_pdf($id)
    {


        $current_time = Carbon::now('Egypt')->addHour()->format('g:i A');
        // get reservation based on id
        $reservation = Reservation::findOrFail($id);

        // get drugs based on id
        $drugs = Drug::where('patient_id', $id)->get();

        $doctor_name = Settings::where('key', 'doctor_name')->value('value');
        // dd($doctor_name);

        $collection = Settings::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });

        $data = [];
        $data['reservation'] = $reservation;
        $data['drugs'] = $drugs;
        $data['settings'] = $setting['setting'];
        $data['doctor_name'] = $doctor_name;
        $data['current_time'] = $current_time;

        $pdf = PDF::loadView('backend.dashboards.patient.pages.appointment.show_prescription_arabic', $data);
        return $pdf->stream($reservation->patient->name . '.pdf');


        // return view('backend.pages.drugs.drug_pdf',compact('drugs','reservation'));

    }

    public function english_prescription_pdf($id)
    {



        // get reservation based on id
        $reservation = Reservation::findOrFail($id);

        // get drugs based on id
        $drugs = Drug::where('patient_id', $id)->get();

        $doctor_name = Settings::where('key', 'doctor_name')->value('value');

        $collection = Settings::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });

        $data = [];
        $data['reservation'] = $reservation;
        $data['drugs'] = $drugs;
        $data['settings'] = $setting['setting'];
        $data['doctor_name'] = $doctor_name;

        $pdf = PDF::loadView(
            'backend.dashboards.patient.pages.appointment.show_prescription_english',
            $data,
            [],
            [
                'format' => 'A4',
            ]
        );

        return $pdf->stream($reservation->patient->name . '.pdf');
    }

    public function rays_index()
    {

        $reservations_ids = Reservation::where('patient_id', Auth::user('patient')->id)->pluck('id');
        // dd($reservations_ids);

        // get reservation based on id
        $rays = Ray::whereIn('reservation_id', $reservations_ids)->get();

        return view(
            'backend.dashboards.patient.pages.rays.show',
            compact('rays')
        );
    }

    public function patient_chronic_disease()
    {

        // get reservation based on id
        $reservations_ids = Reservation::where('patient_id', Auth::user('patient')->id)->pluck('id');

        // get drugs based on id
        $chronic_diseases = ChronicDisease::whereIn('reservation_id', $reservations_ids)->get();

        return view('backend.dashboards.patient.pages.chronic_diseases.show', compact('chronic_diseases'));

    }
}
