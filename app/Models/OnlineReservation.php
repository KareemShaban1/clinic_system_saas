<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineReservation extends Model
{
    use HasFactory;

    public $fillable= ['integration','user_id','patient_id','created_by','meeting_id','topic','start_at','duration','password','start_url','join_url'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function patient()
    {
        return $this->belongsTo(
            Patient::class,
            'patient_id',
        );
    }

    public function reservation()
    {
        return $this->belongsTo(
            Reservation::class,
            'reservation_id',
        );
    }

}
