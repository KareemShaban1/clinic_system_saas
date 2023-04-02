<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ray extends Model
{
    use HasFactory;
    protected $fillable=[
        'image'
    ];

    public function patient()
    {
        return $this->belongsTo(
            Patient::class,
            'patient_id',
        );
    }

    
}
