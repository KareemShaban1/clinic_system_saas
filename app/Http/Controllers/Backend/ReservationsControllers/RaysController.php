<?php

namespace App\Http\Controllers\Backend\ReservationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreRayRequest;
use App\Http\Requests\Backend\UpdateRayRequest;
use App\Http\Traits\AuthorizeCheck;
use App\Models\Reservation;
use App\Models\Settings;
use App\Models\SystemControl;
use App\Models\Ray;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class RaysController extends Controller
{
    use AuthorizeCheck;

    private $reservation;
    private $ray;
    private $storage;
    protected $systemControl;
    protected $settings;
    public function __construct(
        Reservation $reservation,
        Ray $ray,
        SystemControl $systemControl,
        Settings $settings,
        Storage $storage
    ) {

        $this->reservation = $reservation;
        $this->ray = $ray;
        $this->settings = $settings;
        $this->storage = $storage;
        $this->systemControl = $systemControl;
    }

    public function index()
    {
        
        $rays = Ray::all();
        
        return view('backend.dashboards.user.pages.rays.index', compact('rays'));
    }

    public function data(){
        $query = $this->ray->all();
        return DataTables::of($query)
        ->addColumn('action', function ($number) {
            $editUrl = route('backend.rays.edit', $number->id);
            $deleteUrl = route('backend.rays.destroy', $number->id);

            return '
                <a href="' . $editUrl . '" class="btn btn-warning btn-sm">
                    <i class="fa fa-edit"></i>
                </a>
                <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);

    }

    public function add($id)
    {
        
        $reservation = $this->reservation->findOrFail($id);
        return view('backend.dashboards.user.pages.rays.add', compact('reservation'));
    }

    public function store(StoreRayRequest $request)
    {
        

        $request->validated();

        try {

            $data = $request->except('images');
            $image_path = $this->handleImageUpload($request, $this->ray);
            $data['images'] =  $image_path;
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

        return view('backend.dashboards.user.pages.rays.show', compact('rays'));
    }


    public function edit($id)
    {
        

        // get reservation based on reservation_id
        $ray = $this->ray->findOrFail($id);

        return view('backend.dashboards.user.pages.rays.edit', compact('ray'));
    }

    public function update(UpdateRayRequest $request, $id)
    {
        

        $request->validated();

        try {

            $ray = $this->ray->findOrFail($id);

            $data = $request->except('images');

            $data['images'] = $this->handleImageUpload($request, $ray);

            $ray->update($data);

            return redirect()->route('backend.reservations.index')->with('success', 'Reservation updated successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }



    // function to handel upload rays
    private function handleImageUpload($request, $ray)
    {
        $old_image = explode('|', $ray->images);
        $image_path = [];

        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $image_name = strtolower($file->getClientOriginalName());
                $image_name = str_replace(' ', '_', $image_name); // Replace spaces with underscores
            
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

        return $image_path ? implode('|', $image_path) : $ray->images;
    }
}