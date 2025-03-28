<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineReservation extends Model
{
    use HasFactory;

    public $fillable= [
        'clinic_id',
        'integration',
        'created_by',
        'patient_id',
        'meeting_id',
        'topic',
        'start_at',
        'duration',
        'password',
        'start_url',
        'join_url'];


    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function patient()
    {
        return $this->belongsTo( Patient::class);
    }

    public function reservation()
    {
        return $this->belongsTo(
            Reservation::class,
            'id',
        );
    }

}
