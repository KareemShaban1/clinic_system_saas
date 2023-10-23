<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreRayRequest;
use App\Http\Resources\RaysResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Ray;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RaysController extends Controller
{
    //
    use ApiResponseTrait;

    public function index()
    {

        $rays =  RaysResource::collection(Ray::all());

        return $this->apiResponse($rays, 'All Rays', 200);

    }

    public function show($id)
    {

    }

    public function store(StoreRayRequest $request)
    {

        try {

            $ray = new Ray();
            $data = $request->except('images');
            $image_path = $this->handleImageUpload($request, $ray);
            $data['image'] =  $image_path;
            $ray->create($data);
            return $this->apiResponse($ray, 'Ray Created Successfully', 200);


        } catch (ValidationException $e) {
            // Handle validation errors and return as an API response
            return $this->apiResponse(null, 'Validation Error', 422, $e->errors());
        } catch (\Exception $e) {
            // Handle other exceptions and return as an API response
            return $this->apiResponse(null, 'Something went wrong', 500);
        }

    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }
}
