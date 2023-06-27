<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
class ChronicDisease extends Model
{
    use HasFactory;

    protected $fillable = ['reservation_id'];

    public function reservation()
    {
        return $this->belongsTo(
            Reservation::class,
            'reservation_id',
            'reservation_id'
        );
    }
}
