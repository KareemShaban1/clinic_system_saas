<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedicineResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Medicine;
use Faker\Provider\Medical;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    //
    use ApiResponseTrait;

    public function index()
    {

        $medicines =  MedicineResource::collection(Medicine::get());

        return $this->apiResponse($medicines, 'All Medicines', 200);

    }

    public function show($id)
    {
        $medicine = new MedicineResource(Medicine::findOrFail($id));

        return $this->apiResponse($medicine, 'Medicine', 200);
    }

    public function store()
    {

    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }
}
