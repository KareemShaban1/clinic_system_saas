<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientOrganization extends Model
{
    use HasFactory;

    protected $table = 'patient_organization';

    protected $fillable = [
        'patient_id',
        'organization_id',
        'organization_type',
    ];
}
