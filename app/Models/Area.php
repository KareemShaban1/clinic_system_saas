<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'city_id',
        'governorate_id',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }
    

}
