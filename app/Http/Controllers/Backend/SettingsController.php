<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\SystemControl;

class SettingsController extends Controller
{
    public function index()
    {


        return view('backend.pages.settings.index');

    }

    public function clinicSettings()
    {

        $collection = Settings::all();
        $settings = $collection->pluck('value', 'key');

        return view('backend.pages.settings.clinicSettings', compact('settings'));
    }

    public function updateClinicSettings(Request $request)
    {


        foreach ($request->all() as $key => $value) {
            Settings::where('key', $key)->update(['value' => $value]);
        }

        return back();

    }


    public function reservationSettings()
    {

        $collection = SystemControl::all();
        $settings["settings"] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });


        return view('backend.pages.settings.reservationSettings', $settings);
    }

    public function updateReservationSettings(Request $request)
    {

        foreach ($request->all() as $key => $value) {
            SystemControl::where('key', $key)->update(['value' => $value]);
        }


        return back();
    }

    public function zoomSettings()
    {


        $collection = Settings::all();
        $zoomSettings = $collection->pluck('value', 'key');

        return view('backend.pages.settings.zoomSettings', compact('zoomSettings'));
    }

    public function updateZoomSettings(Request $request)
    {


        foreach ($request->all() as $key => $value) {
            Settings::where('key', $key)->update(['value' => $value]);
        }

        return back();

    }


}
