<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('reservation_controls')->delete();

        $data = [
            ['key' => 'show_ray', 'value' => 1],
            ['key' => 'show_chronic_diseases', 'value' =>  1],
            ['key' => 'show_glasses_distance', 'value' => 1],
            ['key' => 'show_prescription', 'value' => 1],

            ['key' => 'show_events', 'value' => 1],
            ['key' => 'show_patients', 'value' => 1],
            ['key' => 'show_reservations', 'value' => 1],
            ['key' => 'show_online_reservations', 'value' => 1],
            ['key' => 'show_medicines', 'value' => 1],
            ['key' => 'show_num_of_res', 'value' => 1],
            ['key' => 'show_drugs', 'value' => 1],
            ['key' => 'show_fees', 'value' => 1],
            ['key' => 'show_users', 'value' => 1],
            ['key' => 'show_settings', 'value' => 1],
           
        ];

        DB::table('reservation_controls')->insert($data);
    }
}
