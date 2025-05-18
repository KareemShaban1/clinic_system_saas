<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicalLaboratorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('medical_laboratories')->insert([
            'name' => 'Medical Laboratory 1',
            'address' => 'Medical Laboratory 1 Address',
            'phone' => '123456789',
            'email' => 'medical-laboratory1@clinic.com',
            'description' => 'Medical Laboratory 1 Description',
            'logo' => 'medical-laboratory1.png',
            'governorate_id' => 1,
            'city_id' => 1,
            'area_id' => 1,
            'website' => 'https://medical-laboratory1.com',
            'domain' => 'medical-laboratory1.com',
            'database' => 'medical-laboratory1',
            "status"=> 1,
            'start_date' => Carbon::now(),
        ]);
    }
}
