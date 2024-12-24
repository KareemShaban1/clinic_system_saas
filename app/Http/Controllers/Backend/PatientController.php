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
            'patient'=>  $patient,
            'settings'=> $settings
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

        $patient =$this->patient->findOrFail($id);

        $patient->delete();

        return redirect()->route('backend.patients.index');
    }



    public function trash()
    {
        $patients = $this->patient->onlyTrashed()->get();
        return view('backend.dashboards.user.pages.patients.trash', compact('patients'));
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
