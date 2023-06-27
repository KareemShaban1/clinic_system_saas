<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreChronicDiseaseRequest;
use App\Http\Requests\Backend\UpdateChronicDiseaseRequest;
use Illuminate\Http\Request;

use App\Models\Reservation;
use App\Models\ChronicDisease;

use Illuminate\Support\Facades\DB;

class ChronicDiseaseController extends Controller
{

    public function index(){

    }


    public function add( $id){

        // get reservation based on reservation_id
        $reservation = Reservation::findOrFail($id);

        return view('backend.pages.chronic_diseases.add',compact('reservation'));

    }

    // store chronic diseases 
    public function store(StoreChronicDiseaseRequest $request){
       

        $request->validated();

        try{

            for($i = 0; $i < count($request->title) ; $i++){     
                $data=[
                    'title' => $request->title[$i],
                    'measure'=>$request->measure[$i],
                    'date'=>$request->date[$i],
                    'notes' => $request->notes[$i],
                    'patient_id' => $request->patient_id[$i],
                    'reservation_id' => $request->reservation_id[$i],
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
        $chronic_diseases = ChronicDisease::where('reservation_id',$id)->get();

        return view('backend.pages.chronic_diseases.show',compact('chronic_diseases','reservations'));

    }

    public function edit( $id){

        // get reservation based on reservation_id
        $chronic_disease = ChronicDisease::findOrFail($id);

        return view('backend.pages.chronic_diseases.edit',compact('chronic_disease'));

    }

    public function update(UpdateChronicDiseaseRequest $request,$id){
       
        
        try{

            $request->validated();

            $chronic_disease = ChronicDisease::findOrFail($id);

            for($i = 0; $i < count($request->title) ; $i++){     
                $data=[
                    'title' => $request->title[$i],
                    'measure'=>$request->measure[$i],
                    'date'=>$request->date[$i],
                    'notes' => $request->notes[$i],
                    'patient_id' => $request->patient_id[$i],
                    'reservation_id' => $request->reservation_id[$i],
                ];
                ChronicDisease::where('id',$chronic_disease->id)->update($data);
            }
            return redirect()->route('backend.reservations.index')->with('chronic_diseases','Sales Added Successfully');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }
}
