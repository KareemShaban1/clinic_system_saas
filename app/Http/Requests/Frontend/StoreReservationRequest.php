<?php

namespace App\Http\Requests\Frontend;

use App\Models\ReservationControl;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'res_date'=>'required',
            'patient_id'=>'required',
            'res_num' => [
                // 'required_if:reservation_controls.reservation_slots,0',
                function ($attribute, $value, $fail) {
                    $reservationControl = ReservationControl::pluck('reservation_slots'); // You may fetch the relevant record based on your logic
                    if ($reservationControl && $reservationControl->reservation_slots == 0 && !filled($value)) {
                        $fail('The res_num field is required when reservation_slots is 0.');
                    }
                },
            ],
            'slot' => [
                // 'required_if:reservation_controls.reservation_slots,1',
                function ($attribute, $value, $fail) {
                    $reservationControl = ReservationControl::pluck('reservation_slots'); // You may fetch the relevant record based on your logic
                    if ($reservationControl && $reservationControl->reservation_slots == 1 && empty($value)) {
                        $fail('The res_num field is required when reservation_slots is 0.');
                    }
                },
            ],
            ''=>'',
            ''=>'',
            ''=>'',
            ''=>'',
            ''=>'',
            ''=>'',
        ];
    }
}
