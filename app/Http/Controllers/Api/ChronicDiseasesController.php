<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateChronicDiseaseRequest;
use App\Http\Requests\Backend\StoreChronicDiseaseRequest;
use App\Http\Requests\ChronicDiseasesRequest;
use App\Http\Resources\ChronicDiseasesResource;
use App\Models\ChronicDisease;
use Illuminate\Http\Request;

class ChronicDiseasesController extends Controller
{
    //

    public function index()
    {
        $chronic_diseases = ChronicDiseasesResource::collection(ChronicDisease::get());
        return $this->apiResponse($chronic_diseases, 'All Chronic Diseases', 200);

    }

    public function show($id)
    {
        $chronic_disease = ChronicDisease::find($id);
        if($chronic_disease) {

            return $this->apiResponse(
                new ChronicDiseasesResource($chronic_disease),
                'Show Chronic Disease',
                200
            );
        }
        return $this->apiResponse(null, 'Chronic Disease Not Found', 401);


    }

    public function store(StoreChronicDiseaseRequest $request)
    {
        $request->validated();

        $data = $request->all();
        $chronic_disease = new ChronicDiseasesResource(ChronicDisease::create($data));

        return $this->apiResponse(
            $chronic_disease,
            'Chronic Disease Created Successfully',
            200
        );

    }

    public function update(UpdateChronicDiseaseRequest $request, ChronicDisease $chronic_disease)
    {
        $request->validated();
        $data = $request->all();
        if(!$chronic_disease) {
            return response()->json(['status' => 'Chronic Disease Not Found'], 404);
        }
        $chronic_disease->update($data);

        return new ChronicDiseasesResource($chronic_disease);


    }

    public function delete($id)
    {
        $chronic_disease = ChronicDisease::find($id);

        if(!$chronic_disease) {
            return response()->json(['status' => 'Not Found'], 404);
        }

        $chronic_disease->delete();
        return response()->json(['status' => 'deleted'], 200);

    }
}
