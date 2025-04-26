<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRayRequest extends FormRequest
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
            'date'=>'required',
            'ray_type_id'=>'required|exists:types,id',
            'report'=>'nullable',
            'patient_id'=>'required'
            
        ];
    }

    public function messages(){
        return [
            'name.required'=>'برجاء أدخال أسم الأشعة',
            // 'images.required'=>'برجاء أدخال صور الأشعة / التحليل',
            'date.required'=>'برجاء أدخال تاريخ الأشعة',
            'ray_type_id.required'=>'برجاء أدخال نوع الأشعة',
            'patient_id.required'=>'patient id برجاء أدخال  ',
        ];
    }
}