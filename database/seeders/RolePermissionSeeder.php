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
            'المرضى','patient index','patient add','patient edit','patient show','patient delete'
        ];

        $permissions = collect($arrayOfPermissionsNames)->map(function($permission){
            return ['name'=>$permission , 'guard_name'=>'web' ];
        }); 

        Permission::insert($permissions->toArray());

        $role = Role::create(['name'=>'super-admin'])->givePermissionTo($arrayOfPermissionsNames);

           }
}
