<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medicine;
use File;
use Illuminate\Support\Facades\Storage;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Medicine::truncate();
  
        $json = file_get_contents("database/data/data.json");
        // $json = File::get("database/data/data.json");
        // $json = Storage::disk('local')->get('/data/drugs.json');
        $medicines = json_decode($json,true);
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                echo ' - No errors';
                break;
            case JSON_ERROR_DEPTH:
                echo ' - Maximum stack depth exceeded';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                echo ' - Underflow or the modes mismatch';
                break;
            case JSON_ERROR_CTRL_CHAR:
                echo ' - Unexpected control character found';
                break;
            case JSON_ERROR_SYNTAX:
                echo ' - Syntax error, malformed JSON';
                break;
            case JSON_ERROR_UTF8:
                echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
                break;
            default:
                echo ' - Unknown error';
                break;
        }

        foreach ($medicines as $key => $value) {
            // var_dump([$value]);
            Medicine::create(
               
                [
                "drugbank_id" => $value["drugbank_id"],
                "name" => $value["name"],
                "type" => $value["type"],
                "group" => $value["groups"],
                "categories" => $value["categories"],
                "description" => $value["description"],
            ]);
        }

        // dd(count($medicines["DB00001"]));
        // $index = 0;
        // foreach ($medicines as $key => $value) {
        //     // var_dump([$value]);
        //     Medicine::updateOrCreate(
        //         [
        //             'drugbank_id'=>$key
        //         ],
        //         [
        //             'brand_name'=>implode($value)
        //         // "drugbank_id" => $value["drugbank_id"],
        //         // "name" => $value["name"],
        //         // "type" => $value["type"],
        //         // "group" => $value["groups"],
        //         // "categories" => $value["categories"],
        //         // "description" => $value["description"],
        //     ]);
        // }

        
    }
}
