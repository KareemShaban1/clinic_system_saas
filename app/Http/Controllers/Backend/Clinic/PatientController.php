<?php

namespace App\Http\Controllers\Backend\Clinic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StorePatientRequest;
use App\Http\Requests\Backend\UpdatePatientRequest;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\Settings;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
use App\Http\Traits\AuthorizeCheck;
use App\Models\Scopes\ClinicScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class PatientController extends Controller
{
    use AuthorizeCheck;

    protected $patient;
    protected $reservation;
    protected $settings;

    public function __construct(Patient $patient, Reservation $reservation, Settings $settings)
    {
        $this->patient = $patient;
        $this->reservation = $reservation;
        $this->settings = $settings;
    }

    // function to show all patients
    public function index()
    {
        $this->authorizeCheck('view-patients');


        $patients = Patient::with('reservations')->get();

        return view('backend.dashboards.clinic.pages.patients.index', compact('patients'));
    }

    public function data()
    {
        $patients = Patient::with('reservations')->get();

        return DataTables::of($patients)
            ->addColumn('number_of_reservations', function ($patient) {
                return $patient->reservations->count();
            })
            ->addColumn('add_reservation', function ($patient) {
                return '<a href="' . route('clinic.reservations.add', $patient->id) . '" 
                            class="btn btn-info btn-sm">
                            ' . trans('backend/patients_trans.Add_Reservation') . '
                        </a>';
            })
            ->addColumn('add_online_reservation', function ($patient) {
                return '<a href="' . route('clinic.online_reservations.add', $patient->id) . '" 
                            class="btn btn-info btn-sm">
                            ' . trans('backend/patients_trans.Add_Online_Reservation') . '
                        </a>';
            })
            ->addColumn('patient_card', function ($patient) {
                return '<a href="' . route('clinic.patients.patient_pdf', $patient->id) . '" 
                            class="btn btn-primary btn-sm">
                            ' . trans('backend/patients_trans.Show_Patient_Card') . '
                        </a>';
            })
            ->addColumn('action', function ($patient) {
                $editUrl = route('clinic.patients.edit', $patient->id);
                $deleteUrl = route('clinic.patients.destroy', $patient->id);
                $viewUrl = route('clinic.patients.show', $patient->id);

                $actions = '
                    <a href="' . $viewUrl . '" class="btn btn-primary btn-sm">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="' . $editUrl . '" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>';

                if ($patient->reservations->count() == 0) {
                    $actions .= '
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm(\'Are you sure you want to delete this item?\')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>';
                }

                return $actions;
            })
            ->rawColumns(['add_reservation', 'add_online_reservation', 'patient_card', 'action'])
            ->make(true);
    }


    // show user data based on id
    public function show($id)
    {
        $this->authorizeCheck('view-patients');

        // get patient with his reservations based on id
        $patient = $this->patient->withCount('reservations')->findOrFail($id);


        return view('backend.dashboards.clinic.pages.patients.show', compact('patient'));
    }

    public function patientPdf($id)
    {
        $patient = $this->patient->find($id);

        // get settings of the app from settings table
        $collection = $this->settings->select('key', 'value')->get();
        $settings = $collection->pluck('value', 'key');

        $data = [
            'patient' =>  $patient,
            'settings' => $settings
        ];

        $pdf = PDF::loadView(
            'backend.dashboards.clinic.pages.patients.patient_card',
            $data,
            [],
            [
                // 'format' => 'A5-L',
                'format' => [190, 100] // W - H
            ]
        );
        return $pdf->stream($patient->name . '.pdf');
    }

    public function add()
    {
        $this->authorizeCheck('add-patient');

        return view('backend.dashboards.clinic.pages.patients.add');
    }


    public function store(StorePatientRequest $request)
    {

        $this->authorizeCheck('add-patient');

        try {


            $data = $request->validated();

            $data['password'] = Hash::make($request->password);
            $data['clinic_id'] = Auth::user()->clinic_id;

            $this->patient->create($data);

            return redirect()->route('clinic.patients.index')->with('toast_success', 'Patient added toast_successfully');
        } catch (\Exception $e) {

            // dd($e);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function edit($id)
    {
        $this->authorizeCheck('edit-patient');

        $patient = $this->patient->findOrFail($id);

        return view('backend.dashboards.clinic.pages.patients.edit', compact('patient'));
    }


    public function update(UpdatePatientRequest $request, $id)
    {

        $this->authorizeCheck('edit-patient');

        try {
            $request->validated();

            $data = $request->all();

            $patient = $this->patient->findOrFail($id);

            $patient->update($data);

            return redirect()->route('clinic.patients.index')->with('toast_success', 'Patient added toast_successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function destroy($id)
    {
        $this->authorizeCheck('delete-patient');

        $patient = $this->patient->findOrFail($id);

        $patient->delete();

        return redirect()->route('clinic.patients.index');
    }



    public function trash()
    {
        $this->authorizeCheck('delete-patient');

        $patients = $this->patient->onlyTrashed()->get();
        return view('backend.dashboards.clinic.pages.patients.trash', compact('patients'));
    }

    public function trashData()
    {
        $patients = $this->patient->onlyTrashed()->get();
        return DataTables::of($patients)
            ->addColumn('action', function ($patient) {
                $restoreUrl = route('backend.patients.restore', $patient->id);
                $forceDeleteUrl = route('backend.patients.forceDelete', $patient->id);

                $actions = '
                <a href="' . $restoreUrl . '" class="btn btn-info btn-sm">
                    <i class="fa fa-edit"></i>
                </a>
                <form action="' . $forceDeleteUrl . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger btn-sm" 
                            onclick="return confirm(\'Are you sure you want to delete this item?\')">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>';
                return $actions;
            })

            ->rawColumns(['restore', 'force_delete'])
            ->make(true);
    }



    public function restore($id)
    {
        $this->authorizeCheck('restore-patient');

        $patients = $this->patient->onlyTrashed()->findOrFail($id);

        $patients->restore();

        return redirect()->route('clinic.patients.index');
    }


    public function forceDelete($id)
    {

        $this->authorizeCheck('force-delete-patient');

        $patients = $this->patient->onlyTrashed()->findOrFail($id);

        $patients->forceDelete();

        return redirect()->route('clinic.patients.index');
    }

    public function add_patient_code()
    {
        return view('backend.dashboards.clinic.pages.patients.add_patient_code');
    }


    public function search(Request $request)
    {
        // Get the patient without the ClinicScope
        $patient = Patient::withoutGlobalScope(ClinicScope::class)
            // ->with('clinic')
            ->where('patient_code', $request->code)
            ->first();

        if (!$patient) {
            return response()->json([
                'success' => false,
                'message' => 'Patient not found.'
            ]);
        }

        foreach ($patient->clinic as $clinic) {

            // Check if the patient is already assigned to this clinic
            if ($clinic->id == auth()->user()->clinic->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Patient already assigned to your clinic.'
                ]);
            }
        }


        // Patient found and not assigned to this clinic
        return response()->json([
            'success' => true,
            'patient' => $patient
        ]);
    }


    public function assign(Request $request)
    {
        // Example: attach patient to authenticated clinic
        $clinic = auth()->user()->clinic;
        $clinic->patients()->attach($request->patient_id);

        return response()->json(['message' => 'Patient assigned successfully']);
    }
}
