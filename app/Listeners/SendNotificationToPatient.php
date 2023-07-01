<?php

namespace App\Listeners;

use App\Events\AppointmentApproved;
use App\Models\Patient;
use App\Notifications\AppointmentApprovedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationToPatient
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
    public function handle(AppointmentApproved $event)
    {
        //
        $reservation = $event->reservation;
        $patient = Patient::findOrFail($reservation->patient_id);
        if($patient){
            $patient->notify(new AppointmentApprovedNotification($reservation));
        }
    }
}
