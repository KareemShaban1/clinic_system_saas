<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemControl;

class SystemControlController extends Controller
{

    public function index()
    {

        $collection = SystemControl::all();
        $settings["settings"] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        // dd($settings);

        return view('backend.pages.system_control.index', $settings);
    }

    public function update(Request $request)
    {

        foreach ($request->all() as $key => $value) {
            SystemControl::where('key', $key)->update(['value' => $value]);
        }


        return back();
    }
}
