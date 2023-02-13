<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsController extends Controller
{
    //
    // public function settings(){
        
    //     return view('admin.settings.settings');
    // }
    public function index(){

        $collection = Settings::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
            
        });
        // dd($setting['setting']["doctor_name"]);
        
        return view('admin.settings.index', $setting);
    }

    public function update(Request $request){

        // try{

            // $info = $request->except('_token', '_method', 'logo');
            foreach ($request->all() as $key=> $value){
                Settings::where('key', $key)->update(['value' => $value]);
            }


            // toastr()->success(trans('messages.Update'));
            return back();
        // }
        // catch (\Exception $e){

        //     return redirect()->back()->with(['error' => $e->getMessage()]);
        // }

    }

    // public function store(Request $request){
        
    //     $settings = new Settings;
    //     $settings->Doctor_Name= $request->Doctor_Name;
    //     $settings->Doctor_Address= $request->Doctor_Address;
    //     $settings->Clinic_Name= $request->Clinic_Name;
    //     $settings->Clinic_Address= $request->Clinic_Address;
    //     $settings->Qualifications= $request->Qualifications;
    //     $settings->phone= $request->phone;
    //     $settings->email= $request->email;
    //     $settings->website= $request->website;

    //     $settings->save();

    //     return redirect()->route('admin.dashboard.index');

        
    // }
}
