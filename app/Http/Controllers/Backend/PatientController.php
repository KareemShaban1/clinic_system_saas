<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StorePatientRequest;
use App\Http\Requests\Backend\UpdatePatientRequest;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\Settings;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
use App\Http\Traits\AuthorizeCheck;
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
        $this->authorizeCheck('عرض المرضى');

        $patients = $this->patient->with('reservations')->get();

        return view('backend.dashboards.user.pages.patients.index', compact('patients'));
    }

    public function data()
    {
        $patients = Patient::with('reservations')->get();

        return DataTables::of($patients)
            ->addColumn('number_of_reservations', function ($patient) {
                return $patient->reservations->count();
            })
            ->addColumn('add_reservation', function ($patient) {
                return '<a href="' . route('backend.reservations.add', $patient->patient_id) . '" 
                            class="btn btn-info btn-sm">
                            ' . trans('backend/patients_trans.Add_Reservation') . '
                        </a>';
            })
            ->addColumn('add_online_reservation', function ($patient) {
                return '<a href="' . route('backend.online_reservations.add', $patient->patient_id) . '" 
                            class="btn btn-info btn-sm">
                            ' . trans('backend/patients_trans.Add_Online_Reservation') . '
                        </a>';
            })
            ->addColumn('patient_card', function ($patient) {
                return '<a href="' . route('backend.patients.patient_pdf', $patient->patient_id) . '" 
                            class="btn btn-primary btn-sm">
                            ' . trans('backend/patients_trans.Show_Patient_Card') . '
                        </a>';
            })
            ->addColumn('action', function ($patient) {
                $editUrl = route('backend.patients.edit', $patient->patient_id);
                $deleteUrl = route('backend.patients.destroy', $patient->patient_id);
                $viewUrl = route('backend.patients.show', $patient->patient_id);

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


    // show user data based on patient_id
    public function show($id)
    {
        $this->authorizeCheck('عرض مريض');

        // get patient with his reservations based on patient_id
        $patient = $this->patient->withCount('reservations')->findOrFail($id);


        return view('backend.dashboards.user.pages.patients.show', compact('patient'));
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
            'backend.dashboards.user.pages.patients.patient_card',
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
        $this->authorizeCheck('أضافة مريض');

        return view('backend.dashboards.user.pages.patients.add');
    }


    public function store(StorePatientRequest $request)
    {

        try {
            $request->validated();

            $data = $request->all();

            $data['password'] = Hash::make($request->password);

            $this->patient->create($data);

            return redirect()->route('backend.patients.index')->with('success', 'Patient added successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function edit($id)
    {
        $this->authorizeCheck('تعديل مريض');

        $patient = $this->patient->findOrFail($id);

        return view('backend.dashboards.user.pages.patients.edit', compact('patient'));
    }


    public function update(UpdatePatientRequest $request, $id)
    {


        try {
            $request->validated();

            $data = $request->all();

            $patient = $this->patient->findOrFail($id);

            $patient->update($data);

            return redirect()->route('backend.patients.index')->with('success', 'Patient added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function destroy($id)
    {
        $this->authorizeCheck('حذف مريض');

        $patient = $this->patient->findOrFail($id);

        $patient->delete();

        return redirect()->route('backend.patients.index');
    }



    public function trash()
    {
        $patients = $this->patient->onlyTrashed()->get();
        return view('backend.dashboards.user.pages.patients.trash', compact('patients'));
    }

    public function trashData()
    {
        $patients = $this->patient->onlyTrashed()->get();
        return DataTables::of($patients)
        ->addColumn('action', function ($patient) {
            $restoreUrl = route('backend.patients.restore', $patient->patient_id);
            $forceDeleteUrl = route('backend.patients.forceDelete', $patient->patient_id);

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
        $patients = $this->patient->onlyTrashed()->findOrFail($id);

        $patients->restore();

        return redirect()->route('backend.patients.index');
    }


    public function forceDelete($id)
    {
        $patients = $this->patient->onlyTrashed()->findOrFail($id);

        $patients->forceDelete();

        return redirect()->route('backend.patients.index');
    }
}
