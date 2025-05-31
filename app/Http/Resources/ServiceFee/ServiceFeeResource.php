<?php

namespace App\Http\Resources\ServiceFee;

use App\Http\Resources\Patient\PatientResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceFeeResource extends JsonResource
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
            
            'service_name' => $this->service->service_name,
            'fee' => $this->fee,
            'notes' => $this->notes,

            $this->mergeWhen(
                $this->withFullData,
                function () {
                    return [
                       
                    ];
                }
            ),
          

        ];
    }
}
