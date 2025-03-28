<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class MedicalAnalysis extends Model
{
    use HasFactory;

    public $table = 'medical_analysis';

    protected $fillable = [
        'name','images','date','type','report','patient_id','reservation_id','clinic_id'
    ];

    
    public function getImageUrlAttribute()
    {
        if (!$this->images) {
            return 'https://scotturb.com/wp-content/uploads/2016/11/product-placeholder-300x300.jpg';
        }
        if (Str::startsWith($this->images, ['http://', 'https://'])) {
            return $this->images;
        }
        return asset('storage/medical_analysis/' . $this->images);
    } // $analysis->image_url


    public function patient()
    {
        return $this->belongsTo( Patient::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }


    
}