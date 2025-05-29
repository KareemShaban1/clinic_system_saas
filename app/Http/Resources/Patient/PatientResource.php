<?php

namespace App\Http\Resources\Patient;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    private bool $withFullData = true;

    public function withFullData(bool $withFullData): self
    {
        $this->withFullData = $withFullData;

        return $this;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name' => $this->name,
            $this->mergeWhen(
                $this->withFullData,
                function () {
                    return [
                        'age'=>$this->age,
                        'address'=>$this->address,
                        'blood_group'=>$this->blood_group,
                        'gender'=>$this->gender,
                        'whatsapp_number'=>$this->whatsapp_number,
                        'email'=>$this->email,
                    ];
                }
            ),
            'phone'=>$this->phone,
            'patient_code'=>$this->patient_code,
            
        ];
    }
}
