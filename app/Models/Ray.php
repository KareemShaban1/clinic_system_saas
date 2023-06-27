<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ray extends Model
{
    use HasFactory;
    protected $fillable=[
        'image',
        'patient_id',
        'reservation_id',
        'ray_name',
        'ray_type',
        'ray_date',
        'notes'
    ];

    // Acessories definition =>  public function get...Attribute(){}

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://scotturb.com/wp-content/uploads/2016/11/product-placeholder-300x300.jpg';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    } // $ray->image_url


    public function patient()
    {
        return $this->belongsTo(
            Patient::class,
            'patient_id',
        );
    }

    

    
}
