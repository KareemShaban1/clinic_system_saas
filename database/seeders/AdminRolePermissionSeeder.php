<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class AdminRolePermissionSeeder extends Seeder
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

            'view-governorates',
            'add-governorates',
            'edit-governorates',
            'delete-governorates',
            'restore-governorates',
            'force-delete-governorates',
           
        ];

        $permissions = collect($arrayOfPermissionsNames)->map(function ($permission) {
            return ['name'=>$permission , 'guard_name'=>'admin' ];
        });

        Permission::insert($permissions->toArray());

        Role::create(['name'=>'super_admin','guard_name'=>'admin' ])->givePermissionTo($arrayOfPermissionsNames);
    }
}
