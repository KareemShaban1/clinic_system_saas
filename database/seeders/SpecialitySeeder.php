<?php

namespace Database\Seeders;

use App\Models\Speciality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $specialities = [
            'جلدية',
            'باطنية',
            'عظام',
            'طب الأطفال',
            'نساء و توليد',
            'الخصوبة و الأنجاب',
            'الأنف و الأذن و الحنجرة',
            'الأسنان',
            'العيون',
            'الأمراض الجلدية',
            'أمراض الكلى',
            'العلاج الطبيعي',
            'أمراض الروماتزم',
            'أمراض القلب'
        ];

        foreach ($specialities as $speciality) {
            Speciality::create([
                'name' => $speciality,
            ]);
        }
       
    }
}
