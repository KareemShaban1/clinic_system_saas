<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Governorate;
use App\Http\Requests\StoreGovernorateRequest;
use App\Http\Requests\UpdateGovernorateRequest;
use Yajra\DataTables\Facades\DataTables;

class GovernorateController extends BaseController
{
    public function __construct()
    {
        $this->model = Governorate::class;
        $this->viewPath = 'backend.dashboards.admin.pages.governorates';
        $this->routePrefix = 'governorates';
        $this->validationRules = [
            'name' => 'required|string|max:255|unique:governorates,name',
        ];
    }


    public function data()
    {
        $query = $this->model::query();
        
        return DataTables::of($query)
            ->addColumn('action', function ($item) {

                $btn = '<div class="d-flex gap-2">';

                // if (auth()->user()->can('update governorate')) {
                    $btn .= '<a href="javascript:void(0);" onclick="editGovernorate('.$item->id.', \''.$item->name.'\')"
                            class="btn btn-sm btn-info">
                                <i class="mdi mdi-square-edit-outline"></i>
                            </a>';
                // }

                // if (auth()->user()->can('delete governorate')) {
                    $btn .= '<a href="javascript:void(0);" onclick="deleteRecord('.$item->id.', \'governorates\')"
                            class="btn btn-sm btn-danger">
                                <i class="mdi mdi-delete"></i>
                            </a>';
                // }

               return $btn . '</div>';
            })
            ->editColumn('created_at', function($item) {
                return $item->created_at->format('Y-m-d H:i:s');
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    protected function getUpdateValidationRules($id)
    {
        return [
            'name' => 'required|string|max:255|unique:governorates,name,'. $id,
        ];
    }
}
