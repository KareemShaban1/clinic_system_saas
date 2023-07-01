<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreMedicineRequest;
use Illuminate\Http\Request;
use App\Models\Medicine;
use Illuminate\Validation\ValidationException;

class MedicineController extends Controller
{
    public function index(Medicine $medicine)
    {
        $medicines = $medicine->all();

        return view('backend.pages.medicine.index', compact('medicines'));
    }

    public function add()
    {
        return view('backend.pages.medicine.add');
    }

    public function store(StoreMedicineRequest $request, Medicine $medicine)
    {
        try {
            $request->validated();

            $data = $request->all();
            $medicine->create($data);

            return redirect()->route('backend.medicines.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function edit($id, Medicine $medicine)
    {
        $medicine = $medicine->findOrFail($id);

        return view('backend.pages.medicine.edit', compact('medicine'));
    }

    public function update(Request $request, $id, Medicine $medicine)
    {
        try {
            $data = $request->all();

            $medicine = $medicine->findOrFail($id);

            $medicine->update($data);

            return redirect()->route('backend.medicines.edit', $medicine->id);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function show($id, Medicine $medicine)
    {
        $medicine = $medicine->findOrFail($id);

        return view('backend.pages.medicine.show', compact('medicine'));
    }

    public function destroy($id, Medicine $medicine)
    {
        $medicine = $medicine->findOrFail($id);
        $medicine->delete();

        return redirect()->route('backend.medicines.index');
    }

    public function trash(Medicine $medicine)
    {
        $medicines = $medicine->onlyTrashed()->get();
        return view('backend.pages.medicine.trash', compact('medicines'));
    }

    public function restore($id, Medicine $medicine)
    {
        $medicine = $medicine->onlyTrashed()->findOrFail($id);
        $medicine->restore();

        return redirect()->route('backend.medicines.index');
    }

    public function forceDelete($id, Medicine $medicine)
    {
        $medicine = $medicine->onlyTrashed()->findOrFail($id);
        $medicine->forceDelete();

        return redirect()->route('backend.medicines.index');
    }
}
