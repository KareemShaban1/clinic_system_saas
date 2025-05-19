<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class OrganizationScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        
        if (Auth::check()) {
            $user = Auth::user();

            $builder->where('organization_type', $user->organization_type)
                    ->where('organization_id', $user->organization_id);
        }
    }
}

