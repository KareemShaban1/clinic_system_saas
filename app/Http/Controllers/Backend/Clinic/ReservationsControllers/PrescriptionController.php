<?php

namespace App\Http\Controllers\Backend\Clinic\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreDrugRequest;
use App\Models\{
    Drug, Prescription, Reservation,Settings
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;

class PrescriptionController extends Controller
{
    // prescription controller

    public function index()
    {

    }

    // add drugs to prescription
    public function add(Request $request, $id)
    {
        

        // get reservation based on id
        $reservation = Reservation::findOrFail($id);

        $prescriptions = Prescription::where('id',$reservation->id)->get();

        return view('backend.dashboards.clinic.pages.prescription.add', compact('reservation','prescriptions'));

    }



    public function UploadPrescription(Request $request)
    {
        $prescription = new Prescription();
        $data = $request->except('images');
        $image_path = $this->handleImageUpload($request, $prescription);
        $data['images'] =  $image_path;
        $prescription->create($data);
        return redirect()->route('backend.reservations.index')->with('success', 'Sales Added Successfully');


    }

    private function handleImageUpload($request, $prescription)
    {
        $old_image = explode('|', $prescription->images);
        $image_path = [];

        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $image_name = strtolower($file->getClientOriginalName());
                $file->storeAs(
                    'prescriptions',
                    $image_name,
                    ['disk' => 'uploads']
                );
                $image_path[] = $image_name;
            }

            foreach ($old_image as $key => $value) {
                if ($image_path && !empty($value)) {
                    Storage::disk('uploads')->delete('prescriptions/' . $value);
                }
            }
        }

        return $image_path ? implode('|', $image_path) : $prescription->images;
    }


    public function store(StoreDrugRequest $request)
    {

        $request->validated();

        try {

            for($i = 0; $i < count($request->drug_name) ; $i++) {
                $data=[
                    'drug_name' => $request->drug_name[$i],
                    'drug_dose' => $request->drug_dose[$i],
                    'drug_type' => $request->drug_type[$i],
                    'frequency' => $request->frequency[$i],
                    'period' => $request->period[$i],
                    'notes' => $request->notes[$i],
                    'id' => $request->id[$i],
                ];
                DB::table('drugs')->insert($data);
            }
            return redirect()->route('backend.reservations.index')->with('success', 'Sales Added Successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }

    public function show(Request $request, $id)
    {


        // get reservation based on id
        $reservation = Reservation::findOrFail($id);

        // get drugs based on id
        $drugs = Drug::where('id', $id)->get();


        return view('backend.dashboards.clinic.pages.prescription.show', compact('drugs', 'reservation'));

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

        $data= [];
        $data['reservation']= $reservation;
        $data['drugs']= $drugs;
        $data['settings']=$setting['setting'];

        $pdf = PDF::loadView('backend.dashboards.clinic.pages.prescription.arabic_prescription_pdf', $data);
        return $pdf->stream($reservation->patient->name .'.pdf');



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

        $data= [];
        $data['reservation']= $reservation;
        $data['drugs']= $drugs;
        $data['settings']=$setting['setting'];


        $pdf = PDF::loadView('backend.dashboards.clinic.pages.prescription.english_prescription_pdf', $data);
        return $pdf->stream($reservation->patient->name .'.pdf');


    }
}