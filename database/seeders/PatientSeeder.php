<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('patients')->insert([
            'name' => 'كريم شعبان',
            'age'=> '26',
            'address'=> 'بنها',
            'email'=>'kareem@patient.com',
            'password'=>Hash::make('password'),
            'patient_code'=> '123456789',
            'phone'=> '0123456789',
            'whatsapp_number'=> '0123456789',
            'blood_group'=> 'A+',
            'gender'=> 'male',
            'height'=> '180',
            'weight'=> '80',
            'marital_status'=> 'single',
            'nationality'=> 'Egyptian',
            // 'clinic_id'=> 1,
        ]);

        DB::table('patient_clinic')->insert([
            'patient_id'=> 1,
            'clinic_id'=> 1,
        ]);

    }
}
