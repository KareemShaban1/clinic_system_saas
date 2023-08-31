<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreReservationRequest;
use App\Http\Requests\Api\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Reservation;

class ReservationController extends Controller
{
    //
    use ApiResponseTrait;
    public function index()
    {

        // بتحولها بشكل أتوماتيك laravel ال  json response ل model مش محتاج أحول ال

        $reservations = ReservationResource::collection(Reservation::get());

        return $this->apiResponse($reservations, 'All Reservations', 200);

        // return Reservation::all();

    }

    public function show($id)
    {
        $reservation = Reservation::find($id);
        if($reservation) {

            return $this->apiResponse(new ReservationResource($reservation), 'Show Reservation', 200);
        }
        return $this->apiResponse(null, 'Reservation Not Found', 401);
    }

    public function store(StoreReservationRequest $request)
    {

        $request->validated();

        $data = $request->all();
        $data['month'] = substr($request->res_date, 5, 7 - 5);
        $reservation = new ReservationResource(Reservation::create($data));

        return $this->apiResponse($reservation, 'Reservation Created Successfully', 200);



    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {

        $request->validated();
        $data = $request->all();
        $data['month'] = substr($request->res_date, 5, 7 - 5);
        if(!$reservation) {
            return response()->json(['status' => 'Reservation Not Found'], 404);
        }
        $reservation->update($data);

        return new ReservationResource($reservation);
    }

    public function delete($id)
    {

        $reservation = Reservation::find($id);

        if(!$reservation) {
            return response()->json(['status' => 'Not Found'], 404);
        }

        $reservation->delete();
        return response()->json(['status' => 'deleted'], 200);
    }

    public function restore($id)
    {
        $reservation = Reservation::onlyTrashed()->find($id);

        if(!$reservation) {
            return response()->json(['status' => 'Not Found'], 404);
        }

        $reservation->restore();

        return response()->json(['status' => 'restored'], 200);

    }

    public function forceDelete($id)
    {
        $reservation = Reservation::onlyTrashed()->find($id);
        if(!$reservation) {
            return response()->json(['status' => 'Not Found'], 404);
        }

        $reservation->forceDelete();

        return response()->json(['status' => 'deleted forever'], 200);

    }
}
