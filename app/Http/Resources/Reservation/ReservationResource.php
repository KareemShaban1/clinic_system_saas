<?php

namespace App\Http\Resources\Reservation;

use App\Http\Resources\ChronicDisease\ChronicDiseaseCollection;
use App\Http\Resources\Patient\PatientResource;
use App\Http\Resources\ServiceFee\ServiceFeeCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            'patient' => (new PatientResource($this->patient))->withFullData($this->withFullData),
            // 'service_fees' => $this->serviceFees,
            'service_fees'=>(new ServiceFeeCollection($this->serviceFees))->withFullData($this->withFullData),
            

            $this->mergeWhen(
                $this->withFullData,
                function () {
                    return [
                        // 'clinic' => $this->clinic,
                        'chronic_diseases' => (new ChronicDiseaseCollection($this->chronicDisease))->withFullData($this->withFullData),
                        'rays' => $this->rays,
                        'medical_analysis' => $this->medicalAnalysis,
                        'drugs' => $this->drugs,
                        'glasses_distance' => $this->glassesDistance,
                        'prescription' => $this->prescription,
                        'first_diagnosis' => $this->first_diagnosis,
                        'final_diagnosis' => $this->final_diagnosis,
                        'reservation_status' => $this->status,
                        'acceptance' => $this->acceptance,
                    ];
                }
            ),
            'reservation_number' => $this->reservation_number,
            'date' => $this->date,
            'reservation_type' => $this->type,
            'cost' => $this->cost,
            'payment' => $this->payment,

        ];
    }
}
