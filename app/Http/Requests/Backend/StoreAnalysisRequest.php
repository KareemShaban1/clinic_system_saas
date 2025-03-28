<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnalysisRequest extends FormRequest
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
            
                'analysis_name' => 'required',
                'images' => 'required',
                'analysis_date'=>'required',
                'analysis_type'=>'required',
                'report'=>'nullable',
                'id'=>'required'
            
        ];
    }

    public function messages(){

        return [
            'analysis_name.required'=>'برجاء أدخال أسم الأشعة / التحليل',
            'images.required'=>'برجاء أدخال صور الأشعة / التحليل',
            'analysis_date.required'=>'برجاء أدخال تاريخ الأشعة / التحليل',
            'analysis_type.required'=>'برجاء أدخال نوع الأشعة / التحليل',
            'id.required'=>'patient id برجاء أدخال  ',
        ];

    }
}