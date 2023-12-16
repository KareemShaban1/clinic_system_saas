<?php

namespace App\Http\Traits;

use App\Models\NumberOfReservations;
use App\Models\ReservationSlots;

trait SlotsNumbersCheck
{
    public function slotsCheck($reservation_date)
    {

        $slotsCount = ReservationSlots::where('date', $reservation_date)->count();

        return $slotsCount > 0;

    }
    public function reservationNumberCheck($reservation_date)
    {
        $resNumberCount = NumberOfReservations::where('reservation_date', $reservation_date)->count();


        return $resNumberCount > 0 ;
    }
}
