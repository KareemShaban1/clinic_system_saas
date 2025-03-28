<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumberOfReservations extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_id',
        'reservation_date',
        'num_of_reservations'
    ];


    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
