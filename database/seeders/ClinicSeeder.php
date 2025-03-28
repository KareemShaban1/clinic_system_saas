<?php

namespace Database\Seeders;

use App\Models\Clinic;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Clinic::create([
            "name"=> "Clinic 1",
            "address"=> "address 1",
            "phone"=> "0123456789",
            "email"=> "clinic1@clinic.com",
            'start_date'=> Carbon::now(),
            "status"=> 1,
        ]);
    }
}
