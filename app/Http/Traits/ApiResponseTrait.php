<?php

namespace App\Http\Traits;

trait ApiResponseTrait
{
    public function apiResponse($data = null, $message = null, $status = null,$success = true)
    {
        $array = [
                  'data' => $data,
                  'message' => $message,
                  'success'=>$success,
                  'status' => $status
        ];

        return response($array, $status);
    }
}