<?php

namespace App\Http\Resources\ChronicDisease;

use App\Http\Resources\Patient\PatientResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ChronicDiseaseResource extends JsonResource
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
            

            $this->mergeWhen(
                $this->withFullData,
                function () {
                    return [
                        'id' => $this->id,
                        'patient_name' => $this->patient->name,
                        'name' => $this->name,
                        'measure' => $this->measure,
                        'date' => $this->date,
                        'notes' => $this->notes,
                    ];
                }
            ),
          

        ];
    }
}
