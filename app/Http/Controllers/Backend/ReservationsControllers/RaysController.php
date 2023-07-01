<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreRayRequest;
use App\Http\Requests\Backend\UpdateRayRequest;
use App\Models\Reservation;
use App\Models\Ray;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class RaysController extends Controller
{


    private $reservation;
    private $ray;
    private $storage;

    public function __construct(

        Reservation $reservation,
        Ray $ray,
        Storage $storage
    ) {

        $this->reservation = $reservation;
        $this->ray = $ray;
        $this->storage = $storage;
    }

    public function index()
    {
        $reservations = $this->reservation->all();
        return view('backend.pages.reservations.index', compact('reservations'));
    }

    public function add($id)
    {
        $reservation = $this->reservation->findOrFail($id);
        return view('backend.pages.rays.add', compact('reservation'));
    }

    public function store(StoreRayRequest $request)
    {
        try {
            $request->validated();

            $data = $request->except('images');
            $image_path = $this->handleImageUpload($request, $this->ray);
            $data['image'] =  $image_path;
            $this->ray->create($data);

            return redirect()->route('backend.reservations.index')->with('success', 'Reservation added successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }




    public function show($id)
    {

        // get reservation based on reservation_id
        $rays = $this->ray->where('reservation_id', $id)->get();

        return view('backend.pages.rays.show', compact('rays'));
    }


    public function edit($id)
    {

        // get reservation based on reservation_id
        $ray = $this->ray->findOrFail($id);

        return view('backend.pages.rays.edit', compact('ray'));
    }

    public function update(UpdateRayRequest $request, $id)
    {
        try {
            $request->validated();

            $ray = $this->ray->findOrFail($id);
            $data = $request->except('images');
            $data['image'] = $this->handleImageUpload($request, $ray);
            $ray->update($data);

            return redirect()->route('backend.reservations.index')->with('success', 'Reservation updated successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }



    private function handleImageUpload($request, $ray)
    {
        $old_image = explode('|', $ray->image);
        $image_path = [];

        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $image_name = strtolower($file->getClientOriginalName());
                $file->storeAs(
                    'rays',
                    $image_name,
                    ['disk' => 'uploads']
                );
                $image_path[] = $image_name;
            }

            foreach ($old_image as $key => $value) {
                if ($image_path && !empty($value)) {
                    $this->storage->disk('uploads')->delete('rays/' . $value);
                }
            }
        }

        return $image_path ? implode('|', $image_path) : $ray->image;
    }
}
