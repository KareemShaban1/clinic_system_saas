<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('reservations')->insert([
            'name' => 'كريم شعبان',
            'age'=>'23',
            'address'=>'بنها',
            'phone'=>'01090537394',
            'blood_group'=>'O+',
            'gender'=>'male',
            'email' => 'shabankareem919@gmail.com',
        ]);
    }
}
