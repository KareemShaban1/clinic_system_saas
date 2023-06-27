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
            'عرض المرضى',
            'أضافة مريض',
            'تعديل مريض',
            'عرض مريض',
            'حذف مريض',

            'عرض الكشوفات',
            'أضافة كشف',
            'تعديل كشف',
            'عرض كشف',
            'حذف كشف',

            'عرض الدواء',
            'أضافة دواء',
            'تعديل دواء',
            'عرض دواء',
            'حذف دواء',

            'عرض الحسابات',
            'الحسابات اليومية',
            'الحسابات الشهرية',
            'جميع الحسابات',
        ];

        $permissions = collect($arrayOfPermissionsNames)->map(function ($permission) {
            return ['name'=>$permission , 'guard_name'=>'web' ];
        });

        Permission::insert($permissions->toArray());


        Role::create(['name'=>'super-admin'])->givePermissionTo($arrayOfPermissionsNames);

    }
}
