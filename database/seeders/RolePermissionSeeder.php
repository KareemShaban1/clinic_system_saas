<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            // Your list of permissions...
            'view-patients', 'add-patient', 'edit-patient', 'delete-patient', 'restore-patient', 'force-delete-patient',
            'view-doctors', 'add-doctor', 'edit-doctor', 'delete-doctor', 'restore-doctor', 'force-delete-doctor',
            'view-reservations-options', 'add-reservation-option', 'edit-reservation-option', 'delete-reservation-option', 'restore-reservation-option', 'force-delete-reservation-option',
            'view-reservation-slots', 'add-reservation-slot', 'edit-reservation-slot', 'delete-reservation-slot', 'restore-reservation-slot', 'force-delete-reservation-slot',
            'view-reservations', 'add-reservation', 'edit-reservation', 'delete-reservation', 'restore-reservation', 'force-delete-reservation',
            'view-online-reservations', 'add-online-reservation', 'edit-online-reservation', 'delete-online-reservation', 'restore-online-reservation', 'force-delete-online-reservation',
            'view-chronic-diseases', 'add-chronic-disease', 'edit-chronic-disease', 'delete-chronic-disease', 'restore-chronic-disease', 'force-delete-chronic-disease',
            'view-rays', 'add-ray', 'edit-ray', 'delete-ray', 'restore-ray', 'force-delete-ray',
            'view-glasses-distances', 'add-glasses-distance', 'edit-glasses-distance', 'delete-glasses-distance', 'restore-glasses-distance', 'force-delete-glasses-distance',
            'view-prescriptions', 'add-prescription', 'edit-prescription', 'delete-prescription', 'restore-prescription', 'force-delete-prescription',
            'view-medicines', 'add-medicine', 'edit-medicine', 'delete-medicine', 'restore-medicine', 'force-delete-medicine',
            'view-fees', 'add-fee', 'edit-fee', 'delete-fee', 'restore-fee', 'force-delete-fee',
            'view-systems', 'add-system', 'edit-system', 'delete-system', 'restore-system', 'force-delete-system',
        ];

        $guards = [
            'web' => ['clinic-admin', 'doctor', 'user'],
            'medical_laboratory' => ['medical-laboratory-admin', 'doctor', 'user'],
            'radiology_center' => ['radiology-center-admin', 'doctor', 'user'],
        ];

        foreach ($guards as $guard => $roles) {

            // 1. Create permissions for this guard
            foreach ($permissions as $permissionName) {
                Permission::firstOrCreate([
                    'name' => $permissionName,
                    'guard_name' => $guard,
                ]);
            }

            // 2. Create roles for this guard
            foreach ($roles as $roleName) {
                $role = Role::firstOrCreate([
                    'name' => $roleName,
                    'guard_name' => $guard,
                ]);

                // 3. Assign all permissions of this guard to this role
                $role->syncPermissions(
                    Permission::where('guard_name', $guard)->pluck('name')->toArray()
                );
            }
        }
    }
}
