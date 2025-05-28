<?php

namespace App\Http\Controllers\Backend\MedicalLaboratory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreAnalysisRequest;
use App\Http\Requests\Backend\UpdateAnalysisRequest;
use App\Models\MedicalAnalysis;
use App\Models\ModuleServiceFee;
use App\Models\OrganizationServiceFee;
use App\Models\Patient;
use App\Models\Reservation;
use App\Models\ServiceFee;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            ->addColumn('cost', function ($analysis) {
                return $analysis->cost ?? 0;
            })
            ->addColumn('payment', function ($analysis) {
                switch ($analysis->payment) {
                    case 'paid':
                        return  trans('backend/medicalAnalysis_trans.Paid') ;
                    case 'not paid':
                        return trans('backend/medicalAnalysis_trans.Not_Paid');
                    default:
                        return 'Unknown';
                }
            })
            ->addColumn('date', function ($analysis) {
                return $analysis->date;
            })
            ->addColumn('service_fee', function ($analysis) {
                $serviceFees = $analysis->serviceFees()->get();
                $serviceFeeIds = $serviceFees->pluck('service_fee_id')->toArray();
                $serviceFeeNames = ServiceFee::
                whereIn('id', $serviceFeeIds)->pluck('service_name')->toArray();
                
                $serviceFeeNames = array_map(function ($name) {
                    return '<span class="badge badge-primary">' . $name . '</span>';
                }, $serviceFeeNames);

                return implode(' ', $serviceFeeNames);
            })
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
            ->rawColumns(['action', 'service_fee']) // Ensure the HTML in the action column is not escaped
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


        $patient = Patient::findOrFail($id);

        return view('backend.dashboards.medicalLaboratory.pages.medicalAnalysis.add', compact('patient'));
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
    public function store(Request $request)
    {
        try {

            $medical_analysis = new MedicalAnalysis;
            $data = $request->except('images');


            $medical_analysis = MedicalAnalysis::create($data);


            if ($request->has('service_fee_id')) {
                foreach ($request->service_fee_id as $index => $serviceFeeId) {
                    $fee = $request->service_fee[$index] ?? 0;
                    $notes = $request->service_fee_notes[$index] ?? null;

                    $medical_analysis->cost += $fee;
                    $medical_analysis->save();

                    $analysisServiceFee = new ModuleServiceFee();
                    $analysisServiceFee->module_id = $medical_analysis->id;
                    $analysisServiceFee->module_type = MedicalAnalysis::class;
                    $analysisServiceFee->service_fee_id = $serviceFeeId;
                    $analysisServiceFee->fee = $fee;
                    $analysisServiceFee->notes = $notes;
                    $analysisServiceFee->save();

                    if ($request->hasFile("service_fee_images.$index")) {
                        foreach ($request->file("service_fee_images")[$index] as $image) {
                            $analysisServiceFee->addMedia($image)->toMediaCollection('service_fee_images');
                        }
                    }
                }
            }
            return redirect()->route('medicalLaboratory.analysis.index')->with('toast_success', 'Medical Analysis added successfully');
        } catch (ValidationException $e) {
            dd($e->getMessage());

            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function edit($id)
    {

        $analysis = MedicalAnalysis::findOrFail($id);
        $analysis->load('serviceFees');


        return view('backend.dashboards.medicalLaboratory.pages.medicalAnalysis.edit', compact('analysis'));
    }

    public function update(Request $request, $id)
    {
        try {
            $medical_analysis = MedicalAnalysis::findOrFail($id);
    
            $data = $request->except(['images', 'service_fee_id', 'service_fee', 'service_fee_notes', 'service_fee_images']);
    
            $medical_analysis->update($data);
    
            $existingFees = $medical_analysis->serviceFees()->get()->keyBy('service_fee_id');
        
            if ($request->has('service_fee_id')) {
                foreach ($request->service_fee_id as $index => $serviceFeeId) {
                    $fee = $request->service_fee[$index] ?? 0;
                    $notes = $request->service_fee_notes[$index] ?? null;

                    $medical_analysis->cost += $fee;
                    $medical_analysis->save();
        
                    $serviceFee = $existingFees->get($serviceFeeId);
    
                    if ($serviceFee) {
                        // Update existing fee
                        $serviceFee->update([
                            'fee' => $fee,
                            'notes' => $notes,
                        ]);
                    } else {
                        // Create new fee
                        $serviceFee = ModuleServiceFee::create([
                            'module_id' => $medical_analysis->id,
                            'module_type' => MedicalAnalysis::class,
                            'service_fee_id' => $serviceFeeId,
                            'fee' => $fee,
                            'notes' => $notes,
                        ]);
                    }
    
                    // Handle images
                    if ($request->hasFile("service_fee_images.$index")) {
                        // Delete old images first
                        $serviceFee->clearMediaCollection('service_fee_images');
    
                        // Add new images
                        foreach ($request->file("service_fee_images")[$index] as $image) {
                            $serviceFee->addMedia($image)->toMediaCollection('service_fee_images');
                        }
                    }
                }
            }
    
            return redirect()->route('medicalLaboratory.analysis.index')->with('toast_success', 'Medical Analysis updated successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    
    

    public function delete() {}

    public function restore() {}

    public function forceDelete() {}
}
