<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Settings;
use Illuminate\Http\Request;
use MacsiDigital\API\Support\ApiResource;

class DoctorInformationController extends Controller
{
    use ApiResponseTrait;
    //
    public function index()
{
    $doctorInfo = Settings::take(9)->get();

    // Create a new response array
    $data = [
    ];

    // Format the data as 'key': 'value'
    foreach ($doctorInfo as $setting) {
        $data[$setting['key']] = $setting['value'];
    }

    return $this->apiResponse($data, 'success', 200,true);
}

}