<?php

namespace App\Http\Controllers\Backend\Patient;

use App\Events\PatientMakeAppointment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreReservationRequest;
use App\Http\Traits\TimeSlotsTrait;

use App\Models\{
    ChronicDisease,
    Drug,
    GlassesDistance,
    MedicalAnalysis,
    NumberOfReservations,
    Patient,
    Prescription,
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
use Yajra\DataTables\Facades\DataTables;

class ReservationController extends Controller
{
    use TimeSlotsTrait;
    //
    protected $reservation;
    protected $systemControl;
    protected $settings;

    public function __construct(
        Reservation $reservation,
        SystemControl $systemControl,
        Settings $settings

    ) {
        $this->reservation = $reservation;
        $this->systemControl = $systemControl;
        $this->settings = $settings;
    }


    public function index()
    {


        // // get all reservations
        // $reservations = Reservation::where('patient_id', '=', Auth::user()->id)
        //     ->where('acceptance', '=', 'approved')->get();


        // // get reservation controls
        // $reservation_controls = SystemControl::all();

        // $setting = $reservation_controls->flatMap(function ($collection) {
        //     return [$collection->key => $collection->value];
        // });

        $reservations = $this->reservation->with('patient:id,name')->get();
        // $reservation_settings = $this->systemControl->pluck('value', 'key');
        $clinic_type = $this->settings->where('key', 'clinic_type')->value('value');

        // return view(
        //     'backend.dashboards.clinic.pages.reservations.index',
        //     compact('reservations',  'clinic_type')
        // );


        return view('backend.dashboards.patient.pages.appointment.index', compact('reservations', 'clinic_type'));
    }

    public function data(Request $request)
    {
        $query = $this->reservation->with('patient:id,name');

        if ($request->has('date')) {
            $query->whereDate('date', $request->input('date'));
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('patient_name', function ($reservation) {
                return $reservation->patient->name;
            })
            ->addColumn('type', function ($reservation) {
                switch ($reservation->type) {
                    case 'check':
                        return trans('backend/reservations_trans.Check');
                    case 'recheck':
                        return trans('backend/reservations_trans.Recheck');
                    case 'consultation':
                        return trans('backend/reservations_trans.Consultation');
                    default:
                        return '-';
                }
            })
            ->addColumn('payment', function ($reservation) {
                if ($reservation->payment == 'paid') {
                    return '<span class="badge badge-rounded badge-success p-2 m-2">' .
                        trans('backend/reservations_trans.Paid')
                        . '</span>';
                } elseif ($reservation->payment == 'not paid') {
                    return '<span class="badge badge-rounded badge-danger p-2 m-2">' .
                        trans('backend/reservations_trans.Not_Paid')
                        . '</span>';
                }
            })
            ->addColumn('status', function ($reservation) {
                $status = '';

                // Determine the current status badge
                if ($reservation->status == 'waiting') {
                    $status = '<span class="badge badge-rounded badge-warning text-white p-2">' .
                        trans('backend/reservations_trans.Waiting') .
                        '</span>';
                } elseif ($reservation->status == 'entered') {
                    $status = '<span class="badge badge-rounded badge-success p-2">' .
                        trans('backend/reservations_trans.Entered') .
                        '</span>';
                } elseif ($reservation->status == 'finished') {
                    $status = '<span class="badge badge-rounded badge-info p-2">' .
                        trans('backend/reservations_trans.Finished') .
                        '</span>';
                } elseif ($reservation->status == 'cancelled') {
                    $status = '<span class="badge badge-rounded badge-danger p-2">' .
                        trans('backend/reservations_trans.Cancelled') .
                        '</span>';
                }

                // Create a <select> dropdown for changing status
                $dropdown = '<select class="form-control p-0 res-status-select" data-reservation-id="' . $reservation->id . '">
                                <option value="waiting" ' . ($reservation->status == 'waiting' ? 'selected' : '') . '>' . trans('backend/reservations_trans.Waiting') . '</option>
                                <option value="entered" ' . ($reservation->status == 'entered' ? 'selected' : '') . '>' . trans('backend/reservations_trans.Entered') . '</option>
                                <option value="finished" ' . ($reservation->status == 'finished' ? 'selected' : '') . '>' . trans('backend/reservations_trans.Finished') . '</option>
                                <option value="cancelled" ' . ($reservation->status == 'cancelled' ? 'selected' : '') . '>' . trans('backend/reservations_trans.Cancelled') . '</option>
                            </select>';

                return $status . $dropdown;
            })

            ->addColumn('ray_action', function ($reservation) {
                $reservation_settings = $this->systemControl->pluck('value', 'key');

                // Check if reservation settings allow showing ray
                if (isset($reservation_settings['show_ray']) && $reservation_settings['show_ray'] == 1) {
                    // Check if Ray exists for this reservation
                    $rayExists = Ray::where('reservation_id', $reservation->id)->first();

                    // Return the appropriate buttons based on Ray existence
                    if ($rayExists) {
                        return '<div class="res_control">
                                   
                                    <a href="' . route('clinic.rays.show', $reservation->id) . '" class="btn btn-info btn-sm">
                                        ' . trans('backend/reservations_trans.Show') . '
                                    </a>
                                </div>';
                    }
                }

                // If show_ray is not set to 1, return an empty string or null
                return '';
            })

            ->addColumn('analysis_action', function ($reservation) {
                $reservation_settings = $this->systemControl->pluck('value', 'key');

                // Check if reservation settings allow showing ray
                if (isset($reservation_settings['show_analysis']) && $reservation_settings['show_analysis'] == 1) {
                    // Check if Ray exists for this reservation
                    $analysisExists = MedicalAnalysis::where('reservation_id', $reservation->id)->first();

                    // Return the appropriate buttons based on Ray existence
                    if ($analysisExists) {
                        return '<div class="res_control">
                                   
                                    <a href="' . route('clinic.analysis.show', $reservation->id) . '" class="btn btn-info btn-sm">
                                        ' . trans('backend/reservations_trans.Show') . '
                                    </a>
                                </div>';
                    }
                }

                // If show_ray is not set to 1, return an empty string or null
                return '';
            })

            ->addColumn('chronic_disease_action', function ($reservation) {
                $reservation_settings = $this->systemControl->pluck('value', 'key');

                // Check if reservation settings allow showing ray
                if (isset($reservation_settings['show_chronic_diseases']) && $reservation_settings['show_chronic_diseases'] == 1) {
                    // Check if Ray exists for this reservation
                    $chronicDiseaseExists = ChronicDisease::where('reservation_id', $reservation->id)->first();

                    // Return the appropriate buttons based on Ray existence
                    if ($chronicDiseaseExists) {
                        return '<div class="res_control">
                                    
                                    <a href="' . route('clinic.chronic_diseases.show', $reservation->id) . '" class="btn btn-info btn-sm">
                                        ' . trans('backend/reservations_trans.Show') . '
                                    </a>
                                </div>';
                    }
                }

                // If show_ray is not set to 1, return an empty string or null
                return '';
            })
            ->addColumn('prescription_action', function ($reservation) {
                $reservation_settings = $this->systemControl->pluck('value', 'key');

                // Check if reservation settings allow showing ray
                if (isset($reservation_settings['show_prescription']) && $reservation_settings['show_prescription'] == 1) {
                    // Check if Ray exists for this reservation
                    $prescriptionExists = Prescription::where('id', $reservation->id)->first();

                    // Return the appropriate buttons based on Ray existence
                    if ($prescriptionExists) {
                        return '<div class="res_control">
                                   
                                    <a href="' . route('clinic.prescription.show', $reservation->id) . '" class="btn btn-info btn-sm">
                                        ' . trans('backend/reservations_trans.Show') . '
                                    </a>
                                   
                                </div>';
                    }
                }

                // If show_ray is not set to 1, return an empty string or null
                return '';
            })
            ->addColumn('glasses_distance_action', function ($reservation) {
                $reservation_settings = $this->systemControl->pluck('value', 'key');

                // Check if reservation settings allow showing ray
                if (isset($reservation_settings['show_glasses_distance']) && $reservation_settings['show_glasses_distance'] == 1) {
                    // Check if Ray exists for this reservation
                    $glassesDistanceExists = GlassesDistance::where('id', $reservation->id)->first();

                    // Return the appropriate buttons based on Ray existence
                    if ($glassesDistanceExists) {
                        return '<div class="res_control">
                                   
                                    <a href="' . route('clinic.glasses_distance.show', $reservation->id) . '" class="btn btn-info btn-sm">
                                        ' . trans('backend/reservations_trans.Show') . '
                                    </a>
                                    
                                </div>';
                    }
                }

                // If show_ray is not set to 1, return an empty string or null
                return '';
            })
            ->addColumn('acceptance', function ($reservation) {
                if ($reservation->acceptance == 'approved') {
                    return '<span class="badge badge-rounded badge-success text-white p-2 m-2">' .
                        trans('backend/reservations_trans.Approved') .
                        '</span>';
                } elseif ($reservation->acceptance == 'not_approved') {
                    return '<span class="badge badge-rounded badge-danger text-white p-2 m-2">' .
                        trans('backend/reservations_trans.Not_Approved') .
                        '</span>';
                }
            })

            ->addColumn('actions', function ($reservation) {
                // Define the actions HTML
                $actions = '<div class="res_control">
                                <a href="' . route('clinic.reservations.show', $reservation->id) . '" 
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </div>';

                return $actions;
            })
            ->rawColumns([
                'payment',
                'status',
                'acceptance',
                'actions',
                'ray_action',
                'analysis_action',
                'chronic_disease_action',
                'prescription_action',
                'glasses_distance_action'
            ])
            ->make(true);
    }

    public function add()
    {

        $slots = [];
        $reservation_slots = null;
        $today_reservation_reservation_number = null;
        $number_of_res = null;

        // get reservation settings
        $settings = SystemControl::pluck('value', 'key');

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
