<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','title','images','notes','reservation_id','patient_id','clinic_id'
    ];
    protected $table = 'prescriptions';

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
}
