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
            ['key' => 'doctor_name', 'value' => 'kareem shaban'],
            ['key' => 'doctor_address', 'value' => 'Benha'],
            ['key' => 'specifications', 'value' => 'عيون'],
            ['key' => 'qualifications', 'value' => ''],
            ['key' => 'clinic_name', 'value' => ''],
            ['key' => 'clinic_type', 'value' => ''],
            ['key' => 'clinic_address', 'value' => ''],
            ['key' => 'phone', 'value' => ''],
            ['key' => 'website', 'value' => ''],
            ['key' => 'email', 'value' => ''],
            ['key' => 'zoom_api_key','value' => ''],
            ['key' => 'zoom_api_secret','value' => ''],
        ];

        DB::table('settings')->insert($data);
    }
}
