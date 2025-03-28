<?php
namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class ClinicScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // Fetch authenticated user **before applying the scope**
        $user = Auth::user();

        // Prevent infinite loop by checking if user exists
        if ($user && !app()->runningInConsole()) { 
            $clinicId = $user->clinic_id;

            // Only apply scope if the user has a clinic_id
            if ($clinicId) {
                $builder->where('clinic_id', $clinicId);
            }
        }
    }
}
