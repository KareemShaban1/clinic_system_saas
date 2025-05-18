<?php

namespace App\Http\Controllers\Backend\MedicalLaboratory;

use App\Http\Controllers\Controller;
use App\Models\MedicalLaboratory;
use App\Models\ServiceFee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServiceFeeController extends Controller
{
    public function index()
    {

        $serviceFees = ServiceFee::get();

        return view('backend.dashboards.medicalLaboratory.pages.serviceFees.index', compact('serviceFees'));
    }

    public function data()
    {
        $serviceFees = ServiceFee::get();

        return DataTables::of($serviceFees)

            ->addColumn('actions', function ($serviceFee) {
                return '<button class="btn btn-warning btn-sm" onclick="editServiceFee(' . $serviceFee->id . ')">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="deleteServiceFee(' . $serviceFee->id . ')">
                        <i class="fa fa-trash"></i>
                    </button>';
            })
            ->rawColumns(['roles', 'actions'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required',
            'fee' => 'required',
            'notes' => 'required',
        ]);

        $serviceFee = ServiceFee::create([
            'service_name' => $request->service_name,
            'fee' => $request->fee,
            'notes' => $request->notes,
            'organization_id' => auth()->user()->organization_id,
            'organization_type' => MedicalLaboratory::class,
        ]);



        return response()->json(['success' => 'Service fee added successfully!']);
    }

    public function edit($id)
    {
        $serviceFee = ServiceFee::findOrFail($id);
        return response()->json([
            'id' => $serviceFee->id,
            'service_name' => $serviceFee->service_name,
            'fee' => $serviceFee->fee,
            'notes' => $serviceFee->notes
        ]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'service_name' => 'required',
            'fee' => 'required',
            'notes' => 'required',
        ]);

        try {

            $serviceFee = ServiceFee::findOrFail($id);
            $serviceFee->service_name = $request->service_name;
            $serviceFee->fee = $request->fee;
            $serviceFee->notes = $request->notes;
            $serviceFee->save();

            return response()->json(['success' => 'Service fee updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $serviceFee = ServiceFee::findOrFail($id);
            $serviceFee->delete();
            return response()->json(['success' => 'Service fee deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }
}
