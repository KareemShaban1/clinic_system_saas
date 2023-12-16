<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginPatientRequest;
use App\Http\Requests\Api\Auth\RegisterUserRequest as AuthRegisterUserRequest;
use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Requests\Api\RegisterUserRequest;
use App\Http\Traits\ApiHelperTrait;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    use ApiHelperTrait;

    public function patientLogin(LoginPatientRequest $request)
    {
        // $request->validate([
        //     'email' => 'required|email|max:255',
        //     'password' => 'required|string|min:6',
        //     'device_name' => 'string|max:255',
        //     'abilities' => 'nullable|array'
        // ]);

        $patient = Patient::where('email', $request->email)->first();

        if($patient && Hash::check($request->password, $patient->password)) {
            // $device_name = $request->post('device_name', $request->userAgent());
            // $token = $user->createToken($device_name, $request->post('abilities'));

            // we can send abilities (authorization / permissions) in as a parameter in token
            $token = $patient->createToken('personal-token');

            return $this->returnJSON([
                'token' => $token->plainTextToken,
                'user' => $patient
            ], 'Patient Login Successfully');
        }

        return $this->returnJSON(null, 'Invalid Credentials', false, 401);

    }

    public function register(AuthRegisterUserRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
            return $this->returnWrong('Validation failed', $validator->errors());
        }
        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['password'] = bcrypt($request['password']);
            $user = User::create($data);
            $user->userProfile()->create($data);
            DB::commit();
            $token = auth()->attempt(["email" => $request->email, "password" => $request->password]);
            return $this->createNewToken($token);

            // return $this->returnJSON(new UserResource($user), 'User registered successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->returnWrong('Failed to register user ' . $e->getMessage());
        }
    }

    // public function getProfileById($userId)
    // {
    //     $userProfile = (new UserProfileService())->getProfileById($userId);

    //     return $this->returnJSON($userProfile);
    // }

    // public function forgot(ForgotPasswordRequest $request)
    // {
    //     $email = $request->input('email');
    //     $token = Str::random(10);

    //     try {
    //         DB::table('password_resets')->updateOrInsert(
    //             ['email' => $email],
    //             ['token' => $token, 'created_at' => now()]
    //         );
    //         $success = Mail::to($email)->send(new ResetPasswordMail($token));
    //         ;

    //         if ($success) {
    //             return $this->returnSuccess('we have e-mailed your password reset link');
    //         } else {
    //             throw new \Exception('Something went wrong with sending your email');
    //         }
    //     } catch (\Exception $exp) {
    //         return $this->returnWrong('failed', $exp->getMessage());
    //     }
    // }

    public function refreshToken()
    {
        return $this->createNewToken(Auth::refresh());
    }

    protected function createNewToken($token)
    {

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => Auth::user()
        ]);
    }
}
