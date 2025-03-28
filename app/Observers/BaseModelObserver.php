<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class BaseModelObserver
{
    public function creating(Model $model)
    {
        // Example: Automatically add the authenticated user's clinic_id
        if (auth()->check() && $model->isFillable('clinic_id')) {
            $model->clinic_id = auth()->user()->clinic_id;
        }
    }

    public function updating(Model $model)
    {
        
    }
}
