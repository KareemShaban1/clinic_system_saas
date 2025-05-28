<?php

namespace App\Http\Controllers\Backend\MedicalLaboratory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StorePatientRequest;
use App\Http\Requests\Backend\UpdatePatientRequest;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\Settings;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
use App\Http\Traits\AuthorizeCheck;
use App\Models\MedicalLaboratory;
use App\Models\Scopes\ClinicScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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


        $patients = Patient::with('reservations')->medicalLaboratory()->get();

        return view('backend.dashboards.medicalLaboratory.pages.patients.index', compact('patients'));
    }

    public function data()
    {
        $patients = Patient::with('medicalAnalysis')->medicalLaboratory()->get();

        return DataTables::of($patients)
            ->addColumn('number_of_analysis', function ($patient) {
                return $patient->medicalAnalysis()->count();
            })
            ->addColumn('add_analysis', function ($patient) {
                return '<a href="' . route('medicalLaboratory.analysis.add', $patient->id) . '" 
                            class="btn btn-info btn-sm">
                            ' . trans('backend/patients_trans.Add_Analysis') . '
                        </a>';
            })
           
            ->addColumn('patient_card', function ($patient) {
                return '<a href="' . route('medicalLaboratory.patients.patient_pdf', $patient->id) . '" 
                            class="btn btn-primary btn-sm">
                            ' . trans('backend/patients_trans.Show_Patient_Card') . '
                        </a>';
            })
            ->addColumn('action', function ($patient) {
                $editUrl = route('medicalLaboratory.patients.edit', $patient->id);
                $deleteUrl = route('medicalLaboratory.patients.destroy', $patient->id);
                $viewUrl = route('medicalLaboratory.patients.show', $patient->id);

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
            ->rawColumns(['add_analysis', 'patient_card', 'action'])
            ->make(true);
    }


    // show user data based on id
    public function show($id)
    {
        $this->authorizeCheck('view-patients');

        $patient = $this->patient->withCount('medicalAnalysis')->findOrFail($id);

        $patient->load('medicalAnalysis');

        return view('backend.dashboards.medicalLaboratory.pages.patients.show', compact('patient'));
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
            'backend.dashboards.medicalLaboratory.pages.patients.patient_card',
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


        return view('backend.dashboards.medicalLaboratory.pages.patients.add');
    }


    public function store(StorePatientRequest $request)
    {

        $this->authorizeCheck('add-patient');

        try {


            $data = $request->validated();

            $data['password'] = Hash::make($request->password);

            $patient = $this->patient->create($data);

            DB::table('patient_organization')->insert([
                [
                    'patient_id' => $patient->id,
                    'organization_id' => auth()->user()->organization_id,
                    'organization_type' => MedicalLaboratory::class,
                ]
            ]);

            return redirect()->route('medicalLaboratory.patients.index')->with('toast_success', 'Patient added toast_successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function edit($id)
    {
        $this->authorizeCheck('edit-patient');

        $patient = $this->patient->findOrFail($id);

        return view('backend.dashboards.medicalLaboratory.pages.patients.edit', compact('patient'));
    }


    public function update(UpdatePatientRequest $request, $id)
    {

        $this->authorizeCheck('edit-patient');

        try {
            $request->validated();

            $data = $request->all();

            $patient = $this->patient->findOrFail($id);

            $patient->update($data);

            return redirect()->route('medicalLaboratory.patients.index')->with('toast_success', 'Patient added toast_successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function destroy($id)
    {
        $this->authorizeCheck('delete-patient');

        $patient = $this->patient->findOrFail($id);

        $patient->delete();

        return redirect()->route('medicalLaboratory.patients.index');
    }



    public function trash()
    {
        $this->authorizeCheck('delete-patient');

        $patients = $this->patient->onlyTrashed()->get();
        return view('backend.dashboards.medicalLaboratory.pages.patients.trash', compact('patients'));
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

        return redirect()->route('medicalLaboratory.patients.index');
    }


    public function forceDelete($id)
    {

        $this->authorizeCheck('force-delete-patient');

        $patients = $this->patient->onlyTrashed()->findOrFail($id);

        $patients->forceDelete();

        return redirect()->route('medicalLaboratory.patients.index');
    }

    public function add_patient_code()
    {
        return view('backend.dashboards.medicalLaboratory.pages.patients.add_patient_code');
    }


    public function search(Request $request)
    {
        $patient = Patient::where('patient_code', $request->code)->first();

        if (!$patient) {
            return response()->json([
                'success' => false,
                'message' => 'Patient not found.'
            ]);
        }

        // Load only assigned medical laboratories
        $assignedLabs = $patient->medicalLaboratories()
            ->wherePivot('assigned', 1)
            ->get();

        foreach ($assignedLabs as $medicalLab) {
            if ($medicalLab->id == auth()->user()->organization->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Patient already assigned to your medical laboratory.'
                ]);
            }
        }

        // Patient found and not assigned to this lab
        return response()->json([
            'success' => true,
            'patient' => $patient
        ]);
    }



    public function assignPatient(Request $request)
    {
        $organizationId = auth()->user()->organization->id;

        // Check if a record already exists
        $patientAssignment = DB::table('patient_organization')
            ->where('patient_id', $request->patient_id)
            ->where('organization_id', $organizationId)
            ->where('organization_type', MedicalLaboratory::class)
            ->first();

        if ($patientAssignment) {
            // If already assigned, return error
            if ($patientAssignment->assigned == 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Patient already assigned to your medical laboratory.'
                ]);
            }

            // If exists but not assigned, update it
            DB::table('patient_organization')
                ->where('patient_id', $request->patient_id)
                ->where('organization_id', $organizationId)
                ->where('organization_type', MedicalLaboratory::class)
                ->update(['assigned' => 1]);
        } else {
            // Create new assignment
            DB::table('patient_organization')->insert([
                'patient_id' => $request->patient_id,
                'organization_id' => $organizationId,
                'organization_type' => MedicalLaboratory::class,
                'assigned' => 1,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Patient assigned successfully.'
        ]);
    }


    public function unassignPatient($patient_id)
    {
        DB::table('patient_organization')
            ->where('patient_id', $patient_id)
            ->update([
                'assigned' => 0,
            ]);


        return redirect()->back()->with('toast_success', 'Patient unassigned successfully');
    }
}
