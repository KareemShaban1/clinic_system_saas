<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class ChronicDisease extends Model
{
    use HasFactory;

    protected $fillable = ['name','measure','date','notes','patient_id','reservation_id','clinic_id'];

    public function reservation()
    {
        return $this->belongsTo(
            Reservation::class,
            'id',
            'id'
        );
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
