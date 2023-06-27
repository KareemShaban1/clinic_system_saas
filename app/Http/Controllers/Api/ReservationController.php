<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreReservationRequest;
use App\Http\Requests\Api\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReservationController extends Controller
{
    //
    public function index()
    {

        // بتحولها بشكل أتوماتيك laravel ال  json response ل model مش محتاج أحول ال

        $reservations = Reservation::all();
        return  ReservationResource::collection($reservations);

        // return Reservation::all();

    }

    public function show(Reservation $reservation)
    {

        return new ReservationResource($reservation);

        // return Reservation::find($id) ?? response()->json(['status'=>'Not found'], 404);

    }

    public function store(StoreReservationRequest $request)
    {

        $request->validated();

        $data = $request->all();
        $data['month'] = substr($request->res_date, 5, 7 - 5);

        return $data;
        // $reservation = Reservation::create($data);
        // return $reservation;
        // return new ReservationResource($reservation);

    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {

        $request->validated();
        $data = $request->all();
        $data['month'] = substr($request->res_date, 5, 7 - 5);
        if(!$reservation) {
            return response()->json(['status'=>'Reservation Not Found'], 404);
        }
        $reservation->update($data);

        return new ReservationResource($reservation);
    }

public function delete($id)
{

    $patient = Reservation::find($id);

    if(!$patient) {
        return response()->json(['status'=>'Not Found'], 404);
    }

    $patient->delete();
    return response()->json(['status'=>'deleted'], 200);
}

public function restore($id)
{
    $patient = Reservation::onlyTrashed()->find($id);

    if(!$patient) {
        return response()->json(['status'=>'Not Found'], 404);
    }

    $patient->restore();

    return response()->json(['status'=>'restored'], 200);

}

public function forceDelete($id)
{
    $patient = Reservation::onlyTrashed()->find($id);
    if(!$patient) {
        return response()->json(['status'=>'Not Found'], 404);
    }

    $patient->forceDelete();

    return response()->json(['status'=>'deleted forever'], 200);

}
}
