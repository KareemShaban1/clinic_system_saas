<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\Reservation\ReservationCollection;
use App\Http\Resources\Reservation\ReservationResource as ReservationReservationResource;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use App\Traits\ApiHelperTrait;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    //

    use ApiHelperTrait;
    
    public function index(Request $request)
    {
        $reservations = Reservation::with('serviceFees')->patient()->get();

        $reservationCollection = (new ReservationCollection($reservations))->withFullData(!($request->full_data == 'false'));

        return $this->returnJSON($reservationCollection, 'All Reservations', true);

        
    }

    public function show(Request $request, $id)
    {
        $reservation = Reservation::with('serviceFees')->patient()->findOrFail($id);

        $reservationResource = (new ReservationReservationResource($reservation))->withFullData(!($request->full_data == 'false'));

        return $this->returnJSON($reservationResource, 'Reservation', true);
    }


}
