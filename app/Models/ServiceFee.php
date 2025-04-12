<?php

namespace App\Models;

use App\Models\Scopes\ClinicScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_name',
        'clinic_id',
        'fee',
        'notes'
    ];


    protected static function booted()
    {

        static::addGlobalScope(new ClinicScope);

    }



    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
