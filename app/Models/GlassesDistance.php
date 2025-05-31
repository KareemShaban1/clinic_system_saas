<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlassesDistance extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'reservation_id',
        'patient_id',
        'clinic_id',
    ];
    
    protected $fillable = [
        'id',
        'patient_id',
        'reservation_id',
        'clinic_id',
        'SPH_R_D',
        'CYL_R_D',
        'AX_R_D',
        'SPH_L_D',
        'CYL_L_D',
        'AX_L_D',
        'SPH_R_N',
        'CYL_R_N',
        'AX_R_N',
        'SPH_L_N',
        'CYL_L_N',
        'AX_L_N'
    ];
}
