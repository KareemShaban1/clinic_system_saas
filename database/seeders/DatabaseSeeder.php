<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // \App\Models\User::factory(10)->create();
        $this->call(RolePermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(ReservationControlSeeder::class);
        $this->call(MedicineSeeder::class);


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
