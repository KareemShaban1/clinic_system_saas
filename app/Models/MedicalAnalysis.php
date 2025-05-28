<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MedicalAnalysis extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;



    public $table = 'medical_analysis';

    protected $fillable = [
        'name',
        'date',
        'type_id',
        'report',
        'patient_id',
        'reservation_id',
        'clinic_id'
    ];


    // public function getImageUrlAttribute()
    // {
    //     if (!$this->images) {
    //         return 'https://scotturb.com/wp-content/uploads/2016/11/product-placeholder-300x300.jpg';
    //     }
    //     if (Str::startsWith($this->images, ['http://', 'https://'])) {
    //         return $this->images;
    //     }
    //     return asset('storage/medical_analysis/' . $this->images);
    // } // $analysis->image_url


    public function getImagesAttribute()
    {
        return $this->getMedia('analysis_images')->map(function ($media) {
            return $media->getUrl();
        })->toArray();
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function serviceFees()
    {
        return $this->morphMany(ModuleServiceFee::class, 'module')->with('service');
    }
    
}
