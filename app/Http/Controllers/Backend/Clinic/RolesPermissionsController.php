<?php

namespace App\Http\Controllers\Backend\Clinic;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RolesPermissionsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::where('guard_name', 'web')->orderBy('id', 'DESC')->paginate(5);
        return view('backend.dashboards.clinic.pages.roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function data()
    {
        $roles = Role::where('guard_name', 'web');

        return DataTables::of($roles)

            ->addColumn('actions', function ($role) {
                return ' <button class="btn btn-warning btn-sm editRole" data-id="' . $role->id . '">
                    <i class="fa fa-edit"></i>
                </button>
                <button class="btn btn-danger btn-sm deleteRole" data-id="' . $role->id . '">
                    <i class="fa fa-trash"></i>
                </button>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }

    public function permissions()
    {
        $permissions = Permission::where('guard_name', 'web')->get();
        return response()->json($permissions);
    }



    public function store(Request $request)
{
    $this->validate($request, [
        'name' => 'required|unique:roles,name',
        'permissions' => 'required|array', // Ensure it's an array
        'permissions.*' => 'exists:permissions,id', // Ensure each permission exists
    ]);

    // Create the role
    $role = Role::create([
        'name' => $request->input('name'),
        'guard_name' => 'web',
    ]);

    // Sync permissions properly
    $role->syncPermissions($request->input('permissions'));

    return response()->json([
        'status' => 'success',
        'message' => 'Role created successfully',
    ]);
}



    
    public function edit($id)
{
    $role = Role::find($id);
    $permissions = Permission::where('guard_name', 'web')->get();
    $rolePermissions = DB::table("role_has_permissions")
        ->where("role_id", $id)
        ->pluck('permission_id')
        ->toArray();

    return response()->json([
        'status' => 'success',
        'role' => $role,
        'permissions' => $permissions,
        'rolePermissions' => $rolePermissions
    ]);
}

public function update(Request $request, $id)
{
    $this->validate($request, [
        'name' => 'required',
        'permissions' => 'required|array', // Ensure it's an array
        'permissions.*' => 'exists:permissions,id', // Validate each permission exists
    ]);

    $role = Role::findOrFail($id); // Use findOrFail to handle invalid IDs
    $role->update(['name' => $request->input('name')]);

    // Sync permissions correctly
    $role->syncPermissions($request->input('permissions'));

    return response()->json([
        'status' => 'success',
        'message' => 'Role updated successfully',
    ]);
}


    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Role deleted successfully',
        ]);
    }
}
