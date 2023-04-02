<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRayRequest;
use App\Http\Requests\UpdateRayRequest;

use App\Models\Reservation;
use App\Models\Ray;

use Illuminate\Support\Facades\Storage;

class RaysController extends Controller
{
    //

    public function index()
    {
        // get all reservations 
        $reservations = Reservation::all();
        return view('backend.pages.reservations.index', compact('reservations'));
    }

    public function add(Request $request, $id){

        // get reservation based on reservation_id
        $reservation = Reservation::findOrFail($id);

        return view('backend.pages.rays.add',compact('reservation'));

    }

    public function store(StoreRayRequest $request)
    {

        try {

            $validated =$request->validated();


            $image_path = null;
            if($files = $request->file('images')){
                foreach($files as $file){
                    $image_name = strtolower($file->getClientOriginalName());
                    // $image_full_name = $image_name ;
                    // $upload_path = 'public/images/';
                    // $image_url = $upload_path.$image_full_name;
                    // $file->move($upload_path,$image_full_name);
                    $image_upload = $file->storeAs('uploads',$image_name,
                      ['disk'=>'uploads']);
                    // $images[]=$image_path;
                    $image_path[] = $image_name;
                }
            }

            $ray = new Ray();

            $ray->patient_id = $request->patient_id;
            $ray->reservation_id = $request->reservation_id;
            $ray->ray_name = $request->ray_name;
            $ray->image = implode('|',$image_path) ;
            $ray->ray_type= $request->ray_type;
            $ray->ray_date= $request->ray_date;
            $ray->notes= $request->notes;

            
          
            $ray->save();
            
            return redirect()->route('backend.reservations.index')->with('success', 'Reservation added successfully');
        
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function show( $id){

        // get reservation based on reservation_id
        $rays = Ray::where('reservation_id',$id)->get();

        return view('backend.pages.rays.show',compact('rays'));

    }


    public function edit( $id){

        // get reservation based on reservation_id
        $ray = Ray::findOrFail($id);

        return view('backend.pages.rays.edit',compact('ray'));

    }

    public function update(StoreRayRequest $request,$id)
    {


        try {
            $validated =  $request->validated();

            $ray =  Ray::findOrFail($id);

            $image_path = null;
            $old_image = explode('|',$ray->image);;
            if($files = $request->file('images')){
                foreach($files as $file){
                    $image_name = strtolower($file->getClientOriginalName());
                    $image_upload = $file->storeAs('uploads',$image_name,
                      ['disk'=>'uploads']);
                    $image_path[] = $image_name;
                }
            }

            // dd($old_image);
            foreach($old_image as $key => $value){
                
                if($image_path && !empty($value)){
                    Storage::disk('public')->delete('uploads/'.$value);
                }
            }


            $ray->patient_id = $request->patient_id;
            $ray->reservation_id = $request->reservation_id;
            $ray->ray_name = $request->ray_name;
            $ray->image = $image_path ? implode('|',$image_path) : $ray->image;
            $ray->ray_type= $request->ray_type;
            $ray->ray_date= $request->ray_date;
            $ray->notes= $request->notes;
            $ray->save();
            
            return redirect()->route('backend.reservations.index')->with('success', 'Reservation added successfully');
        
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }




}
