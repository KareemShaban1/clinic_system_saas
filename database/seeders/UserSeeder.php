<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('users')->insert([
            'name' => 'doctor 1',
            'email' => 'doctor@clinic.com',
            'password' => Hash::make('password'),
            'clinic_id'=> 1
        ]);
        $user = User::findOrFail(1);
        $user->assignRole('clinic-admin');



    }
}
