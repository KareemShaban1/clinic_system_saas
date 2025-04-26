<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ray extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'images',
        'patient_id',
        'reservation_id',
        'clinic_id',
        'name',
        'ray_type_id',
        'date',
        'report'
    ];

    // Accessories definition =>  public function get...Attribute(){}

    // public function getImageUrlAttribute()
    // {
    //     if (!$this->images) {
    //         return 'https://scotturb.com/wp-content/uploads/2016/11/product-placeholder-300x300.jpg';
    //     }
    //     if (Str::startsWith($this->images, ['http://', 'https://'])) {
    //         return $this->images;
    //     }
    //     return asset('storage/rays/' . $this->images);
    // } // $ray->image_url

    public function getImagesAttribute()
    {
        return $this->getMedia('rays_images')->map(function ($media) {
            return $media->getUrl();
        })->toArray();
    }


    public function patient()
    {
        return $this->belongsTo(
            Patient::class,
            'patient_id',
        );
    }


    public function reservation()
    {
        return $this->belongsTo(
            Reservation::class,
            'reservation_id',
        );
    }

    public function clinic()
    {
        return $this->belongsTo(
            Clinic::class,
            'clinic_id',
        );
    }

    public function type()
    {
        return $this->belongsTo(
            Type::class,
            'ray_type_id',
        );
    }


}