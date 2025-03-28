<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChronicDiseaseRequest extends FormRequest
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
            
                'title' => 'required',
                'measure' => 'required',
                'notes'=>'nullable',
                'date'=>'required',
                'id'=>'required',
                'id'=>'required',
                
        ];
    }
    

    public function messages(){
        return[
            'title.required'=>'برجاء أدخال أسم المرض',
            'measure.required'=>'برجاء أدخال قياس المرض',
            'date.required'=>'برجاء أدخال تاريخ المرض',
            'id.required'=>'reservation id برجاء أدخال ',
            'id.required'=>'patient id برجاء أدخال  ',
        ];
    }
}
