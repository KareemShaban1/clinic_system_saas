<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Patient extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'patients';

    protected $primaryKey = 'patient_id';

    protected $fillable = [
        'name',
        'age',
        'address',
        'email',
        'phone',
        'blood_group',
        'chronic_disease'
    ];


        public function reservations()
     {
         // $this refer to patient object 
         // One-to-Many (One patient has many reservations)
         return $this->hasMany(
            Reservation::class ,    // Related model 
            'patient_id',           // FK in the related model
            'patient_id'            // PK in the current model
         );
     }

}
