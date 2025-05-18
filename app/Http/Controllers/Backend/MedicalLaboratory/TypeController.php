<?php

namespace App\Http\Controllers\Backend\MedicalLaboratory;

use App\Http\Controllers\Controller;
use App\Models\MedicalLaboratory;
use App\Models\Type;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TypeController extends Controller
{
    public function index()
    {

        $types = Type::get();

        return view('backend.dashboards.medicalLaboratory.pages.types.index', compact('types'));
    }

    public function data()
    {
        $types = Type::get();

        return DataTables::of($types)

            ->addColumn('actions', function ($type) {
                return '<button class="btn btn-warning btn-sm" onclick="editType(' . $type->id . ')">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="deleteType(' . $type->id . ')">
                        <i class="fa fa-trash"></i>
                    </button>';
            })
            ->rawColumns(['roles', 'actions'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'type' => 'nullable',
        ]);

        $type = Type::create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'organization_id' => auth()->user()->organization_id,
            'organization_type' => MedicalLaboratory::class,
        ]);



        return response()->json(['success' => 'Type added successfully!']);
    }

    public function edit($id)
    {
        $type = Type::findOrFail($id);
        return response()->json([
            'id' => $type->id,
            'name' => $type->name,
            'description' => $type->description,
            'type' => $type->type,
            'organization_id' => auth()->user()->organization_id,
            'organization_type' => MedicalLaboratory::class,
        ]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'type' => 'nullable',
        ]);

        try {

            $type = Type::findOrFail($id);
            $type->name = $request->name;
            $type->description = $request->description;
            $type->type = $request->type;
            $type->save();

            return response()->json(['success' => 'Type updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $type = Type::findOrFail($id);
            $type->delete();
            return response()->json(['success' => 'Type deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }
}
