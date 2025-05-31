<?php

namespace App\Http\Controllers\Backend\Clinic\ReservationsControllers;

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
    GlassesDistance,
    MedicalAnalysis,
    ModuleServiceFee,
    OrganizationServiceFee,
    Prescription,
    Ray,
    ReservationServiceFee,
    ReservationSlots,
    Settings,
};
use App\Http\Controllers\Controller;
use App\Http\Traits\AuthorizeCheck;
use App\Http\Traits\TimeSlotsTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $this->authorizeCheck('view-reservations');

        $reservations = $this->reservation->with('patient:id,name')->get();
        $clinic_type = $this->settings->where('key', 'clinic_type')->value('value');

        return view(
            'backend.dashboards.clinic.pages.reservations.index',
            compact('reservations',  'clinic_type')
        );
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

            // ->addColumn('ray_action', function ($reservation) {
            //     $reservation_settings = $this->systemControl->pluck('value', 'key');

            //     // Check if reservation settings allow showing ray
            //     if (isset($reservation_settings['show_ray']) && $reservation_settings['show_ray'] == 1) {
            //         // Check if Ray exists for this reservation
            //         $rayExists = Ray::where('reservation_id', $reservation->id)->first();

            //         // Return the appropriate buttons based on Ray existence
            //         if ($rayExists) {
            //             return '<div class="res_control">
            //                         <a href="' . route('clinic.rays.add', $reservation->id) . '" class="btn btn-success btn-sm">
            //                             ' . trans('backend/reservations_trans.Add') . '
            //                         </a>
            //                         <a href="' . route('clinic.rays.show', $reservation->id) . '" class="btn btn-info btn-sm">
            //                             ' . trans('backend/reservations_trans.Show') . '
            //                         </a>
            //                     </div>';
            //         } else {
            //             return '<div class="res_control">
            //                         <a href="' . route('clinic.rays.add', $reservation->id) . '" class="btn btn-dark btn-sm">
            //                             ' . trans('backend/reservations_trans.Add') . '
            //                         </a>
            //                     </div>';
            //         }
            //     }

            //     return '';
            // })

            // ->addColumn('analysis_action', function ($reservation) {
            //     $reservation_settings = $this->systemControl->pluck('value', 'key');

            //     // Check if reservation settings allow showing ray
            //     if (isset($reservation_settings['show_analysis']) && $reservation_settings['show_analysis'] == 1) {
            //         // Check if Ray exists for this reservation
            //         $analysisExists = MedicalAnalysis::where('reservation_id', $reservation->id)->first();

            //         // Return the appropriate buttons based on Ray existence
            //         if ($analysisExists) {
            //             return '<div class="res_control">
            //                         <a href="' . route('clinic.analysis.add', $reservation->id) . '" class="btn btn-success btn-sm">
            //                             ' . trans('backend/reservations_trans.Add') . '
            //                         </a>
            //                         <a href="' . route('clinic.analysis.show', $reservation->id) . '" class="btn btn-info btn-sm">
            //                             ' . trans('backend/reservations_trans.Show') . '
            //                         </a>
            //                     </div>';
            //         } else {
            //             return '<div class="res_control">
            //                         <a href="' . route('clinic.analysis.add', $reservation->id) . '" class="btn btn-dark btn-sm">
            //                             ' . trans('backend/reservations_trans.Add') . '
            //                         </a>
            //                     </div>';
            //         }
            //     }

            //     // If show_ray is not set to 1, return an empty string or null
            //     return '';
            // })

            ->addColumn('chronic_disease_action', function ($reservation) {
                $reservation_settings = $this->systemControl->pluck('value', 'key');

                // Check if reservation settings allow showing ray
                if (isset($reservation_settings['show_chronic_diseases']) && $reservation_settings['show_chronic_diseases'] == 1) {
                    // Check if Ray exists for this reservation
                    $chronicDiseaseExists = ChronicDisease::where('reservation_id', $reservation->id)->first();

                    // Return the appropriate buttons based on Ray existence
                    if ($chronicDiseaseExists) {
                        return '<div class="res_control">
                                    <a href="' . route('clinic.chronic_diseases.add', $reservation->id) . '" class="btn btn-success btn-sm">
                                        ' . trans('backend/reservations_trans.Add') . '
                                    </a>
                                    <a href="' . route('clinic.reservations.editChronicDisease', $reservation->id) . '" class="btn btn-info btn-sm">
                                        ' . trans('backend/reservations_trans.Edit') . '
                                    </a>
                                    <a href="' . route('clinic.chronic_diseases.show', $reservation->id) . '" class="btn btn-info btn-sm">
                                        ' . trans('backend/reservations_trans.Show') . '
                                    </a>
                                </div>';
                    } else {
                        return '<div class="res_control">
                                    <a href="' . route('clinic.chronic_diseases.add', $reservation->id) . '" class="btn btn-dark btn-sm">
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
                if (isset($reservation_settings['show_prescription']) && $reservation_settings['show_prescription'] == 1) {
                    // Check if Ray exists for this reservation
                    $prescriptionExists = Prescription::where('reservation_id', $reservation->id)->first();
                    $drugs = Drug::where('reservation_id', $reservation->id)->get();

                    // Return the appropriate buttons based on Ray existence
                    if ($prescriptionExists || $drugs->isNotEmpty()) {
                        return '<div class="res_control">
                                    <a href="' . route('clinic.prescription.add', $reservation->id) . '" class="btn btn-success btn-sm">
                                        ' . trans('backend/reservations_trans.Add') . '
                                    </a>
                                    <a href="' . route('clinic.prescription.show', $reservation->id) . '" class="btn btn-info btn-sm">
                                        ' . trans('backend/reservations_trans.Show') . '
                                    </a>
                                    <a href="' . route('clinic.prescription.edit', $reservation->id) . '" class="btn btn-warning btn-sm">
                                        ' . trans('backend/reservations_trans.Edit') . '
                                    </a>
                                </div>';
                    } else {
                        return '<div class="res_control">
                                    <a href="' . route('clinic.prescription.add', $reservation->id) . '" class="btn btn-dark btn-sm">
                                        ' . trans('backend/reservations_trans.Add') . '
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
                                    <a href="' . route('clinic.glasses_distance.add', $reservation->id) . '" class="btn btn-success btn-sm">
                                        ' . trans('backend/reservations_trans.Add') . '
                                    </a>
                                    <a href="' . route('clinic.glasses_distance.edit', $reservation->id) . '" class="btn btn-warning btn-sm">
                                        ' . trans('backend/reservations_trans.Edit') . '
                                    </a>
                                </div>';
                    } else {
                        return '<div class="res_control">
                                    <a href="' . route('clinic.glasses_distance.add', $reservation->id) . '" class="btn btn-dark btn-sm">
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
                        '<a href="' . route("clinic.reservations_options.reservation_acceptance", [$reservation->id, "approved"]) . '" ' .
                        'class="btn btn-success btn-sm text-white">' .
                        '<i class="fa-solid fa-check"></i>' .
                        '</a>' .
                        '<a href="' . route('clinic.reservations_options.reservation_acceptance', [$reservation->id, 'not_approved']) . '" ' .
                        'class="btn btn-danger btn-sm text-white">' .
                        '<i class="fa-solid fa-xmark"></i>' .
                        '</a>' .
                        '</div>';
                }
            })

            ->addColumn('actions', function ($reservation) {
                // Define the actions HTML
                $actions = '<div class="res_control">
                                <a href="' . route('clinic.reservations.show', $reservation->id) . '" 
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="' . route('clinic.reservations.edit', $reservation->id) . '" 
                                    class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="' . route('clinic.reservations.destroy', $reservation->id) . '" 
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




    public function todayReservations()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $reservations = $this->reservation->whereDate('date', Carbon::now())->get();
        $reservation_settings = $this->systemControl->pluck('value', 'key');
        $clinic_type = $this->settings->where('key', 'clinic_type')->value('value');


        return view(
            'backend.dashboards.clinic.pages.reservations.today',
            compact('reservations', 'reservation_settings', 'currentDate', 'clinic_type')
        );
    }


    public function todayReservationReport()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $reservations = $this->reservation->where('date', $currentDate)->get();
        $costSum = $reservations->sum('cost');

        $data = [
            'reservations' => $reservations,
            'cost_sum' => $costSum,
        ];

        $pdf = PDF::loadView('backend.dashboards.clinic.pages.reservations.today_reservation_report', $data);
        return $pdf->stream('Report.pdf');
    }

    // ...

    public function add($id)
    {
        $this->authorizeCheck('add-reservation');

        $settings = $this->systemControl->pluck('value', 'key');

        $patient = $this->patient->findOrFail($id);

        $currentDate = Carbon::now('Egypt')->addHour()->format('Y-m-d');


        return view(
            'backend.dashboards.clinic.pages.reservations.add',
            compact(
                'patient',
                'settings'
            )
        );
    }

    public function store(StoreReservationRequest $request)
    {
        $this->authorizeCheck('add-reservation');

        try {
            // dd($request->all());
            $request->validated();
            $data = $request->all();
            $data['month'] = substr($request->date, 5, 7 - 5);
            $data['acceptance'] = 'approved';
            $data['clinic_id'] = Auth::user()->organization->id;


            $data['cost'] = $data['cost'] ?? 0;

            if ($request->has('service_fee')) {
                $data['cost'] += array_sum($request->service_fee); // Sum all service fees
            }

            $reservation = $this->reservation->create($data);

            // Store service fees
            if ($request->has('service_fee_id')) {
                foreach ($request->service_fee_id as $index => $serviceFeeId) {
                    $fee = $request->service_fee[$index] ?? 0; // Get corresponding fee
                    $notes = $request->service_fee_notes[$index] ?? null; // Get corresponding notes

                    ModuleServiceFee::create([
                        'module_id' => $reservation->id,
                        'module_type' => Reservation::class,
                        'service_fee_id' => $serviceFeeId,
                        'fee' => $fee,
                        'notes' => $notes
                    ]);
                }
            }


            return redirect()->route('clinic.reservations.index')->with('toast_success', 'Reservation added successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('toast_error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $this->authorizeCheck('view-reservations');

        // get reservation based on id
        $reservation = $this->reservation->findOrFail($id);
        // get all chronic_diseases of reservation
        $chronic_diseases = $this->chronic_disease->where('id', $id)->get();
        // get all drugs of reservation
        $drugs = $this->drug->where('id', $id)->get();
        // get all rays of reservation
        $rays = $this->ray->where('id', $id)->get();

        return view('backend.dashboards.clinic.pages.reservations.show', compact('reservation', 'chronic_diseases', 'drugs', 'rays'));
    }


    public function edit($id)
    {
        $this->authorizeCheck('edit-reservation');

        $settings = $this->systemControl->pluck('value', 'key');

        $reservation = $this->reservation->with('serviceFees')->findOrFail($id);

        // get reservation_number based on date
        $reservationResNum = $this->reservation->where('date', $reservation->date)->value('reservation_number');

        // number of reservation based on reservation_date
        $numberOfRes = $this->numberOfReservations->where('reservation_date', $reservation->date)->value('num_of_reservations');

        $reservationSlot = $this->reservation->where('date', $reservation->date)->value('slot');

        $reservationSlots = ReservationSlots::where('date', $reservation->date)->first();

        $slots = $reservationSlots
            ? $this->getTimeSlot($reservationSlots->duration, $reservationSlots->start_time, $reservationSlots->end_time)
            : [];

        if ($reservation->reservation_number) {
            $reservationType = 'reservation_number';
        }
        if ($reservation->slot) {
            $reservationType = 'slot';
        }
        return view(
            'backend.dashboards.clinic.pages.reservations.edit',
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
        $this->authorizeCheck('edit-reservation');

        try {
            $data = $request->validated();
            $reservation = $this->reservation->findOrFail($id);

            $data['cost'] = $data['cost'] ?? 0;
            if ($request->has('service_fee')) {
                $data['cost'] += array_sum($request->service_fee); // Sum all service fees
            }
            $reservation->fill($data);
            $reservation->save();

            $reservation->serviceFees()->sync($request->service_fee_id);


            return redirect()->route('clinic.reservations.index')->with('toast_success', 'Reservation updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('toast_error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $this->authorizeCheck('delete-reservation');
        $reservation = $this->reservation->findOrFail($id);
        $reservation->delete();

        return redirect()->route('clinic.reservations.index');
    }

    public function trash()
    {
        $this->authorizeCheck('delete-reservation');
        $reservations = $this->reservation->onlyTrashed()->get();

        return view('backend.dashboards.clinic.pages.reservations.trash', compact('reservations'));
    }

    public function trashData()
    {

        $query = $this->reservation->onlyTrashed()->with('patient:id,name');


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
                $buttons = '';

                if ($reservation->status == 'waiting') {
                    $status = '<span class="badge badge-rounded badge-dark text-white p-2 ">' .
                        trans('backend/reservations_trans.Waiting') .
                        '</span>';
                } elseif ($reservation->status == 'entered') {
                    $status = '<span class="badge badge-rounded badge-dark p-2 ">' .
                        trans('backend/reservations_trans.Entered') .
                        '</span>';
                } elseif ($reservation->status == 'finished') {
                    $status = '<span class="badge badge-rounded badge-dark p-2 ">' .
                        trans('backend/reservations_trans.Finished') .
                        '</span>';
                } elseif ($reservation->status == 'cancelled') {
                    $status = '<span class="badge badge-rounded badge-dark p-2 ">' .
                        trans('backend/reservations_trans.Cancelled') .
                        '</span>';
                }

                // Buttons for status change
                $buttons = '<div class="res_control">' .
                    '<a href="' . route('clinic.reservations_options.reservation_status', [$reservation->id, 'waiting']) . '" class="btn btn-warning btn-sm text-white">' .
                    trans('backend/reservations_trans.Waiting') .
                    '</a>' .
                    '<a href="' . route('clinic.reservations_options.reservation_status', [$reservation->id, 'entered']) . '" class="btn btn-success btn-sm">' .
                    trans('backend/reservations_trans.Entered') .
                    '</a>' .
                    '<a href="' . route('clinic.reservations_options.reservation_status', [$reservation->id, 'finished']) . '" class="btn btn-info btn-sm">' .
                    trans('backend/reservations_trans.Finished') .
                    '</a>' .
                    '<a href="' . route('clinic.reservations_options.reservation_status', [$reservation->id, 'cancelled']) . '" class="btn btn-danger btn-sm">' .
                    trans('backend/reservations_trans.Cancelled') .
                    '</a>' .
                    '</div>';

                return $status . $buttons;
            })
            ->addColumn('ray_action', function ($reservation) {
                $reservation_settings = $this->systemControl->pluck('value', 'key');

                // Check if reservation settings allow showing ray
                if (isset($reservation_settings['show_ray']) && $reservation_settings['show_ray'] == 1) {
                    // Check if Ray exists for this reservation
                    $rayExists = Ray::where('id', $reservation->id)->first();

                    // Return the appropriate buttons based on Ray existence
                    if ($rayExists) {
                        return '<div class="res_control">
                                    <a href="' . route('clinic.rays.add', $reservation->id) . '" class="btn btn-success btn-sm">
                                        ' . trans('backend/reservations_trans.Add') . '
                                    </a>
                                    <a href="' . route('clinic.rays.show', $reservation->id) . '" class="btn btn-info btn-sm">
                                        ' . trans('backend/reservations_trans.Show') . '
                                    </a>
                                </div>';
                    } else {
                        return '<div class="res_control">
                                    <a href="' . route('clinic.rays.add', $reservation->id) . '" class="btn btn-dark btn-sm">
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
                $restoreForm = '<form action="' . route('clinic.reservations.restore', $reservation->id) . '" method="post" style="display:inline">
                                    ' . csrf_field() . '
                                    ' . method_field('put') . '
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i> إعادة
                                    </button>
                                </form>';

                // Generate force delete action form
                $forceDeleteForm = '<form action="' . route('clinic.reservations.forceDelete', $reservation->id) . '" method="post" style="display:inline">
                                        ' . csrf_field() . '
                                        ' . method_field('delete') . '
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> حذف نهائى
                                        </button>
                                    </form>';

                // Combine both actions into one string
                return $restoreForm . $forceDeleteForm;
            })
            ->rawColumns(['payment', 'status', 'acceptance', 'actions'])
            ->make(true);
    }

    public function restore($id)
    {
        $this->authorizeCheck('restore-reservation');
        $reservation = $this->reservation->onlyTrashed()->findOrFail($id);
        $reservation->restore();

        return redirect()->route('clinic.reservations.index');
    }

    public function forceDelete($id)
    {
        $this->authorizeCheck('force-delete-reservation');
        $reservation = $this->reservation->onlyTrashed()->findOrFail($id);
        $reservation->forceDelete();

        return redirect()->route('clinic.reservations.index');
    }



    public function getResNumberOrSlotAdd(Request $request)
    {


        $date =  $request->date;

        // if system use reservation numbers not slots
        $reservation_reservation_number = Reservation::where('date', $date)
            ->where('clinic_id', Auth::user()->organization->id)
            ->pluck('reservation_number')->map(function ($item) {
                return intval($item);
            })->toArray();
        $number_of_res = NumberOfReservations::where('reservation_date', $date)
            ->where('clinic_id', Auth::user()->organization->id)
            ->value('num_of_reservations');

        // if system use reservation slots not numbers
        $reservation_slots = Reservation::where('date', $date)
            ->where('clinic_id', Auth::user()->organization->id)
            ->where('slot', '<>', 'null')->pluck('slot')->toArray();
        $number_of_slot = ReservationSlots::where('date', $date)
            ->where('clinic_id', Auth::user()->organization->id)
            ->first();
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

    public function getResNumberOrSlotEdit(Request $request)
    {

        $date =  $request->date;
        $res_id = $request->res_id;

        $reservation = Reservation::findOrFail($res_id);

        // if system use reservation numbers not slots
        $reservation_reservation_number = Reservation::where('date', $date)
            ->where('clinic_id', Auth::user()->organization->id)
            ->pluck('reservation_number')->map(function ($item) {
                return intval($item);
            })->toArray();
        $number_of_res = NumberOfReservations::where('reservation_date', $date)
            ->where('clinic_id', Auth::user()->organization->id)
            ->value('num_of_reservations');


        // if system use reservation slots not numbers
        $reservation_slots = Reservation::where('date', $date)
            ->where('slot', '<>', 'null')->pluck('slot')->toArray();
        $number_of_slot = ReservationSlots::where('date', $date)
            ->where('clinic_id', Auth::user()->organization->id)
            ->first();
        $slots = $number_of_slot ? $this->getTimeSlot($number_of_slot->duration, $number_of_slot->start_time, $number_of_slot->end_time) : [];


        // Create an associative array or Laravel collection with the values
        $data = [
            'reservation' => $reservation,
            'reservationsCount' => $number_of_res,
            'todayReservationResNum' => $reservation_reservation_number,
            'slots' => $slots,
            'number_of_slot' => $number_of_slot,
            'today_reservation_slots' =>  $reservation_slots
        ];

        return response()->json($data);
    }

    public function editChronicDisease($id)
    {
        $this->authorizeCheck('edit-chronic-disease');

        $reservation = $this->reservation->findOrFail($id);
        $chronic_diseases = ChronicDisease::where('reservation_id', $id)->get();

        return view(
            'backend.dashboards.clinic.pages.reservations.editChronicDisease',
            compact('chronic_diseases', 'reservation')
        );
    }
    public function updateChronicDisease(Request $request, $reservation_id)
    {
        try {

            $validated = $request->validate([
                'name.*' => 'nullable|string',
                'measure.*' => 'nullable|string',
                'date.*' => 'nullable|date',
                'notes.*' => 'nullable|string',
                'id.*' => 'nullable|integer|exists:chronic_diseases,id',
            ]);


            // Update or create chronic diseases
            foreach ($request->name as $index => $name) {
                $data = [
                    'patient_id' => $request->patient_id,
                    'reservation_id' => $request->reservation_id,
                    'name' => $name,
                    'measure' => $request->measure[$index] ?? null,
                    'date' => $request->date[$index] ?? null,
                    'notes' => $request->notes[$index] ?? null,
                    'clinic_id' => Auth::user()->organization->id,
                ];

                $id = $request->id[$index] ?? null;

                if ($id) {
                    ChronicDisease::where('id', $id)->update($data);
                } else {
                    ChronicDisease::create($data);
                }
            }

            return redirect()->back()->with('toast_success', __('backend/messages.updated_successfully'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('toast_error', __('backend/messages.something_went_wrong'));
        }
    }
}
