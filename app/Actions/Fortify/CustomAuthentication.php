<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\Patient;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomAuthentication
{


    public function authenticateClinicUser($request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', '=', $email)
        ->first();

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }
        return false;
    }

    public function authenticateMedicalLaboratoryUser($request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', '=', $email)
        // ->whereHas('organization',function($query){
        //     $query->where('status', 1);
        // })
        ->first();

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }
        return false;
    }

    public function authenticateRadiologyCenterUser($request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', '=', $email)
        ->whereHas('clinic',function($query){
            $query->where('status', 1);
        })
        ->first();

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }
        return false;
    }

    public function authenticatePatient($request)
    {


        $request->validate(
            [
                'email' => ['required'],
                'password' => ['required'],
            ],
            [
                'email.required' => 'برجاء أدخال البريد الألكترونى',
                'password.required' => 'برجاء أدخال كلمة المرور',

            ]
        );


        $email = $request->email;
        $password = $request->password;
        $patient = Patient::where('email', '=', $email)
        // ->whereHas('clinic',function($query){
        //     $query->where('status', 1);
        // })
        ->first();

        // dd($patient);

        if ($patient && Hash::check($password, $patient->password)) {
            return $patient;
        }
        return false;
    }

    public function authenticateAdmin($request)
    {


        $request->validate(
            [
                'email' => ['required'],
                'password' => ['required'],
            ],
            [
                'email.required' => 'برجاء أدخال البريد الألكترونى',
                'password.required' => 'برجاء أدخال كلمة المرور',

            ]
        );


        $email = $request->email;
        $password = $request->password;
        $admin = Admin::where('email', '=', $email)->first();

        if ($admin && Hash::check($password, $admin->password)) {
            return $admin;
        }
        return false;
    }
}
