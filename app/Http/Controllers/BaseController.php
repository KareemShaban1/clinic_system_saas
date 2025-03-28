<?php

namespace App\Http\Controllers;

use App\Traits\DataTableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, DataTableTrait;

    protected $model;
    protected $viewPath;
    protected $routePrefix;
    protected $validationRules = [];

    public function index()
    {
        // $this->authorize('view', $this->model);
        return view($this->viewPath . '.index');
    }

    public function data()
    {
        // $this->authorize('view', $this->model);
        $query = $this->model::query();
        return $this->getDataTable($query);
    }

    public function create()
    {
        $this->authorize('create', $this->model);
        return view($this->viewPath . '.create');
    }

    public function store(Request $request)
    {
        // $this->authorize('create', $this->model);

        try {
            $data = $request->validate($this->validationRules);
            if(isset($data['date'])){
                $convertedDateTime = str_replace('T', ' ', $data['date']) . ':00';
                $data['date'] = $convertedDateTime;
            }
            $item = $this->model::create($data);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => __('messages.' . class_basename($this->model) . ' created successfully'),
                    'data' => $item
                ]);
            }

            return redirect()->route($this->routePrefix . '.index')
                ->with('success', class_basename($this->model) . ' created successfully');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('messages.' . class_basename($this->model) . ' created failed'),
                    'errors' => $e->getMessage()
                ], 422);
            }

            return back()->withErrors(['error' => __('messages.' . class_basename($this->model) . ' created failed')])->withInput();
        }
    }

    public function edit($id)
    {
        $this->authorize('update', $this->model);

        $item = $this->model::findOrFail($id);
        return view($this->viewPath . '.edit', compact('item'));
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

    public function destroy(Request $request, $id)
    {
        // $this->authorize('delete', $this->model);

        try {
            $item = $this->model::findOrFail($id);
            $item->delete();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => __('messages.' . class_basename($this->model) . ' deleted successfully'),
                ]);
            }

            return redirect()->route($this->routePrefix . '.index')
                ->with('success', __('messages.' . class_basename($this->model) . ' deleted successfully'));
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('messages.' . class_basename($this->model) . ' deleted failed'),
                    'errors' => $e->getMessage()
                ], 422);
            }

            return back()->withErrors(['error' => __('messages.' . class_basename($this->model) . ' deleted failed')]);
        }
    }

    protected function getUpdateValidationRules($id)
    {
        return $this->validationRules;
    }
}
