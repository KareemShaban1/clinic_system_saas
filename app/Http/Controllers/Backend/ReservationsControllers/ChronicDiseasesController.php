<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreChronicDiseaseRequest;
use App\Http\Requests\Backend\UpdateChronicDiseaseRequest;
use App\Models\Reservation;
use App\Models\ChronicDisease;
use Illuminate\Support\Facades\DB;

class ChronicDiseasesController extends Controller
{
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
        $this->authorizeCheck('أضافة مرض مزمن');

        $reservation = $this->reservation->findOrFail($id);

        return view('backend.pages.chronicDiseases.add', compact('reservation'));
    }

    public function store(StoreChronicDiseaseRequest $request)
    {
        $this->authorizeCheck('أضافة مرض مزمن');

        $request->validated();

        try {
            foreach ($request->title as $index => $title) {
                $data = [
                    'title' => $title,
                    'measure' => $request->measure[$index],
                    'date' => $request->date[$index],
                    'notes' => $request->notes[$index],
                    'patient_id' => $request->patient_id[$index],
                    'reservation_id' => $request->reservation_id[$index],
                ];
                DB::table('chronic_diseases')->insert($data);
            }

            return redirect()->route('backend.reservations.index')->with('success', 'Chronic diseases added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function show($id)
    {
        $this->authorizeCheck('عرض مرض مزمن');

        $reservations = $this->reservation->findOrFail($id);
        $chronic_diseases = $this->chronicDisease->where('reservation_id', $id)->get();

        return view('backend.pages.chronicDiseases.show', compact('chronic_diseases', 'reservations'));
    }

    public function edit($id)
    {
        $this->authorizeCheck('تعديل مرض مزمن');

        $chronic_disease = $this->chronicDisease->findOrFail($id);

        return view('backend.pages.chronicDiseases.edit', compact('chronic_disease'));
    }

    public function update(UpdateChronicDiseaseRequest $request, $id)
    {
        $this->authorizeCheck('تعديل مرض مزمن');

        $request->validated();

        try {
            $chronicDisease = $this->chronicDisease->findOrFail($id);

            foreach ($request->title as $index => $title) {
                $data = [
                    'title' => $title,
                    'measure' => $request->measure[$index],
                    'date' => $request->date[$index],
                    'notes' => $request->notes[$index],
                    'patient_id' => $request->patient_id[$index],
                    'reservation_id' => $request->reservation_id[$index],
                ];
                $this->chronicDisease->where('id', $chronicDisease->id)->update($data);
            }

            return redirect()->route('backend.reservations.index')->with('success', 'Chronic diseases updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
