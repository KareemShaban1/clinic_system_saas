<?php

namespace App\Http\Controllers\Backend\MedicalLaboratory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreAnalysisRequest;
use App\Http\Requests\Backend\UpdateAnalysisRequest;
use App\Models\MedicalAnalysis;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class MedicalAnalysisController extends Controller
{
    //
    public function index()
    {
        $medicalAnalysis = MedicalAnalysis::all();

        return view('backend.dashboards.medicalLaboratory.pages.medicalAnalysis.index', compact('medicalAnalysis'));
    }

    public function data()
    {
        $medicalAnalysis = MedicalAnalysis::all();

        return DataTables::of($medicalAnalysis)
            ->addColumn('action', function ($analysis) {
                $editUrl = route('medicalLaboratory.analysis.edit', $analysis->id);
                $deleteUrl = route('medicalLaboratory.analysis.destroy', $analysis->id);

                return '
                <a href="' . $editUrl . '" class="btn btn-warning btn-sm">
                    <i class="fa fa-edit"></i>
                </a>
                <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            ';
            })
            ->editColumn('patient', function ($analysis) {
                return $analysis->patient->name ?? 'N/A';
            })
            ->rawColumns(['action']) // Ensure the HTML in the action column is not escaped
            ->make(true);
    }

    public function show($id)
    {


        // get reservation based on id
        $medical_analysis = MedicalAnalysis::where('id', $id)->get();

        return view('backend.dashboards.medicalLaboratory.pages.medicalAnalysis.show', compact('medical_analysis'));
    }

    public function add($id)
    {

        $reservation = Reservation::findOrFail($id);

        return view('backend.dashboards.medicalLaboratory.pages.medicalAnalysis.add', compact('reservation'));
    }

    public function create()
    {
        $patients = Patient::medicalLaboratory()->get();
        $types = Type::get();

        return view(
            'backend.dashboards.medicalLaboratory.pages.medicalAnalysis.create',
            compact('patients', 'types')
        );
    }
    public function store(StoreAnalysisRequest $request)
    {

        try {

            $medical_analysis = new MedicalAnalysis;
            $data = $request->except('images');
            $medical_analysis->create($data);

            // Check if images are uploaded
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $medical_analysis->addMedia($image)->toMediaCollection('analysis_images');
                }
            }
            return redirect()->route('medicalLaboratory.medicalAnalysis.index')->with('toast_success', 'Medical Analysis added successfully');
        } catch (ValidationException $e) {
            dd($e->getMessage());

            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function edit($id)
    {

        $analysis = MedicalAnalysis::findOrFail($id);

        return view('backend.dashboards.medicalLaboratory.pages.medicalAnalysis.edit', compact('analysis'));
    }

    public function update(UpdateAnalysisRequest $request, $id)
    {

        try {

            $medical_analysis = MedicalAnalysis::findOrFail($id);

            $data = $request->except('images');

            // $data['images'] = $this->handleImageUpload($request, $medical_analysis);

            $medical_analysis->update($data);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $medical_analysis->addMedia($image)->toMediaCollection('analysis_images');
                }
            }

            return redirect()->route('medicalLaboratory.medicalAnalysis.index')->with('toast_success', 'Reservation updated successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function delete() {}

    public function restore() {}

    public function forceDelete() {}

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
