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
        // Fetch authenticated user before applying the scope
        $user = Auth::user();

        if ($user && !app()->runningInConsole()) {
            // Check if user is authenticated and belongs to a Clinic
            if ($user->organization_type === \App\Models\Clinic::class) {
                $clinicId = $user->organization_id;

                if ($clinicId) {
                    // Apply the scope: filter by the user's clinic
                    $builder->where('clinic_id', $clinicId);
                }
            }
        }
    }
}
