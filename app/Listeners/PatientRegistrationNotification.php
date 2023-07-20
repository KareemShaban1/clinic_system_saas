<?php

namespace App\Listeners;

use App\Events\PatientRegistration;
use App\Models\User;
use App\Notifications\PatientRegisteredNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class PatientRegistrationNotification
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
    public function handle(PatientRegistration $event)
    {
        //
        $patient = $event->patient;
        $users = User::all();
        // send notifications to all admins
        Notification::send($users, new PatientRegisteredNotification($patient));
    }
}
