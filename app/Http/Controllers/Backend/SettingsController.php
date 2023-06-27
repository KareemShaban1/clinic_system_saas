<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsController extends Controller
{

    public function index()
    {


        $collection = Settings::all();
        $settings = $collection->pluck('value', 'key');

        return view('backend.pages.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {

       
        foreach ($request->all() as $key=> $value) {
            Settings::where('key', $key)->update(['value' => $value]);
        }

        return back();

    }

}
