<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       // Get Alexandria governorate
       $qalyubia = Governorate::where('name', 'القليوبية')->first();

       // Alexandria cities
       $qalyubiaCities = [
           'بنها',
           'كفر شكر'

       ];

       foreach ($qalyubiaCities as $cityName) {
           City::create([
               'name' => $cityName,
               'governorate_id' => $qalyubia->id
           ]);
       }
    }
}
