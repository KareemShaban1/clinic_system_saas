<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PatientAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'password' => 'required|string|min:6',
            'age' => 'required|numeric',
            'phone' => 'required|string|max:20',
            'whatsapp_number' => 'nullable|string|max:20',
            'address' => 'required|string',
            'gender' => 'required|in:male,female',
            'blood_group' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $patient = Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'age' => $request->age,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'blood_group' => $request->blood_group,
            'whatsapp_number' => $request->whatsapp_number,
        ]);

        // Optional: Automatically generate a token
        $token = $patient->createToken('patient-token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Patient registered successfully',
            'token' => $token,
            'patient' => $patient
        ], 201);
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $patient = Patient::where('email', $request->email)->first();

    if (!$patient || !Hash::check($request->password, $patient->password)) {
        return response()->json(['status' => false, 'message' => 'Invalid credentials'], 401);
    }

    $token = $patient->createToken('patient-token')->plainTextToken;

    return response()->json([
        'status' => true,
        'message' => 'Logged in successfully',
        'token' => $token,
        'patient' => $patient
    ]);
}


public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'status' => true,
        'message' => 'Logged out successfully'
    ]);
}

public function updateProfile(Request $request)
{
    $user = $request->user(); // authenticated patient

    $validator = Validator::make($request->all(), [
        'name' => 'sometimes|required|string|max:255',
        'phone' => 'sometimes|required|string|max:20',
        'whatsapp_number' => 'nullable|string|max:20',
        'address' => 'sometimes|required|string',
        'age' => 'sometimes|required|numeric',
        'gender' => 'sometimes|required|in:male,female',
        'blood_group' => 'sometimes|required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
    }

    $user->update($request->only([
        'name', 'phone', 'whatsapp_number', 'address', 'age', 'gender', 'blood_group'
    ]));

    return response()->json([
        'status' => true,
        'message' => 'Profile updated successfully',
        'patient' => $user
    ]);
}

}
