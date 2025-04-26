<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $doctors = [
            ['clinic_id' => 1, 'user_id' => 1, 'phone' => '0123456789', 'certifications' => 'certifications 1'],
            ['clinic_id' => 2, 'user_id' => 2, 'phone' => '0123456789', 'certifications' => 'certifications 2'],
        ];
        DB::table('doctors')->insert($doctors);
    }
}
