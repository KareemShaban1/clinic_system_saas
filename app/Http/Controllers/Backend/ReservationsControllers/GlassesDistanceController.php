<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Settings;
use App\Models\GlassesDistance;
use PDF;

class GlassesDistanceController extends Controller
{
    //
    public function index(){

        $glasses_distances = GlassesDistance::all();
        return view('backend.pages.glasses_distance.index',compact('glasses_distances'));

    }
    public function add(Request $request, $id){

        // get reservation based on reservation_id
        $reservation = Reservation::findOrFail($id);
        return view('backend.pages.glasses_distance.add',compact('reservation'));
    }
    public function store(Request $request){


try{ 

    $glasses_distance = new GlassesDistance;
    $glasses_distance->reservation_id = $request->reservation_id;

    $glasses_distance->SPH_R_D = $request->SPH_R_D;
    $glasses_distance->CYL_R_D = $request->CYL_R_D;
    $glasses_distance->AX_R_D = $request->AX_R_D;
    $glasses_distance->SPH_L_D = $request->SPH_L_D;
    $glasses_distance->CYL_L_D = $request->CYL_L_D;
    $glasses_distance->AX_L_D = $request->AX_L_D;

    $glasses_distance->SPH_R_N = $request->SPH_R_N;
    $glasses_distance->CYL_R_N = $request->CYL_R_N;
    $glasses_distance->AX_R_N = $request->AX_R_N;
    $glasses_distance->SPH_L_N = $request->SPH_L_N;
    $glasses_distance->CYL_L_N = $request->CYL_L_N;
    $glasses_distance->AX_L_N = $request->AX_L_N;
    $glasses_distance->save();

    return redirect()->route('backend.glasses_distance.index');


 } catch (\Exception $e) {
    return redirect()->back()->with('error', 'Something went wrong');
}



        
    }
    public function edit($id){
        $glasses_distance = GlassesDistance::findOrFail($id);
        return view('backend.pages.glasses_distance.edit',compact('glasses_distance'));
        
    }
    public function update($id,Request $request){

        try{ 
        
        $glasses_distance = GlassesDistance::findOrFail($id);
        $glasses_distance->reservation_id = $request->reservation_id;

        $glasses_distance->SPH_R_D = $request->SPH_R_D;
        $glasses_distance->CYL_R_D = $request->CYL_R_D;
        $glasses_distance->AX_R_D = $request->AX_R_D;
        $glasses_distance->SPH_L_D = $request->SPH_L_D;
        $glasses_distance->CYL_L_D = $request->CYL_L_D;
        $glasses_distance->AX_L_D = $request->AX_L_D;

        $glasses_distance->SPH_R_N = $request->SPH_R_N;
        $glasses_distance->CYL_R_N = $request->CYL_R_N;
        $glasses_distance->AX_R_N = $request->AX_R_N;
        $glasses_distance->SPH_L_N = $request->SPH_L_N;
        $glasses_distance->CYL_L_N = $request->CYL_L_N;
        $glasses_distance->AX_L_N = $request->AX_L_N;
        $glasses_distance->save();

        return redirect()->route('backend.glasses_distance.index');
        
    
        } catch (\Exception $e) {
           return redirect()->back()->with('error', 'Something went wrong');
       }
        
        
    }

    public function glasses_distance_pdf($id){

        $glasses_distances = GlassesDistance::where('reservation_id',$id)->first();

        $reservation = Reservation::findOrFail($id);

        $collection = Settings::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
            
        });
    
        $data= [];
        $data['settings']=$setting['setting'];
        $data['glasses_distance']=$glasses_distances;
        $data['reservation']=$reservation;
        
        
        $pdf = PDF::loadView('backend.pages.glasses_distance.glasses_distance_pdf',$data);
        
        return $pdf->stream( 'Glasses' .'.pdf');


    }

    public function destroy(){
        
    }
    public function trash(){
        
    }
    public function force_delete(){
        
    }
    public function restore(){
        
    }
}
