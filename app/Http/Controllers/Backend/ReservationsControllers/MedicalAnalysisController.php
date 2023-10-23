<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpdateAnalysisRequest;
use App\Models\MedicalAnalysis;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class MedicalAnalysisController extends Controller
{
    //
    public function index()
    {
        $medical_analysis = MedicalAnalysis::all();

        return view('backend.pages.medicalAnalysis.index', compact('medical_analysis'));

    }

    public function show($id)
    {


        // get reservation based on reservation_id
        $medical_analysis = MedicalAnalysis::where('reservation_id', $id)->get();

        return view('backend.pages.medicalAnalysis.show', compact('medical_analysis'));
    }

    public function add($reservation_id)
    {
        
        $reservation = Reservation::findOrFail($reservation_id);
        
        return view('backend.pages.medicalAnalysis.add', compact('reservation'));


    }
    public function store(Request $request)
    {

        try {

            $medical_analysis = new MedicalAnalysis;
            $data = $request->except('images');
            $image_path = $this->handleImageUpload($request, $medical_analysis);
            $data['images'] =  $image_path;
            // dd($data);
            $medical_analysis->create($data);
            return redirect()->route('backend.reservations.index')->with('success', 'Medical Analysis added successfully');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }

    public function edit($id)
    {

        $analysis = MedicalAnalysis::findOrFail($id);
        
        return view('backend.pages.medicalAnalysis.edit', compact('analysis'));


    }

    public function update(UpdateAnalysisRequest $request, $id)
    {

        try {

            $medical_analysis = MedicalAnalysis::findOrFail($id);

            $data = $request->except('images');

            $data['images'] = $this->handleImageUpload($request, $medical_analysis);

            $medical_analysis->update($data);

            return redirect()->route('backend.reservations.index')->with('success', 'Reservation updated successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function delete()
    {

    }

    public function restore()
    {

    }

    public function forceDelete()
    {

    }

    // 
     // function to handel upload rays
     private function handleImageUpload($request, $medical_analysis)
     {
        
         $old_image = explode('|', $medical_analysis->images);
         $image_path = [];
 
         if ($files = $request->file('images')) {
             foreach ($files as $file) {
                $image_name = strtolower($file->getClientOriginalName());
                $image_name = str_replace(' ', '_', $image_name); // Replace spaces with underscores
                 $file->storeAs(
                     'medical_analysis',
                     $image_name,
                     ['disk' => 'uploads']
                 );
                 $image_path[] = $image_name;
             }
 
             foreach ($old_image as $key => $value) {
                 if ($image_path && !empty($value)) {
                     Storage::disk('uploads')->delete('medical_analysis/' . $value);
                 }
             }
         }
 
         return $image_path ? implode('|', $image_path) : $medical_analysis->images;
     }
}