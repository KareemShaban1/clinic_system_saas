<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
class MedicalAnalysisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return [
        //     'Patient Id' => $this->id,
        //     'Reservation Id' => $this->id,
        //     'Analysis Name' => $this->analysis_name,
        //     'Images' =>  $this->image_url,
        //     'Analysis Date' => $this->analysis_date,
        //     'Analysis type' => $this->analysis_type,
        //     'Report' => $this->report,
        // ];

        // Assuming $analysis is your model instance
        $images = explode('|', $this->images);
        $imageUrls = [];

        foreach ($images as $image) {
            if (Str::startsWith($image, ['http://', 'https://'])) {
                $imageUrls[] = $image;
            } else {
                $imageUrls[] = asset('storage/medical_analysis/' . $image);
            }
        }

        $response = [
            'Patient Id' => $this->id,
            'Reservation Id' => $this->id,
            'Analysis Name' => $this->analysis_name,
            'Images' => $imageUrls,
            'Analysis Date' => $this->analysis_date,
            'Analysis type' => $this->analysis_type,
            'Report' => $this->report,
        ];

        return $response;
    }
}