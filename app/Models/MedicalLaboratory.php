<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalLaboratory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'address',
        'phone',
        'email',
        'governorate_id',
        'city_id',
        'area_id',
        'website',
        'domain',
        'database',
        'description',
        'logo',
        'status',
    ];

    public function governorate(){
        return $this->belongsTo(Governorate::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function users()
    {
        return $this->morphMany(User::class, 'organization');
    }
}
