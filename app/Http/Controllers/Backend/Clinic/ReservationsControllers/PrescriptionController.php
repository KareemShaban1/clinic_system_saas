<?php

namespace App\Http\Controllers\Backend\Clinic\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreDrugRequest;
use App\Models\{
    Drug,
    Prescription,
    Reservation,
    Settings
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;

class PrescriptionController extends Controller
{
    // prescription controller

    public function index() {}

    // add drugs to prescription
    public function add(Request $request, $id)
    {

        // get reservation based on id
        $reservation = Reservation::findOrFail($id);

        $prescriptions = Prescription::where('id', $reservation->id)->get();

        return view('backend.dashboards.clinic.pages.prescription.add', compact('reservation', 'prescriptions'));
    }



    public function storePrescription(Request $request)
    {
        $prescription = new Prescription();
        $data = $request->except('images');
        $prescription->create($data);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $prescription->addMedia($image)->toMediaCollection('prescription_images');
            }
        }
        return redirect()->route('clinic.reservations.index')->with('toast_success', 'Prescription Added Successfully');
    }

    public function updatePrescription(Request $request, $id)
    {
        $prescription = Prescription::findOrFail($id);
        $data = $request->except('images');
        
        $prescription->update($data);

        if ($request->hasFile('images')) {
            $prescription->clearMediaCollection('prescription_images');
            foreach ($request->images as $image) {
                $prescription->addMedia($image)->toMediaCollection('prescription_images');
            }
        }
        return redirect()->back()->with('toast_success', 'Prescription Updated Successfully');
    }



    // store drugs for prescription
    public function store(StoreDrugRequest $request)
    {
        $request->validated();
        try {
            for ($i = 0; $i < count($request->name); $i++) {
                $data = [
                    'name' => $request->name[$i],
                    'dose' => $request->dose[$i],
                    'type' => $request->type[$i],
                    'frequency' => $request->frequency[$i],
                    'period' => $request->period[$i],
                    'notes' => $request->notes[$i],
                    'reservation_id' => $request->reservation_id,
                    'patient_id' => $request->patient_id,
                    'clinic_id' => auth()->user()->organization_id,
                ];
                DB::table('drugs')->insert($data);
            }
            return redirect()->back()->with('toast_success', 'Drugs Added Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function show(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $drugs = Drug::where('id', $id)->get();
        return view('backend.dashboards.clinic.pages.prescription.show', compact('drugs', 'reservation'));
    }


    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $drugs = Drug::where('reservation_id', $id)->get();
        $prescription = Prescription::where('reservation_id', $id)->first();
        return view('backend.dashboards.clinic.pages.prescription.edit', 
        compact('drugs', 'reservation', 'prescription'));
    }

    public function update(StoreDrugRequest $request, $reservationId)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            for ($i = 0; $i < count($request->name); $i++) {
                $row = [
                    'name'          => $request->name[$i],
                    'dose'          => $request->dose[$i],
                    'type'          => $request->type[$i],
                    'frequency'     => $request->frequency[$i],
                    'period'        => $request->period[$i],
                    'notes'         => $request->notes[$i],
                    'reservation_id' => $request->reservation_id,
                    'patient_id'    => $request->patient_id,
                    'clinic_id'     => auth()->user()->organization_id,
                ];

                // update records exists
                if (!empty($request->drug_id[$i])) {
                    DB::table('drugs')
                        ->where('id', $request->drug_id[$i])
                        ->update($row);
                } 
                // add new records
                else {
                    DB::table('drugs')->insert($row);
                }
            }

            DB::commit();

            return redirect()
                ->back()
                ->with('toast_success', 'Drugs updated successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong');
        }
    }



    // arabic prescription print
    public function arabic_prescription_pdf($id)
    {

        // get reservation based on id
        $reservation = Reservation::findOrFail($id);

        // get drugs based on id
        $drugs = Drug::where('id', $id)->get();



        $collection = Settings::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });

        $data = [];
        $data['reservation'] = $reservation;
        $data['drugs'] = $drugs;
        $data['settings'] = $setting['setting'];

        $pdf = PDF::loadView('backend.dashboards.clinic.pages.prescription.arabic_prescription_pdf', $data);
        return $pdf->stream($reservation->patient->name . '.pdf');
    }

    public function english_prescription_pdf($id)
    {



        // get reservation based on id
        $reservation = Reservation::findOrFail($id);

        // get drugs based on id
        $drugs = Drug::where('id', $id)->get();


        $collection = Settings::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });

        $data = [];
        $data['reservation'] = $reservation;
        $data['drugs'] = $drugs;
        $data['settings'] = $setting['setting'];


        $pdf = PDF::loadView('backend.dashboards.clinic.pages.prescription.english_prescription_pdf', $data);
        return $pdf->stream($reservation->patient->name . '.pdf');
    }

    public function deleteDrug($id)
    {
        
        try {
            $drug = Drug::findOrFail($id);
        $drug->delete();
            return response()->json(['message' => 'Drug deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete'], 500);
        }
    }
}
