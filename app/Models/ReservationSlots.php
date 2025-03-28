<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationSlots extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_id',
        'date',
        'start_time',
        'end_time',
        'duration',
        'total_reservations'
    ];

    public function clinic()
    {
        return $this->belongsTo(
            Clinic::class,
            'clinic_id',
            'id',
        );
    }
}
