<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'patient_id'=>$this->patient_id,
            'patient_name' => $this->name,
            'age'=>$this->age,
            'address'=>$this->address,
            'phone'=>$this->phone,
            'blood_group'=>$this->blood_group,
            'patient_code'=>$this->patient_code,
            'gender'=>$this->gender
            
        ];
    }
}
