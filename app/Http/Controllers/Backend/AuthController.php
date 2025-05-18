<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Clinic;
use App\Models\MedicalLaboratory;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function registerClinic(Request $request)
    {

        // Validate input
        $validated = $request->validate([
            'clinic_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'user_email' => 'required|email|unique:users,email',
            'clinic_email' => 'required|email|unique:clinics,email',
            'password' => 'required|string|min:6|confirmed',
            'governorate_id' => 'nullable|exists:governorates,id',
            'city_id' => 'nullable|exists:cities,id',
            'area_id' => 'nullable|exists:areas,id',
            'website' => 'nullable|url',
            'domain' => 'nullable|string',
            'database' => 'nullable|string',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
        ]);


        // Create the clinic
        $clinic = Clinic::create([
            'name' => $validated['clinic_name'],
            'start_date' => $validated['start_date'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'email' => $validated['clinic_email'],
            'governorate_id' => $validated['governorate_id'] ?? null,
            'city_id' => $validated['city_id'] ?? null,
            'area_id' => $validated['area_id'] ?? null,
            'website' => $validated['website'] ?? null,
            'domain' => $validated['domain'] ?? null,
            'database' => $validated['database'] ?? null,
            'description' => $validated['description'] ?? null,
            'logo' => $validated['logo'] ?? null,
            'status' => 1, // Active by default
            'speciality_id' => $request->speciality_id,
        ]);


        // Create the clinic admin user
        $user = User::create([
            'organization_id' => $clinic->id,
            'organization_type' => Clinic::class,
            'name' => 'Clinic Admin', // You can also take this from input
            'email' => $validated['user_email'],
            'password' => Hash::make($validated['password']),
        ]);



        // Assign "clinic-admin" role (if using Spatie Roles & Permissions)
        if (class_exists(\Spatie\Permission\Models\Role::class)) {
            $user->assignRole('clinic-admin');
        }

        // Login the user
        // Auth::login($user);

        return redirect()->to('/clinic/login')->with('success', 'Clinic registered successfully');
    }


    public function registerMedicalLaboratory(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'medical_laboratory_name' => 'required|string|max:255',
                'start_date' => 'required|date',
                'address' => 'required|string',
                'phone' => 'required|string|max:20',
                'user_email' => 'required|email|unique:users,email',
                'medical_laboratory_email' => 'required|email|unique:medical_laboratories,email',
                'password' => 'required|string|min:6|confirmed',
                'governorate_id' => 'nullable|exists:governorates,id',
                'city_id' => 'nullable|exists:cities,id',
                'area_id' => 'nullable|exists:areas,id',
                'website' => 'nullable|url',
                'domain' => 'nullable|string',
                'database' => 'nullable|string',
                'description' => 'nullable|string',
                'logo' => 'nullable|image|max:2048',
            ]);
    
            DB::beginTransaction();
    
            // Ensure logo is stored (if applicable)
            $logoPath = null;
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('logos', 'public');
            }
    
            // Create the medical laboratory
            $medicalLaboratory = MedicalLaboratory::create([
                'name' => $validated['medical_laboratory_name'],
                'start_date' => $validated['start_date'],
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'email' => $validated['medical_laboratory_email'],
                'governorate_id' => $validated['governorate_id'] ?? null,
                'city_id' => $validated['city_id'] ?? null,
                'area_id' => $validated['area_id'] ?? null,
                'website' => $validated['website'] ?? null,
                'domain' => $validated['domain'] ?? null,
                'database' => $validated['database'] ?? null,
                'description' => $validated['description'] ?? null,
                'logo' => $logoPath,
                'status' => 1, // Active by default
                'speciality_id' => $request->speciality_id,
            ]);
    
            // Make sure the model is saved and ID is available
            $medicalLaboratory->refresh();
    
            // Create the admin user
            $user = User::create([
                'name' => 'Medical Laboratory Admin',
                'email' => $validated['user_email'],
                'password' => Hash::make($validated['password']),
                'organization_id' => $medicalLaboratory->id,
                'organization_type' => MedicalLaboratory::class,
            ]);
    
            // Assign role
            $role = Role::firstOrCreate(
                ['name' => 'medical-laboratory-admin', 'guard_name' => 'medical_laboratory']
            );
            $user->assignRole($role);
    
            DB::commit();
    
            return redirect()->to('/medical-laboratory/login')->with('success', 'Medical Laboratory registered successfully');
    
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage()); // You can log this instead
            return redirect()->to('/medical-laboratory/register')->with('error', 'Medical Laboratory registration failed');
        }
    }
    



    public function registerPatient(Request $request)
    {

        $request->validate([
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

        return redirect()->to('/patient/login')->with('success', 'Patient registered successfully');
    }
}
