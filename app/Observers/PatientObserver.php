<?php

namespace App\Observers;

use App\Models\Patient;

class PatientObserver
{
    public function creating(Patient $patient)
    {
        $patient->clinic_id = auth()->user()->clinic_id;
    }
    /**
     * Handle the Patient "created" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function created(Patient $patient)
    {
        //
    }

    /**
     * Handle the Patient "updated" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function updated(Patient $patient)
    {
        //
    }

    /**
     * Handle the Patient "deleted" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function deleted(Patient $patient)
    {
        //
    }

    /**
     * Handle the Patient "restored" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function restored(Patient $patient)
    {
        //
    }

    /**
     * Handle the Patient "force deleted" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function forceDeleted(Patient $patient)
    {
        //
    }
}
