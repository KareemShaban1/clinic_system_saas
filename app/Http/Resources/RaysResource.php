<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
class RaysResource extends JsonResource
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
        //     'Patient Id' => $this->patient_id,
        //     'Reservation Id' => $this->reservation_id,
        //     'Ray Name' => $this->ray_name,
        //     'Images' =>  $this->images,
        //     'Ray Date' => $this->ray_date,
        //     'ray_type' => $this->ray_type,
        //     'notes' => $this->notes,
        // ];

        $images = explode('|', $this->images);
        $imageUrls = [];

        foreach ($images as $image) {
            if (Str::startsWith($image, ['http://', 'https://'])) {
                $imageUrls[] = $image;
            } else {
                $imageUrls[] = asset('storage/rays/' . $image);
            }
        }

        $response = [
            'Patient Id' => $this->patient_id,
            'Reservation Id' => $this->reservation_id,
            'Ray Name' => $this->ray_name,
            'Images' =>  $imageUrls,
            'Ray Date' => $this->ray_date,
            'ray_type' => $this->ray_type,
            'notes' => $this->notes,
        ];

        return $response;
    }
}