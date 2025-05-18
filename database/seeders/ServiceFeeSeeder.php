<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\ServiceFee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $clinic = Clinic::first();
        ServiceFee::create([
            'service_name' => 'كشف',
            'organization_id' => $clinic->id,
            'organization_type' => Clinic::class,
            // 'clinic_id' => 1,
            'fee' => 200.00,
            'notes' => 'كشف',
        ]);

        ServiceFee::create([
            'service_name' => 'استشارة',
            // 'clinic_id' => 1,
            'organization_id' => $clinic->id,
            'organization_type' => Clinic::class,
            'fee' => 100.00,
            'notes' => 'استشارة',
        ]);
    }
}
