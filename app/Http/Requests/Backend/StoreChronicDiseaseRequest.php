<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class StoreChronicDiseaseRequest extends FormRequest
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

                'name' => 'required',
                'measure' => 'required',
                'notes' => 'nullable',
                'date' => 'required',
                'reservation_id' => 'required',
                'patient_id' => 'required',

        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'برجاء أدخال أسم المرض',
            'measure.required' => 'برجاء أدخال قياس المرض',
            'date.required' => 'برجاء أدخال تاريخ المرض',
            'reservation_id.required' => 'reservation id برجاء أدخال ',
            'patient_id.required' => 'patient id برجاء أدخال  ',
        ];
    }
}
