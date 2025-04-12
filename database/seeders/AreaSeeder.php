<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         $benha = City::where('name', 'بنها')->first();

         // 6th of October areas
         $benhaAreas = [
             'اتريب',
             'الاهرام',
             'البرنس',
             'الحرس الوطني',
             'الرملة',
             'الشدية',
             'الشموت',
             'الفلل',
             'منشية النور',
             'سندنهور',
             'وسط البلد',
             'عزبة المربع',
             'كفر الجزار',
             'المنشية',
             'مرصفا',
             'عزبة الزراعة',
             'عزبه المتينى',
             'بتمدة',
             'شبلنجة',
             'شبين',
             'فرسيس',
             'كفر الشموت',
             'كفر العرب',
             'كفر سعد',
             'كفر سندهور',
             'كفر طلحه',
             'كفر فرسيس',
             'كلية العلوم',
             'مجول',
             'مساكن الموالح',
             'منية السباع',
             'ميت السباع',
             'ميت العطار',
             'ميت عاصم',
             'نقباس'
         ];
 
         foreach ($benhaAreas as $areaName) {
             Area::create([
                 'name' => $areaName,
                 'governorate_id' => $benha->governorate_id,
                 'city_id' => $benha->id
             ]);
         }
 
    }
}
