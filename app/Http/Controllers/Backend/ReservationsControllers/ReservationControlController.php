<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReservationControl;

class ReservationControlController extends Controller
{

    public function index()
    {

        $collection = ReservationControl::all();
        $settings["settings"] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        // dd($settings);

        return view('backend.pages.reservation_control.index', $settings);
    }

    public function update(Request $request)
    {

        foreach ($request->all() as $key => $value) {
            ReservationControl::where('key', $key)->update(['value' => $value]);
        }


        return back();
    }
}
