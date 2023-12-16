<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait ApiHelperTrait
{
    public function returnAllDataJSON(
        $data    = [],
        $collection,
        $message   = '',
        $status    = 'success',
        $code      = '200',
    ) {
        return response()->json([
            'code'       => $code,
            'status'     => $status,
            'message'    => $message,
            'data'       => $data,
            'pagination' => $collection,
        ], $code);
    }

    // --------------------------------------

    /**
     * JSON response for APIs
     *
     * @param bool $status
     * @param string|array $message
     * @param array $data
     * @param int $code
     * @return \Response
     */
    public function returnJSON(
        $data    = [],
        $message = '',
        $status  = true,
        $code    = 200,
    ) {
        return response()->json([
            'code'    => $code,
            'status'  => $status,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    // --------------------------------------

    /**
     * Return response for success operation
     *
     * @return \Response
     */
    public function returnSuccess(
        $message = 'Your request done successfully'
    ) {
        return response()->json([
            'code'    => '200',
            'status'  => 'success',
            'message' => $message,
        ], 200);
    }

    // --------------------------------------

    /**
     * Return response for success operation
     *
     * @return \Response
     */
    public function returnWrong(
        $message = 'Your Request Is Invalid',
        $errors  = [],
        $code    = JsonResponse::HTTP_BAD_REQUEST,
    ) {
        if ($errors === []) {
            return response()->json([
                'code'    => (string) $code,
                'status'  => 'failed',
                'message' => $message,
            ], $code);
        } else {

            return response()->json([
                'code'    => (string) $code,
                'status'  => 'failed',
                'message' => $message,
                'errors'  => $errors,
            ], $code);
        }
    }
}
