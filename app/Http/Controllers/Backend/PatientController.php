<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePatientRequest;
use App\Http\Requests\Api\UpdatePatientRequest;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\Settings;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
use App\Http\Traits\AuthorizeCheck;

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

        return view('backend.pages.patients.index', compact('patients'));
    }

    // show user data based on patient_id
    public function show($id)
    {
        $this->authorizeCheck('عرض مريض');

        // get patient with his reservations based on patient_id
        $patient = $this->patient->withCount('reservations')->findOrFail($id);


        return view('backend.pages.patients.show', compact('patient'));
    }

    public function patient_pdf($id)
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
            'backend.pages.patients.patient_card',
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

        // return pateint add view
        return view('backend.pages.patients.add');
    }


    public function store(StorePatientRequest $request)
    {

        try {
            $request->validated();
            $data = $request->all();
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

        return view('backend.pages.patients.edit', compact('patient'));
    }


    public function update(UpdatePatientRequest $request, $id)
    {


        try {
            $request->validated();

            $data = $request->all();

            // get patient based on patient_id
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
        // get patient based on patient_id
        $patient =$this->patient->findOrFail($id);

        // delete selected patient
        $patient->delete();

        return redirect()->route('backend.patients.index');
    }



    public function trash()
    {
        // get all deleted patients
        $patients = $this->patient->onlyTrashed()->get();
        return view('backend.pages.patients.trash', compact('patients'));
    }



    public function restore($id)
    {
        // get deleted patient based on patient_id
        $patients = $this->patient->onlyTrashed()->findOrFail($id);

        // restore deleted patient
        $patients->restore();

        return redirect()->route('backend.patients.index');
    }


    public function forceDelete($id)
    {
        // get deleted patient based on patient_id
        $patients = $this->patient->onlyTrashed()->findOrFail($id);

        // delete deleted patient forever
        $patients->forceDelete();

        return redirect()->route('backend.patients.index');
    }
}
