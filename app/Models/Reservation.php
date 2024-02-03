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

    protected $hidden = [
        'created_at','updated_at','deleted_at'

    ];

    protected $fillable = [

        'patient_id',
        'res_num',
        'first_diagnosis',
        'res_type',
        'cost',
        'payment',
        'res_date',
        'res_status',
        'acceptance',
        'month',
        'slot'
    ];


    // Inverse of one-to-many (One Reservation belongs to one Patient)
    // belongTo() come with one to one relationship
    // every reservation belong to one patient
    public function patient()
    {
        return $this->belongsTo(
            Patient::class,
            'patient_id',
        );
    }

    public function rays()
    {
        return $this->hasMany(
            Ray::class,
            'reservation_id',
        );
    }

    public function medicalAnalysis()
    {
        return $this->hasMany(
            MedicalAnalysis::class,
            'reservation_id',
        );
    }

    public function chronicDisease()
    {
        return $this->hasMany(
            ChronicDisease::class,
            'reservation_id',
        );
    }

    public function glassesDistance()
    {
        return $this->hasMany(
            GlassesDistance::class,
            'reservation_id',
        );
    }

    public function prescription()
    {
        return $this->hasMany(
            Prescription::class,
            'reservation_id',
        );
    }





}
