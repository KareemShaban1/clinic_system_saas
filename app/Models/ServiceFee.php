<?php

namespace App\Models;

use App\Models\Scopes\ClinicScope;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'service_name',
        'organization_id',
        'organization_type',
        'fee',
        'notes'
    ];


    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);

    }


    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
