<?php

namespace App\Http\Controllers\Backend\Clinic\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreMedicineRequest;
use Illuminate\Http\Request;
use App\Models\Medicine;
use Illuminate\Validation\ValidationException;
use App\Http\Traits\AuthorizeCheck;
use Yajra\DataTables\Facades\DataTables;

class MedicineController extends Controller
{
    use AuthorizeCheck;

    public $medicine;

    public function __construct(Medicine $medicine)
    {
        $this->medicine = $medicine;
    }

    public function index()
    {
        $this->authorizeCheck('view-medicines');

        $medicines = $this->medicine->all();

        return view('backend.dashboards.clinic.pages.medicine.index', compact('medicines'));
    }

    public function data(){
        $query = $this->medicine->all();
        return DataTables::of($query)
        ->addColumn('action', function ($number) {
            $showUrl = route('backend.medicines.show', $number->id);
            $editUrl = route('backend.medicines.edit', $number->id);
            $deleteUrl = route('backend.medicines.destroy', $number->id);

            return '
                <a href="' . $showUrl . '" class="btn btn-info btn-sm">
                    <i class="fa fa-eye"></i>
                </a>
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
        ->rawColumns(['action'])
        ->make(true);

    }


    public function add()
    {
        $this->authorizeCheck('add-medicine');

        return view('backend.dashboards.clinic.pages.medicine.add');
    }

    public function store(StoreMedicineRequest $request)
    {
        $this->authorizeCheck('add-medicine');

        $request->validated();

        try { 

            $data = $request->all();
            $this->medicine->create($data);

            return redirect()->route('backend.medicines.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        $this->authorizeCheck('edit-medicine');

        $medicine = $this->medicine->findOrFail($id);

        return view('backend.dashboards.clinic.pages.medicine.edit', compact('medicine'));
    }

    public function update(Request $request, $id)
    {
        $this->authorizeCheck('edit-medicine');

        try {
            $data = $request->all();

            $medicine = $this->medicine->findOrFail($id);

            $medicine->update($data);

            return redirect()->route('backend.medicines.edit', $medicine->id);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function show($id)
    {
        $this->authorizeCheck('view-medicines');
        
        $medicine = $this->medicine->findOrFail($id);

        return view('backend.dashboards.clinic.pages.medicine.show', compact('medicine'));
    }

    public function destroy($id)
    {
        $this->authorizeCheck('delete-medicine');
        $medicine = $this->medicine->findOrFail($id);
        $medicine->delete();

        return redirect()->route('backend.medicines.index');
    }

    public function trash()
    {
        $this->authorizeCheck('restore-medicine');
        
        $medicines = $this->medicine->onlyTrashed()->get();
        return view('backend.dashboards.clinic.pages.medicine.trash', compact('medicines'));
    }

    public function restore($id)
    {
        $this->authorizeCheck('restore-medicine');
        
        $medicine = $this->medicine->onlyTrashed()->findOrFail($id);
        $medicine->restore();

        return redirect()->route('backend.medicines.index');
    }

    public function forceDelete($id)
    {
        $this->authorizeCheck('force-delete-medicine');
        
        $medicine = $this->medicine->onlyTrashed()->findOrFail($id);
        $medicine->forceDelete();

        return redirect()->route('backend.medicines.index');
    }
}