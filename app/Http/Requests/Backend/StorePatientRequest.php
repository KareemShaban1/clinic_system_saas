<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
                'age' => 'nullable|max:3|regex:/^([0-9\s\-\+\(\)]*)$/',
                'address' => 'required',
                'gender' => 'required',
                'phone' => 'required|min:11|regex:/^([0-9\s\-\+\(\)]*)$/',
                'email'=>'nullable|unique:patients',
                'blood_group'=>'required',
                'height'=>'nullable',
                'weight'=>'nullable',
            
            
        ];
    }


    public function messages(){
        return[
            
                'name.required'=>' برجاء أدخال أسم المريض ',

                'age.max'=>'يجب أن لا يزيد عمر المريض عن ثلاث خانات',
                'age.regex'=>'يجب أن يكون سن المريض أرقام',
                
                'address.required'=>' برجاء أدخال عنوان المريض ',
    
                'phone.required'=>' برجاء أدخال رقم هاتف المريض ',
                'phone.min'=>'رقم الهاتف يجب أن يكون 11 رقم',
                'phone.regex'=>'يجب أن يكون ريقم الهاتف أرقام',
                
                'gender.required'=>'برجاء أدخال نوع المريض',
                
                'blood_group.required'=>' برجاء أدخال فصيلة دم المريض ',
            
        ];
    }
}
