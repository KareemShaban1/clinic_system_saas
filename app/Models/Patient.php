<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Patient extends User
{
    use HasFactory ;
    use Notifiable  ;
    use HasRoles ;
    use SoftDeletes;

    protected $table = 'patients';

    protected $primaryKey = 'patient_id';

    public $timestamps = true;

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
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
        // 'image'
    ];

    protected static function booted()
    {

        // while creating order make order number take next available number
        static::creating(function (Patient $patient) {
            //20230001 - 20230002
            $patient->patient_code = Patient::getNextPatientCodeNumber();
        });
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

    public function reservations()
    {
        // $this refer to patient object
        // One-to-Many (One patient has many reservations)
        return $this->hasMany(
            Reservation::class, // Related model
            'patient_id',           // FK in the related model
            'patient_id'            // PK in the current model
        );
    }

    public function ray()
    {
        return $this->belongsTo(
            Ray::class,
            'patient_id',
        );
    }

}
