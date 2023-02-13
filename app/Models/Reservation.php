<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'reservations';
    
    protected $primaryKey = 'reservation_id';   

    protected $fillable = [
        
        'patient_id',
        'res_num',
        'first_diagnosis',
        'res_type',
        'cost',
        'payment',
        'res_date',
        'status',
    ];
    

    // Inverse of one-to-many (One Resrvation belongs to one Patient)
    // belongTo() come with one to one relationship 
    // every reservation belong to one patient 
    public function patient()
    {
        return $this->belongsTo(
            Patient::class,
            'patient_id',
        );
    }

   

}
