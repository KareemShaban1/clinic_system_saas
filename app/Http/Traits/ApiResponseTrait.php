<?php

namespace App\Http\Traits;

trait ApiResponseTrait
{
    public function apiResponse($data = null, $message = null, $status_code = 200, $success = true)
    {
        $array = [
                  'data' => $data,
                  'message' => $message,
                  'success' => $success,
                  'status_code' => $status_code
        ];

        return response($array, $status_code);
    }
}
