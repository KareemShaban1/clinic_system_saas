<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $arrayOfPermissionsNames = [

            'view-patients',
            'add-patient',
            'edit-patient',
            'delete-patient',
            'restore-patient',
            'force-delete-patient',

            'view-doctors',
            'add-doctor',
            'edit-doctor',
            'delete-doctor',
            'restore-doctor',
            'force-delete-doctor',

            'view-reservations-options',
            'add-reservation-option',
            'edit-reservation-option',
            'delete-reservation-option',
            'restore-reservation-option',
            'force-delete-reservation-option',

            'view-reservation-slots',
            'add-reservation-slot',
            'edit-reservation-slot',
            'delete-reservation-slot',
            'restore-reservation-slot',
            'force-delete-reservation-slot',

            'view-reservations',
            'add-reservation',
            'edit-reservation',
            'delete-reservation',
            'restore-reservation',
            'force-delete-reservation',

            'view-online-reservations',
            'add-online-reservation',
            'edit-online-reservation',
            'delete-online-reservation',
            'restore-online-reservation',
            'force-delete-online-reservation',

            'view-chronic-diseases',
            'add-chronic-disease',
            'edit-chronic-disease',
            'delete-chronic-disease',
            'restore-chronic-disease',
            'force-delete-chronic-disease',

            'view-rays',
            'add-ray',
            'edit-ray',
            'delete-ray',
            'restore-ray',
            'force-delete-ray',

            'view-glasses-distances',
            'add-glasses-distance',
            'edit-glasses-distance',
            'delete-glasses-distance',
            'restore-glasses-distance',
            'force-delete-glasses-distance',

            'view-prescriptions',
            'add-prescription',
            'edit-prescription',
            'delete-prescription',
            'restore-prescription',
            'force-delete-prescription',

            'view-medicines',
            'add-medicine',
            'edit-medicine',
            'delete-medicine',
            'restore-medicine',
            'force-delete-medicine',

            'view-fees',
            'add-fee',
            'edit-fee',
            'delete-fee',
            'restore-fee',
            'force-delete-fee',

            'view-systems',
            'add-system',
            'edit-system',
            'delete-system',
            'restore-system',
            'force-delete-system',
        ];

        $permissions = collect($arrayOfPermissionsNames)->map(function ($permission) {
            return ['name'=>$permission , 'guard_name'=>'web' ];
        });

        Permission::insert($permissions->toArray());

        Role::create(['name'=>'clinic-admin'])->givePermissionTo($arrayOfPermissionsNames);
        Role::create(['name'=>'doctor'])->givePermissionTo($arrayOfPermissionsNames);
        Role::create(['name'=>'user'])->givePermissionTo($arrayOfPermissionsNames);

    }
}
