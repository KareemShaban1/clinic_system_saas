<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends BaseModel
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'events';

    protected $fillable = [
        'clinic_id',
        'title',
        'date',
    ];


    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
