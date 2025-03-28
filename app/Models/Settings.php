<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    use HasFactory;

    public $table = 'settings';
    protected $fillable = [
        'clinic_id',
        'key',
        'value',
        'type',
    ];

    public function clinic()
    {
        return $this->belongsTo(
            Clinic::class,
            'clinic_id',
            'id',
        );
    }

}
