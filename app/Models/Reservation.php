<?php

namespace App\Models;

use App\Models\Scopes\ClinicScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'reservations';

    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at','updated_at','deleted_at'

    ];

    protected $fillable = [
        'patient_id',
        'clinic_id',
        'reservation_number',
        'first_diagnosis',
        'type',
        'cost',
        'payment',
        'date',
        'status',
        'acceptance',
        'month',
        'slot'
    ];

    protected static function booted()
    {


        static::addGlobalScope(new ClinicScope);

    }

    // Inverse of one-to-many (One Reservation belongs to one Patient)
    // belongTo() come with one to one relationship
    // every reservation belong to one patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function rays()
    {
        return $this->hasMany(
            Ray::class,
            'reservation_id',
            'id'
        );
    }

    public function medicalAnalysis()
    {
        return $this->hasMany(
            MedicalAnalysis::class,
            'reservation_id',
            'id'
        );
    }

    public function chronicDisease()
    {
        return $this->hasMany(
            ChronicDisease::class,
            'reservation_id',
            'id',
        );
    }

    public function glassesDistance()
    {
        return $this->hasMany(
            GlassesDistance::class,
            'reservation_id',
            'id',
        );
    }

    public function prescription()
    {
        return $this->hasMany(
            Prescription::class,
            'reservation_id',
            'id',
        );
    }

    public function clinic()
    {
        return $this->belongsTo(
            Clinic::class,
            'clinic_id',
            'id',
        );
    }





}
