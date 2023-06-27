<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\Patient;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomAuthentication
{

          



          public function authenticateUser($request)
          {
                    $email = $request->email;
                    $password = $request->password;
                    $user = User::where('email', '=', $email)->first();
                    
                    if ($user && Hash::check($password, $user->password)) {
                              return $user;
                    }
                    return false;
          }

          public function authenticatePatient($request)
          {
                    $email = $request->email;
                    $password = $request->password;
                    $patient = Patient::where('email', '=', $email)->first();
                    
                    if ($patient && Hash::check($password, $patient->password)) {
                              return $patient;
                    }
                    return false;
          }


}
