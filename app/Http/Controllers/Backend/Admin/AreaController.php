<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Area;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AreaController extends BaseController
{
    public function __construct()
    {
        $this->model = Area::class;
        $this->viewPath = 'backend.dashboards.admin.pages.areas';
        $this->routePrefix = 'areas';
        $this->validationRules = [
            'name' => 'required|string|max:255|unique:areas,name',
            'city_id'=> 'required|exists:cities,id',
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
                    $btn .= '<a href="javascript:void(0);" onclick="editArea('.$item->id.',
                     \''.$item->name.'\', \''.$item->city_id.'\', \''.$item->governorate_id.'\')"
                            class="btn btn-sm btn-info">
                                <i class="mdi mdi-square-edit-outline"></i>
                            </a>';
                // }

                // if (auth()->user()->can('delete governorate')) {
                    $btn .= '<a href="javascript:void(0);" onclick="deleteRecord('.$item->id.', \'areas\')"
                            class="btn btn-sm btn-danger">
                                <i class="mdi mdi-delete"></i>
                            </a>';
                // }

               return $btn . '</div>';
            })
            ->editColumn('created_at', function($item) {
                return $item->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('city', function($item) {
                return $item->city->name;
            })
            ->editColumn('governorate', function($item) {
                return $item->city->governorate->name;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    protected function getUpdateValidationRules($id)
    {
        return [
            'name' => 'required|string|max:255|unique:areas,name,'. $id,
            'city_id'=> 'required|exists:cities,id',
            'governorate_id'=> 'required|exists:governorates,id',
        ];
    }

    public function edit($id)
    {
        $area = $this->model::with('city.governorate')->findOrFail($id);
        // $area_group_member = DB::table('area_group_members')
        //     ->where('area_id', $id)->first();
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $area,
                'governorate_id' => $area->city->governorate_id,
                // 'area_group_id' => $area_group_member->area_group_id ?? null
            ]);
        }
        return view($this->viewPath . '.edit', compact('area'));
    }

    public function update(Request $request, $id)
    {
        // $this->authorize('update', $this->model);

        try {
            $item = $this->model::findOrFail($id);

            // If validation rules need to be modified for update (like unique rule)
            $rules = $this->getUpdateValidationRules($id);

            $data = $request->validate($rules);
            $item->update($data);

            // if (isset($data['area_group_id']) && $data['area_group_id'] != null) {
            //     $areaGroup = AreaGroup::find($data['area_group_id']);

            //     if ($areaGroup) {
            //         $areaGroup->areas()->syncWithoutDetaching([$item->id]); // Prevents duplicate insertion
            //     }
            // } else {
            //     // Detach only if the area was previously linked to a group
            //     foreach ($item->areaGroups as $group) {
            //         $group->areas()->detach($item->id);
            //     }
            // }


            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => __('messages.' . class_basename($this->model) . ' updated successfully'),
                    'data' => $item
                ]);
            }

            return redirect()->route($this->routePrefix . '.index')
                ->with('success', __('messages.' . class_basename($this->model) . ' updated successfully'));
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('messages.' . class_basename($this->model) . ' updated failed'),
                    'errors' => $e->getMessage()
                ], 422);
            }

            return back()->withErrors(['error' => __('messages.' . class_basename($this->model) . ' updated failed')])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {
            $area = Area::findOrFail($id);
            $area->delete();

            return response()->json([
                'success' => true,
                'message' => 'Area deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting area: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get areas by city id.
     */
    public function getAreasByCity(Request $request)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id'
        ]);

        $areas = Area::where('city_id', $request->city_id)->get();

        return response()->json([
            'success' => true,
            'data' => $areas
        ]);
    }
}
