<?php

namespace App\Listeners;

use App\Events\PatientMakeAppointment;
use App\Models\User;
use App\Notifications\MakeAppointmentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendMakeAppointmentNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PatientMakeAppointment $event)
    {
        //
        $reservation = $event->reservation;
        $users = User::all();
        // send notifications to all admins
        Notification::send($users, new MakeAppointmentNotification($reservation));
    }
}
