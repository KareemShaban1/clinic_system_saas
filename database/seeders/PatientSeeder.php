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
        //
        DB::table('patients')->insert([
            'name' => 'كريم شعبان',
            'age'=>'23',
            'address'=>'بنها',
            'phone'=>'01090537394',
            'blood_group'=>'O+',
            'gender'=>'male',
            'patient_code'=>'20230001',
            'email' => 'shabankareem919@gmail.com',
            'password'=>Hash::make('password'),
            'created_at'=>now()
        ]);

    }
}
