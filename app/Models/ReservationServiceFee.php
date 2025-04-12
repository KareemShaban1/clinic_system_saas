<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationServiceFee extends Model
{
    use HasFactory;

    protected $table = 'reservation_service_fee';

    protected $fillable = [
        'reservation_id',
        'service_fee_id',
        'fee',
        'notes'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function serviceFee()
    {
        return $this->belongsTo(ServiceFee::class);
    }
}
