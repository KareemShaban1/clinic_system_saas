<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\StoreChronicDiseaseRequest;

use App\Models\Reservation;
use App\Models\ChronicDiseases;

use Illuminate\Support\Facades\DB;

class ChronicDiseasesController extends Controller
{

    public function index(){

    }


    public function add( $id){

        // get reservation based on reservation_id
        $reservation = Reservation::findOrFail($id);

        return view('backend.pages.chronic_diseases.add',compact('reservation'));

    }

    public function store(StoreChronicDiseaseRequest $request){
       

        $request->validate();

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
            return redirect()->route('backend.reservations.index')->with('chronic_diseases','Sales Added Successfully');

        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }

    public function show($id){

        // get reservation based on reservation_id
        $reservations = Reservation::findOrFail($id);

        // get drugs based on reservation_id
        $chronic_diseases = DB::table('chronic_diseases')->where('reservation_id',$id)->get();

        return view('backend.pages.chronic_diseases.show',compact('chronic_diseases','reservations'));

    }

    public function edit( $id){

        // get reservation based on reservation_id
        $chronic_disease = ChronicDiseases::findOrFail($id);

        return view('backend.pages.chronic_diseases.edit',compact('chronic_disease'));

    }

    public function update(StoreChronicDiseaseRequest $request,$id){
       

        
        try{

            $request->validate();

            $chronic_disease = ChronicDiseases::findOrFail($id);
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
                DB::table('chronic_diseases')->where('id',$chronic_disease->id)->update($data);
            }
            return redirect()->route('backend.reservations.index')->with('chronic_diseases','Sales Added Successfully');

        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }
}
