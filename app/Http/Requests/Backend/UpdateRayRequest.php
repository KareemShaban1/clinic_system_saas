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
            
            'ray_name' => 'required',
            'ray_date'=>'required',
            'ray_type'=>'required',
            'notes'=>'nullable',
            'id'=>'required'
            
        ];
    }

    public function messages(){
        return [
            'ray_name.required'=>'برجاء أدخال أسم الأشعة / التحليل',
            // 'images.required'=>'برجاء أدخال صور الأشعة / التحليل',
            'ray_date.required'=>'برجاء أدخال تاريخ الأشعة / التحليل',
            'ray_type.required'=>'برجاء أدخال نوع الأشعة / التحليل',
            'id.required'=>'patient id برجاء أدخال  ',
        ];
    }
}