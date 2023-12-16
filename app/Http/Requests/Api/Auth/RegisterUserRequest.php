<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name'          => 'required|string|between:2,100',
            'username'      => 'required|string|max:100|alpha_dash|unique:users',
            'email'         => 'required|email|max:100|unique:users,email',
            'password'      => 'required|string|confirmed|min:8',
            'phone'          => 'required|string|between:11,17',
            'date_of_birth'    => 'required|date',
            'gender'          => 'required|string|in:male,female',
        ];
    }
}
