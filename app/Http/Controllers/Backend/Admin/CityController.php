<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\BaseController;
use App\Models\City;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\Area;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CityController extends BaseController
{
    public function __construct()
    {
        $this->model = City::class;
        $this->viewPath = 'backend.dashboards.admin.pages.cities';
        $this->routePrefix = 'cities';
        $this->validationRules = [
            'name' => 'required|string|max:255|unique:cities,name',
            'governorate_id'=> 'required|exists:governorates,id',
        ];
    }



    public function data()
    {
        $query = $this->model::query();
        
        return DataTables::of($query)
            ->addColumn('action', function ($item) {

                $btn = '<div class="d-flex gap-2">';

                // if (auth()->user()->can('update governorate')) {
                    $btn .= '<a href="javascript:void(0);" onclick="editCity('.$item->id.', \''.$item->name.'\', \''.$item->governorate_id.'\')"
                            class="btn btn-sm btn-info">
                                <i class="mdi mdi-square-edit-outline"></i>
                            </a>';
                // }

                // if (auth()->user()->can('delete governorate')) {
                    $btn .= '<a href="javascript:void(0);" onclick="delete('.$item->id.', \'cities\')"
                            class="btn btn-sm btn-danger">
                                <i class="mdi mdi-delete"></i>
                            </a>';
                // }

               return $btn . '</div>';
            })
            ->editColumn('created_at', function($item) {
                return $item->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('governorate',function($item) {
                return $item->governorate->name ?? '';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    protected function getUpdateValidationRules($id)
    {
        return [
            'name' => 'required|string|max:255|unique:cities,name,'. $id,
            'governorate_id'=> 'required|exists:governorates,id',
        ];
    }

    public function getCitiesByGovernorate(Request $request)
    {
        $cities = City::where('governorate_id', $request->governorate_id)
            ->select('id', 'name')
            ->get();
            
        return response()->json([
            'success' => true,
            'data' => $cities
        ]);
    }
}
