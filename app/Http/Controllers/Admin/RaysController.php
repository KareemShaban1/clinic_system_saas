<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Ray;

class RaysController extends Controller
{
    //

    public function index()
    {
        // get all reservations 
        $reservations = Reservation::all();
        return view('admin.reservations.index', compact('reservations'));
    }

    public function add(Request $request, $id){

        // get reservation based on reservation_id
        $reservation = Reservation::findOrFail($id);

        return view('admin.rays.add',compact('reservation'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'ray_name' => 'required',
            'images' => 'required',
            'ray_date'=>'required',
            'ray_type'=>'required',
            'note'=>'nullable',
            'patient_id'=>'required'
            
            ]);

        try {


            if($files = $request->file('images')){
                foreach($files as $file){
                    // $image_name = md5(rand(1000,10000));
                    $image_name = strtolower($file->getClientOriginalName());
                    $image_full_name = $image_name ;
                    $upload_path = 'public/images/';
                    $image_url = $upload_path.$image_full_name;
                    $file->move($upload_path,$image_full_name);
                    $images[]=$image_url;
                }
            }

            $ray = new Ray();

            $ray->patient_id = $request->patient_id;
            $ray->reservation_id = $request->reservation_id;
            $ray->ray_name = $request->ray_name;
            $ray->image = implode('|',$images);
            $ray->ray_type= $request->ray_type;
            $ray->ray_date= $request->ray_date;
            $ray->notes= $request->notes;

            
          
            $ray->save();
            
            return redirect()->route('admin.reservations.index')->with('success', 'Reservation added successfully');
        
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function show( $id){

        // get reservation based on reservation_id
        $rays = Ray::where('reservation_id',$id)->get();

        return view('admin.rays.show',compact('rays'));

    }




}
