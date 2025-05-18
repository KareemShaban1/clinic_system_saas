<?php

namespace App\Models;

use App\Models\Scopes\ClinicScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;

class Patient extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SoftDeletes;

    protected $table = 'patients';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'name',
        'age',
        'address',
        'email',
        'password',
        'phone',
        'blood_group',
        'patient_code',
        'gender',
        // 'clinic_id',
        'height',
        'weight',
        // 'image'
    ];

    protected static function booted()
    {

        // while creating order make order number take next available number
        static::creating(function (Patient $patient) {
            //20230001 - 20230002
            $patient->patient_code = Patient::getNextPatientCodeNumber();
        });

        // static::addGlobalScope(new ClinicScope);
    }

    public static function getNextPatientCodeNumber()
    {
        // SELECT MAX(number) FROM patients
        $year = Carbon::now()->year;
        $number = Patient::whereYear('created_at', $year)->max('patient_code');


        // if there is number in this year add 1 to this number
        if ($number) {
            return $number + 1;
        }
        // if not return 0001
        return $year . '0001';
    }

    // Apply the clinic filter dynamically
    // public function scopeClinic($query)
    // {
    //     if (Auth::check() && Auth::user()->clinic_id) {
    //         return $query->where('clinic_id', Auth::user()->clinic_id);
    //     }

    //     return $query;
    // }

    public function reservations()
    {
        // $this refer to patient object
        // One-to-Many (One patient has many reservations)
        return $this->hasMany(Reservation::class, 'patient_id', 'id');
    }

    public function rays()
    {
        return $this->hasMany(
            Ray::class,
            'patient_id',
            'id',
        );
    }

    public function glassesDistance()
    {
        return $this->hasMany(
            GlassesDistance::class,
            'patient_id',
            'id',
        );
    }

    public function medicalAnalysis()
    {
        return $this->hasMany(
            MedicalAnalysis::class,
            'patient_id',
            'id',
        );
    }

    public function chronicDisease()
    {
        return $this->hasMany(
            ChronicDisease::class,
            'patient_id',
            'id',
        );
    }

    public function prescription()
    {
        return $this->hasMany(
            Prescription::class,
            'patient_id',
            'id',
        );
    }

    public function onlineReservations()
    {
        return $this->hasMany(
            OnlineReservation::class,
            'patient_id',
            'id',
        );
    }

    public function clinic()
    {
        return $this->belongsToMany(
            Clinic::class,
            'patient_clinic',
            'patient_id',
            'clinic_id',
        );
    }

    // public function medicalLaboratory()
    // {
    //     return $this->belongsToMany(
    //         PatientOrganization::class,
    //         'patient_organization',
    //         'patient_id',
    //         'organization_id',
    //     );
    // }

    public function medicalLaboratories()
{
    return $this->morphedByMany(
        MedicalLaboratory::class,
        'organization',
        'patient_organization',
        'patient_id',
        'organization_id'
    );
}


    public function radiologyCenter()
    {
        return $this->belongsToMany(
            RadiologyCenter::class,
            'patient_radiology_center',
            'patient_id',
            'radiology_center_id',
        );
    }

    public function scopeClinic($query)
    {
        return $query->whereHas('clinic', function ($query) {
            $query->where('clinic_id', Auth::user()->clinic_id);
        });
    }

    // public function scopeMedicalLaboratory($query)
    // {
    //     return $query->whereHas('medicalLaboratory', function ($query) {
    //         $query->where('organization_id', Auth::user()->organization_id);
    //     });
    // }


    public function scopeMedicalLaboratory($query)
{
    return $query->whereHas('medicalLaboratories', function ($q) {
        $q->where('organization_id', Auth::user()->organization_id);
    });
}

    public function scopeRadiologyCenter($query)
    {
        return $query->whereHas('radiologyCenter', function ($query) {
            $query->where('radiology_center_id', Auth::user()->radiology_center_id);
        });
    }

    public function organization()
    {
        return $this->morphTo();
    }



}
