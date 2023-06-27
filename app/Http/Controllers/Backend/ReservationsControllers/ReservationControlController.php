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
        $setting["setting"] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });

        return view('backend.pages.reservation_control.index', $setting);
    }

    public function update(Request $request)
    {

        foreach ($request->all() as $key => $value) {
            ReservationControl::where('key', $key)->update(['value' => $value]);
        }


        return back();
    }
}
