<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Prescription extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'id','title','images','notes','reservation_id','patient_id','clinic_id'
    ];
    protected $table = 'prescriptions';

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
    public function getImagesAttribute()
    {
        return $this->getMedia('prescription_images')->map(function ($media) {
            return $media->getUrl();
        })->toArray();
    }
}
