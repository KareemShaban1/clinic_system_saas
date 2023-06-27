<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreGlassesDistanceRequest;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Settings;
use App\Models\GlassesDistance;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;


class GlassesDistanceController extends Controller
{
    //
    public function index()
    {

        $glasses_distances = GlassesDistance::all();
        return view('backend.pages.glasses_distance.index', compact('glasses_distances'));
    }

    public function add(Request $request, $id)
    {
        // get reservation based on reservation_id
        $reservation = Reservation::findOrFail($id);

        return view('backend.pages.glasses_distance.add', compact('reservation'));
    }


    public function store(StoreGlassesDistanceRequest $request)
    {

        try {
            $request->validated();
            
            $data = $request->all();

            GlassesDistance::create($data);

            return redirect()->route('backend.glasses_distance.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
    public function edit($id)
    {
        $glasses_distance = GlassesDistance::findOrFail($id);
        return view('backend.pages.glasses_distance.edit', compact('glasses_distance'));
    }
    public function update($id, Request $request)
    {

        try {

            $glasses_distance = GlassesDistance::findOrFail($id);

            $data = $request->all();

            $glasses_distance->update($data);

            return redirect()->route('backend.glasses_distance.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function glasses_distance_pdf($id)
    {

        $glasses_distances = GlassesDistance::where('reservation_id', $id)->first();

        $reservation = Reservation::findOrFail($id);

        $collection = Settings::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });

        $data = [];
        $data['settings'] = $setting['setting'];
        $data['glasses_distance'] = $glasses_distances;
        $data['reservation'] = $reservation;


        $pdf = PDF::loadView('backend.pages.glasses_distance.glasses_distance_pdf', $data);

        return $pdf->stream('Glasses' . '.pdf');
    }

    public function destroy()
    {
    }
    public function trash()
    {
    }
    public function force_delete()
    {
    }
    public function restore()
    {
    }
}
