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

            'عرض خيارات الكشوفات',
            'أضافة خيارات الكشوفات',
            'تعديل خيارات الكشوفات',
            'حذف خيارات الكشوفات',

            'reservation slots عرض',
            'reservation slots أضافة',
            'reservation slots تعديل',
            'reservation slots حذف',

            'عرض عدد الكشوفات',
            'أضافة عدد كشوفات',
            'تعديل عدد كشوفات',
            'عرض عدد كشوفات',
            'حذف عدد كشوفات',

            'عرض الكشوفات',
            'أضافة كشف',
            'تعديل كشف',
            'عرض كشف',
            'حذف كشف',

            'عرض الكشوفات الأونلاين',
            'أضافة كشف أونلاين',
            'تعديل كشف أونلاين',
            'عرض كشف أونلاين',
            'حذف كشف أونلاين',

            'عرض الأمراض المزمنة',
            'أضافة مرض مزمن',
            'تعديل مرض مزمن',
            'عرض مرض مزمن',
            'حذف عرض مزمن',

            'عرض الأشعة و الحاليل',
            'أضافة أشعة و تحليل',
            'تعديل أشعة و تحليل',
            'عرض أشعة و تحليل',
            'حذف أشعة و تحليل',

            'عرض مقاسات النظارة',
            'أضافة مقاس نظارة',
            'تعديل مقاس نظارة',
            'عرض مقاس نظارة',
            'حذف كشمقاس نظارةف',

            'عرض الروشتة',
            'أضافة روشتة',
            'تعديل روشتة',
            'عرض روشتة',
            'حذف روشتة',

            'عرض الدواء',
            'أضافة دواء',
            'تعديل دواء',
            'عرض دواء',
            'حذف دواء',

            'عرض الحسابات',
            'عرض الحسابات اليومية',
            'عرض الحسابات الشهرية',
            'عرض جميع الحسابات',

            'عرض اأعدادات',
            'تعديل الأعدادات',
        ];

        $permissions = collect($arrayOfPermissionsNames)->map(function ($permission) {
            return ['name'=>$permission , 'guard_name'=>'web' ];
        });

        Permission::insert($permissions->toArray());


        Role::create(['name'=>'super-admin'])->givePermissionTo($arrayOfPermissionsNames);
        Role::create(['name'=>'doctor'])->givePermissionTo($arrayOfPermissionsNames);

    }
}
