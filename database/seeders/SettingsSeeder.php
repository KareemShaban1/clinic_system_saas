<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('settings')->delete();

        $data = [
            // ['key' => 'doctor_name', 'value' => 'kareem shaban'],
            // ['key' => 'doctor_address', 'value' => 'Benha'],
            // ['key' => 'specifications', 'value' => 'عيون'],
            // ['key' => 'qualifications', 'value' => ''],
            // ['key' => 'clinic_name', 'value' => ''],
            // ['key' => 'clinic_type', 'value' => ''],
            // ['key' => 'clinic_address', 'value' => ''],
            // ['key' => 'phone', 'value' => ''],
            // ['key' => 'website', 'value' => ''],
            // ['key' => 'email', 'value' => ''],
            // ['key' => 'zoom_api_key','value' => ''],
            // ['key' => 'zoom_api_secret','value' => ''],


            ['key' => 'show_ray', 'value' => 1,'type' => 'system_control'],
            ['key'=> 'show_analysis', 'value'=> 1,'type' => 'system_control'],
            ['key' => 'show_chronic_diseases', 'value' =>  1,'type' => 'system_control'],
            ['key' => 'show_glasses_distance', 'value' => 1,'type' => 'system_control'],
            ['key' => 'show_prescription', 'value' => 1,'type' => 'system_control'],

            ['key' => 'show_events', 'value' => 1,'type' => 'system_control'],
            ['key' => 'show_patients', 'value' => 1,'type' => 'system_control'],
            ['key' => 'show_reservations', 'value' => 1,'type' => 'system_control'],
            ['key' => 'show_online_reservations', 'value' => 1,'type' => 'system_control'],
            ['key' => 'show_medicines', 'value' => 1,'type' => 'system_control'],
            ['key' => 'show_num_of_res', 'value' => 1,'type' => 'system_control'],
            ['key' => 'show_drugs', 'value' => 1,'type' => 'system_control'],
            ['key' => 'show_fees', 'value' => 1,'type' => 'system_control'],
            ['key' => 'show_users', 'value' => 1,'type' => 'system_control'],
            ['key' => 'show_settings', 'value' => 1,'type' => 'system_control'],
            // ['key' => 'reservation_numbers', 'value' => 1],
            ['key' => 'reservation_slots', 'value' => 0,'type' => 'system_control'],
        ];

        DB::table('settings')->insert($data);
    }
}
