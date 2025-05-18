<?php

namespace App\Models;

use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'organization_id',
        'organization_type',
    ];


    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }
}
