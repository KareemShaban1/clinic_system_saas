<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateChronicDiseaseRequest;
use App\Http\Requests\Backend\StoreChronicDiseaseRequest;
use App\Http\Requests\ChronicDiseasesRequest;
use App\Http\Resources\ChronicDiseasesResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\ChronicDisease;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChronicDiseasesController extends Controller
{
    //

    use ApiResponseTrait;

    public function index()
    {
        $chronic_diseases = ChronicDiseasesResource::collection(ChronicDisease::get());
        return $this->apiResponse($chronic_diseases, 'All Chronic Diseases', 200);

    }

    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        $chronic_disease = ChronicDisease::where($reservation->id)->get();
        if($chronic_disease) {
            return $this->apiResponse(
                ChronicDiseasesResource::collection($chronic_disease),
                'Show Chronic Disease',
                200
            );
        }
        return $this->apiResponse(null, 'Chronic Disease Not Found', 401);


    }

    public function store(Request $request)
    {
        // $request->validated();

        try {
            $insertedRecords = [];

            foreach ($request->title as $index => $title) {
                $data = [
                    'title' => $title,
                    'measure' => $request->measure[$index],
                    'date' => $request->date[$index],
                    'notes' => $request->notes[$index],
                    'id' => $request->id[$index],
                    'id' => $request->id[$index],
                ];

                // Insert the record and store the result in an array
                $insertedRecords[] = DB::table('chronic_diseases')->insertGetId($data);

            }

            return $this->apiResponse(
                $insertedRecords,
                'Chronic Diseases Created Successfully',
                200
            );
        } catch (\Exception $e) {
            // Handle the exception, log it, or return an error response
            return $this->apiResponse(
                null,
                'Something went wrong: ' . $e->getMessage(),
                500
            );
        }

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
