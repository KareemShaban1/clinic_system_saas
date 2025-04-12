<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $governorates = [
            'القاهرة',
            'الإسكندرية',
            'القليوبية'

        ];
        foreach ($governorates as $governorate) {
            Governorate::create([
                'name' => $governorate,
            ]);
        }
    }
}
