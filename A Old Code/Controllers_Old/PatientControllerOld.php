<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePatientRequest;
use App\Http\Requests\Api\UpdatePatientRequest;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\Settings;
use PDF;
use App\Http\Traits\AuthorizeCheck;

class PatientController extends Controller
{
    use AuthorizeCheck;

    // function to show all  patients 
    public function index()
    {
        $this->authorizeCheck('عرض المرضى');

        $patients = Patient::with('reservations')->get();

        return view('backend.pages.patients.index', compact('patients'));
    }


    // show user data based on patient_id
    public function show($id)
    {

        $this->authorizeCheck('عرض مريض');

        // get patient based on patient_id
        $patient = Patient::find($id);

        $reservations_count = Reservation::where('patient_id', $id)->count();

        return view('backend.pages.patients.show', compact('patient', 'reservations_count'));
    }

    public function patient_pdf($id)
    {


        $patient = Patient::find($id);

        // get settings of the app from settings table
        $collection = Settings::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });

        $data = [];
        $data['patient'] = $patient;
        $data['settings'] = $setting['setting'];
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
            Patient::create($data);
            return redirect()->route('backend.patients.index')->with('success', 'Patient added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function edit($id)
    {
        $this->authorizeCheck('تعديل مريض');

        $patient = Patient::findOrFail($id);

        return view('backend.pages.patients.edit', compact('patient'));
    }


    public function update(UpdatePatientRequest $request, $id)
    {


        try {
            $request->validated();

            $data = $request->all();

            // get patient based on patient_id
            $patient = Patient::findOrFail($id);

            $patient->update($data);

            return redirect()->route('backend.patients.index')->with('success', 'Patient added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function destroy($id)
    {

        // get patient based on patient_id
        $patient = Patient::findOrFail($id);

        // delete selected patient
        $patient->delete();

        return redirect()->route('backend.patients.index');
    }



    public function trash()
    {
        // get all deleted patients 
        $patients = Patient::onlyTrashed()->get();
        return view('backend.pages.patients.trash', compact('patients'));
    }



    public function restore($id)
    {
        // get deleted patient based on patient_id 
        $patients = Patient::onlyTrashed()->findOrFail($id);

        // restore deleted patient
        $patients->restore();

        return redirect()->route('backend.patients.index');
    }


    public function forceDelete($id)
    {
        // get deleted patient based on patient_id 
        $patients = Patient::onlyTrashed()->findOrFail($id);

        // delete deleted patient forever
        $patients->forceDelete();

        return redirect()->route('backend.patients.index');
    }
}
