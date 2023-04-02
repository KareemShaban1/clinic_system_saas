<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsController extends Controller
{
    //
    // public function settings(){
        
    //     return view('backend.pages.settings.settings');
    // }
    public function index(){

        $collection = Settings::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
            
        });
        
        return view('backend.pages.settings.index', $setting);
    }

    public function update(Request $request){

        // try{

            // $info = $request->except('_token', '_method', 'logo');
            foreach ($request->all() as $key=> $value){
                Settings::where('key', $key)->update(['value' => $value]);
            }


            // toastr()->success(trans('messages.Update'));
            return back();
       
    }

}
