<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Settings;
use Illuminate\Support\Facades\DB;
use PDF;
class DrugController extends Controller
{
    //

    public function add(Request $request, $id){

        // get reservation based on reservation_id
        $reservation = Reservation::findOrFail($id);

        return view('admin.drugs.add',compact('reservation'));

    }

    public function store(Request $request){

        $request->validate([
            '' => 'required',
            '' => '',
            ''=>'',
            ''=>'',
            ''=>'',
            ''=>'',
            ''=>'',
            ]);

        try{

            $drug_name = $request->drug_name;
            $drug_dose = $request->drug_dose;
            $quantity = $request->quantity;
            $notes = $request->notes;
            $reservation_id = $request->reservation_id;


            for($i = 0; $i < count($drug_name) ; $i++){     
                $data=[
                    'drug_name' => $drug_name[$i],
                    'drug_dose' => $drug_dose[$i],
                    'quantity' => $quantity[$i],
                    'notes' => $notes[$i],
                    'reservation_id' => $reservation_id[$i],
                ];
                DB::table('drugs')->insert($data);
            }
            return redirect()->route('admin.reservations.today')->with('success','Sales Added Successfully');

        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }

    public function show(Request $request,$id){

        

        // get reservation based on reservation_id
        $reservation = Reservation::findOrFail($id);

        // get drugs based on reservation_id
        $drugs = DB::table('drugs')->where('reservation_id',$id)->get();


        return view('admin.drugs.show',compact('drugs','reservation'));

    }

    public function drug_pdf($id){

               

        // get reservation based on reservation_id
        $reservation = Reservation::findOrFail($id);

        // get drugs based on reservation_id
        $drugs = DB::table('drugs')->where('reservation_id',$id)->get();

        $doctor_name = Settings::where('key','doctor_name')->value('value');
        // dd($doctor_name);

        $collection = Settings::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
            
        });



        $data= [];
        $data['reservation']= $reservation;
        $data['drugs']= $drugs;
        $data['settings']=$setting['setting'];
        $data['doctor_name'] = $doctor_name;

        $pdf = PDF::loadView('admin.drugs.drug_pdf',$data);
        return $pdf->stream( $reservation->patient->name .'.pdf');


        // return view('admin.drugs.drug_pdf',compact('drugs','reservation'));

    }
}
