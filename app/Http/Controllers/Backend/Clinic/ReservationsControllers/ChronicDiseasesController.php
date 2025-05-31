<?php

namespace App\Http\Controllers\Backend\Clinic\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreChronicDiseaseRequest;
use App\Http\Requests\Backend\UpdateChronicDiseaseRequest;
use App\Http\Traits\AuthorizeCheck;
use App\Models\Reservation;
use App\Models\ChronicDisease;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChronicDiseasesController extends Controller
{
    use AuthorizeCheck;
    protected $reservation;
    protected $chronicDisease;

    public function __construct(Reservation $reservation, ChronicDisease $chronicDisease)
    {
        $this->reservation = $reservation;
        $this->chronicDisease = $chronicDisease;
    }

    public function index()
    {
        // Logic for fetching and displaying chronic diseases index page

    }

    public function add($id)
    {
        $this->authorizeCheck('add-chronic-disease');

        $reservation = $this->reservation->findOrFail($id);

        return view('backend.dashboards.clinic.pages.chronicDiseases.add', compact('reservation'));
    }

    public function store(StoreChronicDiseaseRequest $request)
    {
        $this->authorizeCheck('add-chronic-disease');
        $request->validated();

        try {
            foreach ($request->name as $index => $name) {
                $data = [
                    'name' => $request->name[$index],
                    'measure' => $request->measure[$index],
                    'date' => $request->date[$index],
                    'notes' => $request->notes[$index],
                    'patient_id' => $request->patient_id,
                    'reservation_id' => $request->reservation_id,
                    'clinic_id' => Auth::user()->organization_id,
                ];
                DB::table('chronic_diseases')->insert($data);
            }

            return redirect()->route('clinic.reservations.index')->with('toast_success', 'Chronic diseases added successfully');
        } catch (\Exception $e) {

            // dd($e->getMessage());
            return redirect()->back()->with('toast_error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $this->authorizeCheck('view-chronic-diseases');

        $reservations = $this->reservation->findOrFail($id);
        $chronic_diseases = $this->chronicDisease->where('reservation_id', $id)->get();

        return view('backend.dashboards.clinic.pages.chronicDiseases.show', compact('chronic_diseases', 'reservations'));
    }

    public function edit($id)
    {
        $this->authorizeCheck('edit-chronic-disease');

        $chronic_disease = $this->chronicDisease->findOrFail($id);

        return view('backend.dashboards.clinic.pages.chronicDiseases.edit', compact('chronic_disease'));
    }





    public function update(UpdateChronicDiseaseRequest $request, $id)
    {
        $this->authorizeCheck('edit-chronic-disease');

        $request->validated();


        try {
            $chronicDisease = $this->chronicDisease->findOrFail($id);
            $chronicDisease->update($request->all());

            return redirect()->route('clinic.reservations.index')->with('toast_success', 'Chronic diseases updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function destroy($id)
    {
        $this->authorizeCheck('delete-chronic-disease');

        $chronicDisease = $this->chronicDisease->findOrFail($id);
        $chronicDisease->delete();

        return response()->json([
            'status' => true,
            'message' => 'Chronic disease deleted successfully',
        ]);

    }
}
