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
            'drug_name' => 'required',
            'drug_dose' => 'required',
            'period' => 'required',
            'notes' => 'nullable',
            'reservation_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'drug_name.required' => 'يجب أدخال أسم الدواء',
            'drug_dose.required' => 'يجب أدخال جرعة الدواء',
            'period.required' => 'يجب أدخال كمية الدواء',
            'reservation_id.required' => ' reservation id يجب أدخال ',

        ];
    }
}
