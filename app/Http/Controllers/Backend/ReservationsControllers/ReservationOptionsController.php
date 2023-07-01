<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Events\AppointmentApproved;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationOptionsController extends Controller
{
    //
    protected $reservation;

    public function __construct(Reservation $reservation) {
        $this->reservation = $reservation;
    }

    public function reservationStatus($id, $res_status)
    {
        $reservation = $this->reservation->findOrFail($id);
        $reservation->res_status = $res_status;
        $reservation->save();

        return redirect()->route('backend.reservations.index');
    }

    public function ReservationAcceptance($id, $acceptance)
    {
        $reservation = $this->reservation->findOrFail($id);
        $reservation->acceptance = $acceptance;
        event(new AppointmentApproved($reservation));
        $reservation->save();

        

        return redirect()->route('backend.reservations.index');
    }


    public function paymentStatus($id, $payment)
    {
        $reservation = $this->reservation->findOrFail($id);
        $reservation->payment = $payment;
        $reservation->save();

        return redirect()->route('backend.reservations.index');
    }
} 
