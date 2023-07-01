<?php

namespace App\Http\Controllers\Frontend;

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
    ReservationControl,
    ReservationSlots,
    Settings
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
        $patient_id = Auth::user('patient')->patient_id;


        // get all reservations
        $reservations = Reservation::where('patient_id', '=', $patient_id)
        ->where('acceptance', '=', 'approved')->get();


        // get reservation controls
        $reservation_controls = ReservationControl::all();

        $setting = $reservation_controls->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });


        return view('frontend.Patient_Dashboard.appointment.index', compact('reservations', 'setting'));
    }

    public function add()
    {

        $slots = [];
        $reservation_slots = null;
        $today_reservation_res_num = null;
        $number_of_res = null;

        // get reservation settings
        $settings = ReservationControl::pluck('value','key');

        $user_id = Auth::user('patient')->patient_id;

        // get patient based on patient_id
        $patient = Patient::where('patient_id', '=', $user_id)->first();

        $current_date = Carbon::now('Egypt')->format('Y-m-d');

        

        /// get today reservations get there numbers from Reservation table
        $today_reservation_res_num = Reservation::where('res_date', $current_date)->value('res_num');
        
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
            'frontend.Patient_Dashboard.appointment.add',
            compact('patient',  'number_of_res', 'today_reservation_res_num', 'slots', 'settings')
        );
    }


    public function store(StoreReservationRequest $request)
    {

        $data = $request->all();
        $data["cost"] = 100;
        $data["payment"] = 'not paid';
        $data["acceptance"] = 'not_approved';
        $data["res_status"] = 'waiting';
        $data['month'] = substr($request->res_date, 5, 7 - 5);
        Reservation::create($data);

        return redirect()->route('frontend.appointment.index')->with('success', 'Reservation added successfully');
    }


    public function show_ray($reservation_id)
    {
        // get reservation based on reservation_id
        $rays = Ray::where('reservation_id', $reservation_id)->get();

        return view('frontend.Patient_Dashboard.appointment.show_ray', compact('rays'));
    }


    public function show_chronic_disease($reservation_id)
    {

        // get drugs based on reservation_id
        $chronic_diseases = ChronicDisease::where('reservation_id', $reservation_id)->get();

        return view('frontend.Patient_Dashboard.appointment.show_chronic_disease', compact('chronic_diseases'));
    }

    public function show_glasses_distance($reservation_id)
    {
        $glasses_distances = GlassesDistance::where('reservation_id', $reservation_id)->first();

        $reservation = Reservation::findOrFail($reservation_id);

        $collection = Settings::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });

        $data = [];
        $data['settings'] = $setting['setting'];
        $data['glasses_distance'] = $glasses_distances;
        $data['reservation'] = $reservation;


        $pdf = PDF::loadView('frontend.Patient_Dashboard.appointment.show_glasses_distance', $data);

        return $pdf->stream('Glasses' . '.pdf');
    }

    // public function get_res_slot_number(Request $request)
    // {
    //     $res_date =  $request->res_date;

    //     $today_reservation_res_num = null;
    //     $today_reservation_slots = null;
    //     $number_of_res = null;
    //     $slots = [];
    //     $number_of_slot = null;
    //     $collection = ReservationControl::all();
    //     $settings = $collection->flatMap(function ($collection) {
    //         return [$collection->key => $collection->value];
    //     });

    //     // check if request reservation date has number of reservations or not

    //     if ($settings['reservation_slots'] == 0) {
    //         $today_reservation_res_num = Reservation::where('res_date', $res_date)->value('res_num');
    //         $number_of_res = NumberOfReservations::where('reservation_date', $res_date)->value('num_of_reservations');
    //     }



    //     if ($settings['reservation_slots'] == 1) {
    //         $today_reservation_slots = Reservation::where('res_date', $res_date)->value('slot');

    //         // dd( $today_reservation_slots);
    //         // check if request reservation date has number of reservations or not
    //         $number_of_slot = ReservationSlots::where('date', $res_date)->first();

    //         if ($number_of_slot) {
    //             $slots = $this->getTimeSlot($number_of_slot->duration, $number_of_slot->start_time, $number_of_slot->end_time);
    //         }
    //     }

    //     // Create an associative array or Laravel collection with the values
    //     $data = [
    //         'reservationsCount' => $number_of_res,
    //         'todayReservationResNum' => $today_reservation_res_num,
    //         'slots' => $slots,
    //         'number_of_slot' => $number_of_slot,
    //         'today_reservation_slots' =>  $today_reservation_slots
    //     ];

    //     // Return the data as JSON response
    //     return response()->json($data);

    //     // return $number_of_res;
    // }

    public function getResNumberOrSlot(Request $request)
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



    public function arabic_prescription_pdf($reservation_id)
    {


        $current_time = Carbon::now('Egypt')->addHour()->format('g:i A');
        // get reservation based on reservation_id
        $reservation = Reservation::findOrFail($reservation_id);

        // get drugs based on reservation_id
        $drugs = Drug::where('reservation_id', $reservation_id)->get();

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

        $pdf = PDF::loadView('frontend.Patient_Dashboard.appointment.show_prescription_arabic', $data);
        return $pdf->stream($reservation->patient->name . '.pdf');


        // return view('backend.pages.drugs.drug_pdf',compact('drugs','reservation'));

    }

    public function english_prescription_pdf($reservation_id)
    {



        // get reservation based on reservation_id
        $reservation = Reservation::findOrFail($reservation_id);

        // get drugs based on reservation_id
        $drugs = Drug::where('reservation_id', $reservation_id)->get();

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
            'frontend.Patient_Dashboard.appointment.show_prescription_english',
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

        $reservations_ids = Reservation::where('patient_id', Auth::user('patient')->patient_id)->pluck('reservation_id');
        // dd($reservations_ids);

        // get reservation based on reservation_id
        $rays = Ray::whereIn('reservation_id', $reservations_ids)->get();

        return view(
            'frontend.Patient_Dashboard.rays.show',
            compact('rays')
        );
    }

    public function patient_chronic_disease()
    {

        // get reservation based on reservation_id
        $reservations_ids = Reservation::where('patient_id', Auth::user('patient')->patient_id)->pluck('reservation_id');

        // get drugs based on reservation_id
        $chronic_diseases = ChronicDisease::whereIn('reservation_id', $reservations_ids)->get();

        return view('frontend.Patient_Dashboard.chronic_diseases.show', compact('chronic_diseases'));

    }
}
