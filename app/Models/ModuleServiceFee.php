<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ModuleServiceFee extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'module_service_fees';

    protected $fillable = [
        'module_id',
        'module_type',
        'service_fee_id',
        'fee',
        'notes',
    ];

    public function getImagesAttribute()
    {
        return $this->getMedia('service_fee_images')->map(function ($media) {
            return $media->getUrl();
        })->toArray();
    }

    public function service()
    {
        return $this->belongsTo(ServiceFee::class , 'service_fee_id' , 'id');
    }

    public function module()
    {
        return $this->morphTo();
    }
}
