<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreRayRequest;
use App\Http\Requests\Backend\UpdateRayRequest;
use App\Http\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Ray;
use Illuminate\Support\Facades\Storage;

class RaysController extends Controller
{
    //
    use UploadImageTrait;

    public function index()
    {
        // get all reservations 
        $reservations = Reservation::all();
        return view('backend.pages.reservations.index', compact('reservations'));
    }

    public function add(Request $request, $id)
    {

        // get reservation based on reservation_id
        $reservation = Reservation::findOrFail($id);

        return view('backend.pages.rays.add', compact('reservation'));
    }

    public function store(StoreRayRequest $request)
    {

        try {

            $request->validated();


            $data = $request->except('images');

            $image_path = null;
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
            }
            $data['image'] = implode('|', $image_path);;
            Ray::create($data);

            return redirect()->route('backend.reservations.index')->with('success', 'Reservation added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function show($id)
    {

        // get reservation based on reservation_id
        $rays = Ray::where('reservation_id', $id)->get();

        return view('backend.pages.rays.show', compact('rays'));
    }


    public function edit($id)
    {

        // get reservation based on reservation_id
        $ray = Ray::findOrFail($id);

        return view('backend.pages.rays.edit', compact('ray'));
    }

    public function update(UpdateRayRequest $request, $id)
    {


        try {
        $request->validated();

        $ray =  Ray::findOrFail($id);

        $data = $request->except('images');

        $old_image = explode('|', $ray->image);

        $image_path = null;

        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $image_name = strtolower($file->getClientOriginalName());
                // storeAs (folder_name,image_name,disk_name)
                $file->storeAs(
                    'rays',
                    $image_name,
                    ['disk' => 'uploads']
                );
                $image_path[] = $image_name;
            }
            foreach ($old_image as $key => $value) {
                if ($image_path && !empty($value)) {
                    Storage::disk('uploads')->delete('rays/' . $value);
                }
            }
        }

        $data['image'] = $image_path ? implode('|', $image_path) : $ray->image;

        $ray->update($data);

        return redirect()->route('backend.reservations.index')->with('success', 'Reservation added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
