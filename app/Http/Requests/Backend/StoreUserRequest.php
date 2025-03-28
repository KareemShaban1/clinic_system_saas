<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public function messages(){

        return [
            'name.required'=>'يجب أدخال أسم المستخدم',
            'email.required'=>'يجب أدخال البريد الألكترونى',
            'password.required'=>'يجب أدخال كلمة المرور',
        ];

    }
}
