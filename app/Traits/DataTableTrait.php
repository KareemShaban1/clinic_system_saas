<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

trait DataTableTrait
{
    public function getDataTable($query, $actions = true)
    {
        $dataTable = DataTables::of($query);

        if ($actions) {
            $dataTable->addColumn('action', function ($row) {
                $actions = '';
                
                if (auth()->user()->can('edit ' . $this->getModelName())) {
                    $actions .= '<a href="' . route($this->getRoutePrefix() . '.edit', $row->id) . '" class="btn btn-sm btn-primary mx-1">
                        <i class="fas fa-edit"></i>
                    </a>';
                }
                
                if (auth()->user()->can('delete ' . $this->getModelName())) {
                    $actions .= '<button type="button" class="btn btn-sm btn-danger mx-1" onclick="deleteRecord(' . $row->id . ', \'' . $this->getRoutePrefix() . '\')">
                        <i class="fas fa-trash"></i>
                    </button>';
                }
                
                return $actions;
            });
        }

        $dataTable->rawColumns(['action']);
        
        return $dataTable->make(true);
    }

    protected function getModelName()
    {
        return strtolower(class_basename($this->model));
    }

    protected function getRoutePrefix()
    {
        return str_plural(strtolower(class_basename($this->model)));
    }
}
