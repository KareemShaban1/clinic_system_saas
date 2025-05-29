<?php

namespace App\Http\Resources\Reservation;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReservationCollection extends ResourceCollection
{
    private bool $withFullData = true;

    public function withFullData(bool $withFullData): self
    {
        $this->withFullData = $withFullData;

        return $this;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request): array
    {
        return $this->collection
            ->map->withFullData($this->withFullData)
            ->map->toArray($request)
            ->all();
    }
}
