<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\MedicalLaboratory;
use App\Models\RadiologyCenter;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'clinic user 1',
            'email' => 'user1@clinic.com',
            'password' => Hash::make('password'),
        ]);
        $user = User::findOrFail(1);
        $user->assignRole('clinic-admin');
        $clinic = Clinic::findOrFail(1);
        $user->organization()->associate($clinic);
        $user->save();

        DB::table('users')->insert([
            'name' => 'medical laboratory user 1',
            'email' => 'user1@medical-laboratory.com',
            'password' => Hash::make('password'),
        ]);
        $user = User::findOrFail(2);
        $medicalLaboratoryRole = Role::where('name', 'medical-laboratory-admin')->where('guard_name', 'medical_laboratory')->first();
        $user->assignRole($medicalLaboratoryRole);
        $medicalLaboratory = MedicalLaboratory::findOrFail(1);
        $user->organization()->associate($medicalLaboratory);
        $user->save();

        DB::table('users')->insert([
            'name' => 'radiology center user 1',
            'email' => 'user1@radiology-center.com',
            'password' => Hash::make('password'),
        ]);
        $user = User::findOrFail(3);
        $radiologyCenterRole = Role::where('name', 'radiology-center-admin')->where('guard_name', 'radiology_center')->first();
        $user->assignRole($radiologyCenterRole);
        $radiologyCenter = RadiologyCenter::findOrFail(1);
        $user->organization()->associate($radiologyCenter);
        $user->save();
    }
}
