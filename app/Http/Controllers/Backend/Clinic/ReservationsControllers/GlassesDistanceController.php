<?php

namespace App\Http\Controllers\Backend\Clinic\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreGlassesDistanceRequest;
use App\Http\Traits\AuthorizeCheck;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Settings;
use App\Models\GlassesDistance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use PDF;

class GlassesDistanceController extends Controller
{
    use AuthorizeCheck;

    public function index(GlassesDistance $glassesDistance)
    {
        $this->authorizeCheck('view-glasses-distances');
        $glasses_distances = $glassesDistance->all();
        return view('backend.dashboards.clinic.pages.glasses_distance.index', compact('glasses_distances'));
    }

    public function data(){
        $glasses_distances = GlassesDistance::all();
        return datatables()->of($glasses_distances)
        ->addColumn('action', function ($glasses_distance) {
        })
        ->addColumn('patient', function ($glasses_distance) {
            return $glasses_distance->patient->name ?? 'N/A';
        })

        ->make(true);
    }

    public function add(Request $request, Reservation $reservation, $id)
    {
        $this->authorizeCheck('add-glasses-distance');

        // get reservation based on reservation_id
        $reservation = $reservation->findOrFail($id);

        return view('backend.dashboards.clinic.pages.glasses_distance.add', compact('reservation'));
    }

    public function store(StoreGlassesDistanceRequest $request, GlassesDistance $glassesDistance)
    {
        $this->authorizeCheck('add-glasses-distance');

        $request->validated();

        try {

            $data = $request->all();
            $data['clinic_id'] = Auth::user()->organization->id;

            $glassesDistance->create($data);

            return redirect()->route('clinic.glasses_distance.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('toast_error', $e->getMessage());
        }
    }

    public function edit(GlassesDistance $glassesDistance, $id)
    {
        $this->authorizeCheck('edit-glasses-distance');

        $glasses_distance = $glassesDistance->findOrFail($id);
        return view('backend.dashboards.clinic.pages.glasses_distance.edit', compact('glasses_distance'));
    }

    public function update($id, Request $request, GlassesDistance $glassesDistance)
    {
        $this->authorizeCheck('edit-glasses-distance');

        try {
            $glasses_distance = $glassesDistance->findOrFail($id);

            $data = $request->all();

            $glasses_distance->update($data);

            return redirect()->route('clinic.glasses_distance.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {

            return redirect()->back()->with('toast_error', $e->getMessage());
        }
    }

    public function glasses_distance_pdf($id, GlassesDistance $glassesDistance, Reservation $reservation)
    {
        $this->authorizeCheck('view-glasses-distances');

        $glasses_distances = $glassesDistance->where('reservation_id', $id)->first();

        $reservation = $reservation->findOrFail($id);

        // Rest of the method implementation
        $collection = Settings::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });

        $data = [];
        $data['settings'] = $setting['setting'];
        $data['glasses_distance'] = $glasses_distances;
        $data['reservation'] = $reservation;


        $pdf = PDF::loadView('backend.dashboards.clinic.pages.glasses_distance.glasses_distance_pdf', $data);

        return $pdf->stream('Glasses' . '.pdf');
    }

}
