<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Requests\Backend\{
    StoreReservationRequest,
    UpdateReservationRequest,
};
use App\Models\{
    ChronicDisease,
    NumberOfReservations,
    SystemControl,
    Reservation,
    Patient,
    Drug,
    MedicalAnalysis,
    Prescription,
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
use Yajra\DataTables\Facades\DataTables;

class ReservationController extends Controller
{
    use TimeSlotsTrait, AuthorizeCheck;

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


    public function index()
    {
        $this->authorizeCheck('عرض الكشوفات');

        $reservations = $this->reservation->with('patient:patient_id,name')->get();
        $reservation_settings = $this->systemControl->pluck('value', 'key');
        $clinic_type = $this->settings->where('key', 'clinic_type')->value('value');

        return view(
            'backend.dashboards.user.pages.reservations.index',
            compact('reservations', 'reservation_settings', 'clinic_type')
        );
    }


    public function data(Request $request)
    {
        $query = $this->reservation->with('patient:patient_id,name');

        if ($request->has('date')) {
            $query->whereDate('res_date', $request->input('date'));
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('patient_name', function ($reservation) {
                return $reservation->patient->name;
            })
            ->addColumn('res_type', function ($reservation) {
                switch ($reservation->res_type) {
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
            ->addColumn('res_status', function ($reservation) {
                $status = '';
                $buttons = '';

                if ($reservation->res_status == 'waiting') {
                    $status = '<span class="badge badge-rounded badge-dark text-white p-2 ">' .
                        trans('backend/reservations_trans.Waiting') .
                        '</span>';
                } elseif ($reservation->res_status == 'entered') {
                    $status = '<span class="badge badge-rounded badge-dark p-2 ">' .
                        trans('backend/reservations_trans.Entered') .
                        '</span>';
                } elseif ($reservation->res_status == 'finished') {
                    $status = '<span class="badge badge-rounded badge-dark p-2 ">' .
                        trans('backend/reservations_trans.Finished') .
                        '</span>';
                } elseif ($reservation->res_status == 'cancelled') {
                    $status = '<span class="badge badge-rounded badge-dark p-2 ">' .
                        trans('backend/reservations_trans.Cancelled') .
                        '</span>';
                }

                // Buttons for status change
                $buttons = '<div class="res_control">' .
                    '<a href="' . route('backend.reservations_options.reservation_status', [$reservation->reservation_id, 'waiting']) . '" class="btn btn-warning btn-sm text-white">' .
                    trans('backend/reservations_trans.Waiting') .
                    '</a>' .
                    '<a href="' . route('backend.reservations_options.reservation_status', [$reservation->reservation_id, 'entered']) . '" class="btn btn-success btn-sm">' .
                    trans('backend/reservations_trans.Entered') .
                    '</a>' .
                    '<a href="' . route('backend.reservations_options.reservation_status', [$reservation->reservation_id, 'finished']) . '" class="btn btn-info btn-sm">' .
                    trans('backend/reservations_trans.Finished') .
                    '</a>' .
                    '<a href="' . route('backend.reservations_options.reservation_status', [$reservation->reservation_id, 'cancelled']) . '" class="btn btn-danger btn-sm">' .
                    trans('backend/reservations_trans.Cancelled') .
                    '</a>' .
                    '</div>';

                return $status . $buttons;
            })
            ->addColumn('ray_action', function ($reservation) {
                $reservation_settings = $this->systemControl->pluck('value', 'key');

                // Check if reservation settings allow showing ray
                if ($reservation_settings['show_ray'] == 1) {
                    // Check if Ray exists for this reservation
                    $rayExists = Ray::where('reservation_id', $reservation->reservation_id)->first();

                    // Return the appropriate buttons based on Ray existence
                    if ($rayExists) {
                        return '<div class="res_control">
                                    <a href="' . route('backend.rays.add', $reservation->reservation_id) . '" class="btn btn-success btn-sm">
                                        ' . trans('backend/reservations_trans.Add') . '
                                    </a>
                                    <a href="' . route('backend.rays.show', $reservation->reservation_id) . '" class="btn btn-info btn-sm">
                                        ' . trans('backend/reservations_trans.Show') . '
                                    </a>
                                </div>';
                    } else {
                        return '<div class="res_control">
                                    <a href="' . route('backend.rays.add', $reservation->reservation_id) . '" class="btn btn-dark btn-sm">
                                        ' . trans('backend/reservations_trans.Add') . '
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
                if ($reservation_settings['show_analysis'] == 1) {
                    // Check if Ray exists for this reservation
                    $analysisExists = MedicalAnalysis::where('reservation_id', $reservation->reservation_id)->first();

                    // Return the appropriate buttons based on Ray existence
                    if ($analysisExists) {
                        return '<div class="res_control">
                                    <a href="' . route('backend.analysis.add', $reservation->reservation_id) . '" class="btn btn-success btn-sm">
                                        ' . trans('backend/reservations_trans.Add') . '
                                    </a>
                                    <a href="' . route('backend.analysis.show', $reservation->reservation_id) . '" class="btn btn-info btn-sm">
                                        ' . trans('backend/reservations_trans.Show') . '
                                    </a>
                                </div>';
                    } else {
                        return '<div class="res_control">
                                    <a href="' . route('backend.analysis.add', $reservation->reservation_id) . '" class="btn btn-dark btn-sm">
                                        ' . trans('backend/reservations_trans.Add') . '
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
                if ($reservation_settings['show_chronic_diseases'] == 1) {
                    // Check if Ray exists for this reservation
                    $chronicDiseaseExists = ChronicDisease::where('reservation_id', $reservation->reservation_id)->first();

                    // Return the appropriate buttons based on Ray existence
                    if ($chronicDiseaseExists) {
                        return '<div class="res_control">
                                    <a href="' . route('backend.chronic_diseases.add', $reservation->reservation_id) . '" class="btn btn-success btn-sm">
                                        ' . trans('backend/reservations_trans.Add') . '
                                    </a>
                                    <a href="' . route('backend.chronic_diseases.show', $reservation->reservation_id) . '" class="btn btn-info btn-sm">
                                        ' . trans('backend/reservations_trans.Show') . '
                                    </a>
                                </div>';
                    } else {
                        return '<div class="res_control">
                                    <a href="' . route('backend.chronic_diseases.add', $reservation->reservation_id) . '" class="btn btn-dark btn-sm">
                                        ' . trans('backend/reservations_trans.Add') . '
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
                if ($reservation_settings['show_prescription'] == 1) {
                    // Check if Ray exists for this reservation
                    $prescriptionExists = Prescription::where('reservation_id', $reservation->reservation_id)->first();

                    // Return the appropriate buttons based on Ray existence
                    if ($prescriptionExists) {
                        return '<div class="res_control">
                                    <a href="' . route('backend.prescription.add', $reservation->reservation_id) . '" class="btn btn-success btn-sm">
                                        ' . trans('backend/reservations_trans.Add') . '
                                    </a>
                                    <a href="' . route('backend.prescription.show', $reservation->reservation_id) . '" class="btn btn-info btn-sm">
                                        ' . trans('backend/reservations_trans.Show') . '
                                    </a>
                                    <a href="' . route('backend.prescription.edit', $reservation->reservation_id) . '" class="btn btn-warning btn-sm">
                                        ' . trans('backend/reservations_trans.Edit') . '
                                    </a>
                                </div>';
                    } else {
                        return '<div class="res_control">
                                    <a href="' . route('backend.prescription.add', $reservation->reservation_id) . '" class="btn btn-dark btn-sm">
                                        ' . trans('backend/reservations_trans.Add') . '
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
                        '</span>' .
                        '<div class="res_control">' .
                        '<a href="' . route("backend.reservations_options.reservation_acceptance", [$reservation->reservation_id, "approved"]) . '" ' .
                        'class="btn btn-success btn-sm text-white">' .
                        '<i class="fa-solid fa-check"></i>' .
                        '</a>' .
                        '<a href="' . route('backend.reservations_options.reservation_acceptance', [$reservation->reservation_id, 'not_approved']) . '" ' .
                        'class="btn btn-danger btn-sm text-white">' .
                        '<i class="fa-solid fa-xmark"></i>' .
                        '</a>' .
                        '</div>';
                }
            })

            ->addColumn('actions', function ($reservation) {
                // Define the actions HTML
                $actions = '<div class="res_control">
                                <a href="' . route('backend.reservations.show', $reservation->reservation_id) . '" 
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="' . route('backend.reservations.edit', $reservation->reservation_id) . '" 
                                    class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="' . route('backend.reservations.destroy', $reservation->reservation_id) . '" 
                                    method="POST" style="display:inline">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>';

                return $actions;
            })
            ->rawColumns(['payment', 'res_status', 'acceptance', 'actions', 'ray_action', 'analysis_action', 'chronic_disease_action', 'prescription_action'])
            ->make(true);
    }




    public function todayReservations()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $reservations = $this->reservation->whereDate('res_date', Carbon::now())->get();
        $reservation_settings = $this->systemControl->pluck('value', 'key');
        $clinic_type = $this->settings->where('key', 'clinic_type')->value('value');


        return view(
            'backend.dashboards.user.pages.reservations.today',
            compact('reservations', 'reservation_settings', 'currentDate', 'clinic_type')
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

        $pdf = PDF::loadView('backend.dashboards.user.pages.reservations.today_reservation_report', $data);
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
            'backend.dashboards.user.pages.reservations.add',
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
        $drugs = $this->drug->where('reservation_id', $id)->get();
        // get all rays of reservation
        $rays = $this->ray->where('reservation_id', $id)->get();

        return view('backend.dashboards.user.pages.reservations.show', compact('reservation', 'chronic_diseases', 'drugs', 'rays'));
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

        if ($reservation->res_num) {
            $reservationType = 'reservation_number';
        }
        if ($reservation->slot) {
            $reservationType = 'slot';
        }
        return view(
            'backend.dashboards.user.pages.reservations.edit',
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

        return view('backend.dashboards.user.pages.reservations.trash', compact('reservations'));
    }

    public function trashData(){

        $query = $this->reservation->onlyTrashed()->with('patient:patient_id,name');


        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('patient_name', function ($reservation) {
                return $reservation->patient->name;
            })
            ->addColumn('res_type', function ($reservation) {
                switch ($reservation->res_type) {
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
            ->addColumn('res_status', function ($reservation) {
                $status = '';
                $buttons = '';

                if ($reservation->res_status == 'waiting') {
                    $status = '<span class="badge badge-rounded badge-dark text-white p-2 ">' .
                        trans('backend/reservations_trans.Waiting') .
                        '</span>';
                } elseif ($reservation->res_status == 'entered') {
                    $status = '<span class="badge badge-rounded badge-dark p-2 ">' .
                        trans('backend/reservations_trans.Entered') .
                        '</span>';
                } elseif ($reservation->res_status == 'finished') {
                    $status = '<span class="badge badge-rounded badge-dark p-2 ">' .
                        trans('backend/reservations_trans.Finished') .
                        '</span>';
                } elseif ($reservation->res_status == 'cancelled') {
                    $status = '<span class="badge badge-rounded badge-dark p-2 ">' .
                        trans('backend/reservations_trans.Cancelled') .
                        '</span>';
                }

                // Buttons for status change
                $buttons = '<div class="res_control">' .
                    '<a href="' . route('backend.reservations_options.reservation_status', [$reservation->reservation_id, 'waiting']) . '" class="btn btn-warning btn-sm text-white">' .
                    trans('backend/reservations_trans.Waiting') .
                    '</a>' .
                    '<a href="' . route('backend.reservations_options.reservation_status', [$reservation->reservation_id, 'entered']) . '" class="btn btn-success btn-sm">' .
                    trans('backend/reservations_trans.Entered') .
                    '</a>' .
                    '<a href="' . route('backend.reservations_options.reservation_status', [$reservation->reservation_id, 'finished']) . '" class="btn btn-info btn-sm">' .
                    trans('backend/reservations_trans.Finished') .
                    '</a>' .
                    '<a href="' . route('backend.reservations_options.reservation_status', [$reservation->reservation_id, 'cancelled']) . '" class="btn btn-danger btn-sm">' .
                    trans('backend/reservations_trans.Cancelled') .
                    '</a>' .
                    '</div>';

                return $status . $buttons;
            })
            ->addColumn('ray_action', function ($reservation) {
                $reservation_settings = $this->systemControl->pluck('value', 'key');

                // Check if reservation settings allow showing ray
                if ($reservation_settings['show_ray'] == 1) {
                    // Check if Ray exists for this reservation
                    $rayExists = Ray::where('reservation_id', $reservation->reservation_id)->first();

                    // Return the appropriate buttons based on Ray existence
                    if ($rayExists) {
                        return '<div class="res_control">
                                    <a href="' . route('backend.rays.add', $reservation->reservation_id) . '" class="btn btn-success btn-sm">
                                        ' . trans('backend/reservations_trans.Add') . '
                                    </a>
                                    <a href="' . route('backend.rays.show', $reservation->reservation_id) . '" class="btn btn-info btn-sm">
                                        ' . trans('backend/reservations_trans.Show') . '
                                    </a>
                                </div>';
                    } else {
                        return '<div class="res_control">
                                    <a href="' . route('backend.rays.add', $reservation->reservation_id) . '" class="btn btn-dark btn-sm">
                                        ' . trans('backend/reservations_trans.Add') . '
                                    </a>
                                </div>';
                    }
                }

                // If show_ray is not set to 1, return an empty string or null
                return '';
            })

            ->addColumn('actions', function ($reservation) {
                // Generate restore action form
                $restoreForm = '<form action="' . route('backend.reservations.restore', $reservation->reservation_id) . '" method="post" style="display:inline">
                                    ' . csrf_field() . '
                                    ' . method_field('put') . '
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i> إعادة
                                    </button>
                                </form>';
            
                // Generate force delete action form
                $forceDeleteForm = '<form action="' . route('backend.reservations.forceDelete', $reservation->reservation_id) . '" method="post" style="display:inline">
                                        ' . csrf_field() . '
                                        ' . method_field('delete') . '
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> حذف نهائى
                                        </button>
                                    </form>';
            
                // Combine both actions into one string
                return $restoreForm . $forceDeleteForm;
            })
            ->rawColumns(['payment', 'res_status', 'acceptance', 'actions'])
            ->make(true);



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
            'reservation' => $reservation,
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
