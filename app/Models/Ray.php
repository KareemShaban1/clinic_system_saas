<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ray extends Model
{
    use HasFactory;

    protected $fillable = [
        'images',
        'patient_id',
        'reservation_id',
        'clinic_id',
        'ray_name',
        'ray_type',
        'ray_date',
        'report'
    ];

    // Accessories definition =>  public function get...Attribute(){}

    public function getImageUrlAttribute()
    {
        if (!$this->images) {
            return 'https://scotturb.com/wp-content/uploads/2016/11/product-placeholder-300x300.jpg';
        }
        if (Str::startsWith($this->images, ['http://', 'https://'])) {
            return $this->images;
        }
        return asset('storage/rays/' . $this->images);
    } // $ray->image_url


    public function patient()
    {
        return $this->belongsTo(
            Patient::class,
            'id',
        );
    }


    public function reservation()
    {
        return $this->belongsTo(
            Reservation::class,
            'id',
        );
    }

    public function clinic()
    {
        return $this->belongsTo(
            Clinic::class,
            'id',
        );
    }


}