<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class StoreDrugRequest extends FormRequest
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
            'name' => 'required',
            'dose' => 'required',
            'period' => 'required',
            'notes' => 'nullable',
            'reservation_id' => 'required|exists:reservations,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يجب أدخال أسم الدواء',
            'dose.required' => 'يجب أدخال جرعة الدواء',
            'period.required' => 'يجب أدخال كمية الدواء',
            'id.required' => ' reservation id يجب أدخال ',

        ];
    }
}
