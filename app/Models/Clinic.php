<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;


class Clinic extends Model
{
    use HasFactory, HasDatabase, HasDomains;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'description',
        'logo',
        'status',
        'governorate_id',
        'city_id',
        'area_id',
        'website',
        'domain',
        'database',
        'start_date',
        'speciality_id'
    ];
    
    public function doctors(){
        return $this->hasMany(Doctor::class);
    }

    public function patients(){

        return $this->belongsToMany(
            Patient::class,
            'patient_clinic',
            'clinic_id',
            'patient_id',
        );

    }

    public function users()
    {
        return $this->morphMany(User::class, 'organization');
    }

    public function governorate(){
        return $this->belongsTo(Governorate::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function speciality(){
        return $this->belongsTo(Speciality::class);
    }


}
