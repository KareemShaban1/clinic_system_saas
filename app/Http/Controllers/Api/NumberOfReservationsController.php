<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NumberOfReservationsResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\NumberOfReservations;
use Illuminate\Http\Request;

class NumberOfReservationsController extends Controller
{
    //
    use ApiResponseTrait;

    public function index()
    {
        $number_of_reservations = NumberOfReservationsResource::collection(NumberOfReservations::get());
        return $this->apiResponse($number_of_reservations, 'All Number Of Reservations', 200);

    }

    public function show($id)
    {
        $number_of_reservation = new NumberOfReservationsResource(NumberOfReservations::findOrFail($id));
        return $this->apiResponse($number_of_reservation, 'Number Of Reservations', 200);

    }

    public function store(Request $request)
    {
        $request->validate([
            'reservation_date' => 'required',
            'num_of_reservations' => 'required|integer',
            ], [
                'num_of_reservations.unique' => 'عدد الحجوزات موجود بالنسبة لليوم'
            ]);


        $number_of_reservation = new NumberOfReservationsResource(NumberOfReservations::create($request->all()));

        return $this->apiResponse(
            $number_of_reservation,
            'Number Of Reservation Created Successfully',
            200
        );


    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'reservation_date' => 'required',
            'num_of_reservations' => 'required|integer',
        ], [
            'num_of_reservations.required' => 'عدد الحجوزات مطلوب',
            'num_of_reservations.integer' => 'عدد الحجوزات يجب أن يكون عددًا صحيحًا',
        ]);

        $number_of_reservation = NumberOfReservations::findOrFail($id);
        $number_of_reservation->update($request->all());

        $number_of_reservation_resource = new NumberOfReservationsResource($number_of_reservation);

        return $this->apiResponse(
            $number_of_reservation_resource,
            'Number Of Reservation Updated Successfully',
            200
        );
    }

    public function delete($id)
    {
        $number_of_reservation = NumberOfReservations::findOrFail($id);
        $number_of_reservation->delete();
        return $this->apiResponse(
            $number_of_reservation,
            'Number Of Reservation Deleted Successfully',
            200
        );
    }
}
