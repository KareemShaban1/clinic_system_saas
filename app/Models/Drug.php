<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'notes',
        'reservation_id',
        'clinic_id'
    ];
    protected $table = 'drugs';
    // every drug belong to one reservation
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
