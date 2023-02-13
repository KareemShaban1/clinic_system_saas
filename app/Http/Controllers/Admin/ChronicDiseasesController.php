<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class ChronicDiseasesController extends Controller
{
    //

    public function add(Request $request, $id){

        // get reservation based on reservation_id
        $reservation = Reservation::findOrFail($id);

        return view('admin.chronic_diseases.add',compact('reservation'));

    }

    public function store(Request $request){
       


        $request->validate([
            'title' => 'required',
            'measure' => 'required',
            'notes'=>'nullable',
            'date'=>'required',
            'patient_id'=>'required',
            'reservation_id'=>'required',
            
            ]);

        try{

            $title = $request->title;
            $measure = $request->measure;
            $notes = $request->notes;
            $date = $request->date;
            $patient_id = $request->patient_id;
            $reservation_id = $request->reservation_id;
 

            for($i = 0; $i < count($title) ; $i++){     
                $data=[
                    'title' => $title[$i],
                    'measure'=>$measure[$i],
                    'date'=>$date[$i],
                    'notes' => $notes[$i],
                    'patient_id' => $patient_id[$i],
                    'reservation_id' => $reservation_id[$i],
                ];
                DB::table('chronic_diseases')->insert($data);
            }
            return redirect()->route('admin.reservations.index')->with('chronic_diseases','Sales Added Successfully');

        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }

    public function show(Request $request,$id){

        

        // get reservation based on reservation_id
        $reservations = Reservation::findOrFail($id);

        // get drugs based on reservation_id
        $chronic_diseases = DB::table('chronic_diseases')->where('reservation_id',$id)->get();


        return view('admin.chronic_diseases.show',compact('chronic_diseases','reservations'));

    }
}
