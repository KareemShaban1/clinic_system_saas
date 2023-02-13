<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;

    protected $fillable = [
        'drug_name',
        'drug_dose',
        'quantity',
        'notes',
        'reservation_id'
    ];


    // every drug belong to one reservation
    public function reservation ()
    {
        return $this->belongsTo(
            Reservation::class,
            'reservation_id',
            'reservation_id'
        );
    }

    
}
