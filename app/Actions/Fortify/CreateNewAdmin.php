<?php

namespace App\Actions\Fortify;

use App\Actions\Fortify\PasswordValidationRules;
use App\Events\PatientRegistration;
use App\Models\Admin;
use App\Models\Patient;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;

class CreateNewAdmin implements CreatesNewUsers
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
        ], [
            'name.required'=>'برجاء أدخال الأسم بالكامل',
            'email.required'=>'برجاء أدخال البريد الألكترونى',
            'email.email'=>' برجاء أدخال البريد الألكترونى بشكل صحيح',
            'email.unique'=>'هذا البريد موجود من قبل',
            'password.required'=>'برجاء أدخال كلمة المرور',           
        ])->validate();

        // return
        $admin = Admin::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        // event(new PatientRegistration($admin));

        return $admin;

    }
}
