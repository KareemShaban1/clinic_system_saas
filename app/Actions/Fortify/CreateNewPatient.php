<?php

namespace App\Actions\Fortify;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Patient;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;

class CreateNewPatient implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:patients'],
            'password' => ['required', 'string'],
            'phone'=>['required','min:11','regex:/^([0-9\s\-\+\(\)]*)$/'],
            'age' => ['nullable','max:3','regex:/^([0-9\s\-\+\(\)]*)$/'],
            'blood_group' => ['nullable'],
            'address'=>['required'],
            'gender'=>['required']
        ], [
            'name.required'=>'برجاء أدخال الأسم بالكامل',
            'email.required'=>'برجاء أدخال البريد الألكترونى',
            'email.email'=>' برجاء أدخال البريد الألكترونى بشكل صحيح',
            'email.unique'=>'هذا البريد موجود من قبل',
            'password.required'=>'برجاء أدخال كلمة المرور',
            'address.required'=>'برجاء أدخال العنوان',
            'phone.required'=>'برجاء أدخال رقم الهاتف ',
            'gender.required'=>'برجاء أدخال نوع المريض ',            
        ])->validate();

        return
            Patient::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'phone' => $input['phone'],
            'age' => $input['age'],
            'blood_group' => $input['blood_group'],
            'gender' => $input['gender'],
            'address' => $input['address'],
        ]);

    }
}
