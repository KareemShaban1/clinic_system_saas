<?php

namespace App\Http\Requests\Api;

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
                'email'=>'nullable|unique:patients,email',
                'blood_group'=>'required'
            
            
        ];
    }
}
