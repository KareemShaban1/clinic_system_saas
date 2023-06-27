<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            'patient_name'=>$this->patient->name,
            'reservation_number'=>$this->res_num,
            'first_diagnosis'=>$this->first_diagnosis,
            'reservation_type'=>$this->res_type,
            'cost'=>$this->cost,
            'payment'=>$this->payment,
            'reservation_date'=>$this->res_date,
            'reservation_status'=>$this->res_status,
            'status'=>$this->status,
        ];
    }
}
