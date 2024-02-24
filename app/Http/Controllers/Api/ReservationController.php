<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreReservationRequest;
use App\Http\Requests\Api\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\TimeSlotsTrait;
use App\Models\NumberOfReservations;
use App\Models\Reservation;
use App\Models\ReservationSlots;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    //
    use ApiResponseTrait ;
    use TimeSlotsTrait;
    public function index()
    {

        // بتحولها بشكل أتوماتيك laravel ال  json response ل model مش محتاج أحول ال

        $reservations = ReservationResource::collection(Reservation::get());

        return $this->apiResponse($reservations, 'All Reservations', 200);

        // return Reservation::all();

    }

    public function show($id)
    {
        $reservation = Reservation::find($id);
        if($reservation) {

            return $this->apiResponse(new ReservationResource($reservation), 'Show Reservation', 200);
        }
        return $this->apiResponse(null, 'Reservation Not Found', 401);
    }

    public function store(StoreReservationRequest $request)
    {

        $request->validated();

        $data = $request->all();
        $data['month'] = substr($request->res_date, 5, 7 - 5);
        $data['acceptance'] = "not_approved";


        $reservation = new ReservationResource(Reservation::create($data));

        return $this->apiResponse($reservation, 'Reservation Created Successfully', 200);



    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {

        $request->validated();
        $data = $request->all();
        $data['month'] = substr($request->res_date, 5, 7 - 5);
        if(!$reservation) {
            return response()->json(['status' => 'Reservation Not Found'], 404);
        }
        $reservation->update($data);

        return new ReservationResource($reservation);
    }

    public function delete($id)
    {

        $reservation = Reservation::find($id);

        if(!$reservation) {
            return response()->json(['status' => 'Not Found'], 404);
        }

        $reservation->delete();
        return response()->json(['status' => 'deleted'], 200);
    }

    public function restore($id)
    {
        $reservation = Reservation::onlyTrashed()->find($id);

        if(!$reservation) {
            return response()->json(['status' => 'Not Found'], 404);
        }

        $reservation->restore();

        return response()->json(['status' => 'restored'], 200);

    }

    public function forceDelete($id)
    {
        $reservation = Reservation::onlyTrashed()->find($id);
        if(!$reservation) {
            return response()->json(['status' => 'Not Found'], 404);
        }

        $reservation->forceDelete();

        return response()->json(['status' => 'deleted forever'], 200);

    }

    public function todayReservations()
    {
        $today_reservations = ReservationResource::collection(Reservation::whereDate('res_date', Carbon::now())->get());

        return $this->apiResponse($today_reservations, 'Today Reservations', 200);

    }

    // public function getResNumberOrSlotAdd(Request $request)
    // {

    //     $res_date =  $request->res_date;

    //     // if system use reservation numbers not slots
    //     $reservation_res_num = Reservation::where('res_date', $res_date)->pluck('res_num')->map(function ($item) {
    //         return intval($item);
    //     })->toArray();
    //     $number_of_res = NumberOfReservations::where('reservation_date', $res_date)->value('num_of_reservations');


    //     // if system use reservation slots not numbers
    //     $reservation_slots = Reservation::where('res_date', $res_date)
    //     ->where('slot', '<>', 'null')->pluck('slot')->toArray();
    //     $number_of_slot = ReservationSlots::where('date', $res_date)->first();
    //     $slots = $number_of_slot ? $this->getTimeSlot($number_of_slot->duration, $number_of_slot->start_time, $number_of_slot->end_time) : [];

    //     $reservations  = Reservation::where('res_date',$res_date)->get();

    //     // Create an associative array or Laravel collection with the values
    //     $data = [
    //         'ReservationsNumbers' => $number_of_res,
    //         'ReservationsSlots' => $slots,
    //         'Reservations'=>$reservations
    //     ];

    //     return $this->apiResponse($data, 'Data', 200,true);
    //     // Return the data as JSON response
    //     // return response()->json($data);

    // }

    public function getResNumberOrSlotAdd(Request $request)
    {
        $res_date = $request->res_date;

        // Fetch reservation numbers for the given date
        $reservedReservationNumbers = Reservation::where('res_date', $res_date)
            ->pluck('res_num')
            ->map(function ($item) {
                return (int) $item;
            })
            ->toArray();

        // Fetch the number of reservations for the given date
        $numberOfReservations = NumberOfReservations::where('reservation_date', $res_date)
            ->value('num_of_reservations');

        // Fetch reservation slots for the given date
        $reservationSlots = Reservation::where('res_date', $res_date)
            ->whereNotNull('slot')
            ->pluck('slot')
            ->toArray();

        // Fetch the number of slots and time slots if available
        $number_of_slot = ReservationSlots::where('date', $res_date)->first();
        $slots = $number_of_slot ? $this->getTimeSlot($number_of_slot->duration, $number_of_slot->start_time, $number_of_slot->end_time) : [];

        // Fetch all reservations for the given date
        $reservations = Reservation::where('res_date', $res_date)->get();

        // Organize the data into an associative array
        $data = [
            'reserved_res_number' => $reservedReservationNumbers,
            'day_number_of_reservations' => $numberOfReservations,
            'reserved_slots'=>$reservationSlots,
            'day_reservation_slots' => $slots,
            'reservations' => $reservations,
        ];

        // Return the data as a JSON response
        return $this->apiResponse($data, 'Data fetched successfully', 200, true);
    }


}