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
            'name' => 'super_admin',
            'email' => 'super_admin@clinic.com',
            'password' => Hash::make('password'),
        ]);
        $user = User::findOrFail(1);
        $user->assignRole('super-admin');

        DB::table('users')->insert([
            'name' => 'doctor',
            'email' => 'doctor@clinic.com',
            'password' => Hash::make('password'),
        ]);

        


    }
}
