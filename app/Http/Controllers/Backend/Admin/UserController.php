<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    //

    public function index()
    {

        $users = User::with('roles')->get();
        $roles = Role::pluck('name', 'name')->all();

        return view('backend.dashboards.admin.pages.users.index', compact('users', 'roles'));
    }

    public function data()
{
    $users = User::with(['roles','clinic'])->select('id', 'name', 'email','clinic_id')->get();

    return DataTables::of($users)
        ->addColumn('roles', function ($user) {
            return $user->roles->map(function ($role) {
                return '<span class="badge bg-dark text-white">' . $role->name . '</span>';
            })->implode(' ');
        })
        ->addColumn('actions', function ($user) {
            return '<button class="btn btn-warning btn-sm editUser" data-id="' . $user->id . '">
                        <i class="fa fa-edit"></i>
                    </button>';
        })
        ->addColumn('clinic', function ($user) {
            return $user->clinic->name ?? 'N/A';
        })
        ->rawColumns(['roles', 'actions'])
        ->make(true);
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'roles' => 'required|array'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
    
    $user->assignRole($request->roles);

    return response()->json(['success' => 'User added successfully!']);
}

    public function update(Request $request, $id)
    {

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                // 'password' => 'required',

            ],
            [
                'name.required' => 'يجب أدخال أسم المستخدم',
                'email.required' => 'يجب أدخال البريد الألكترونى',
                // 'password.required'=>'يجب أدخال كلمة المرور',

            ]
        );

        try {

            $user = User::findorFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password ? Hash::make($request->password) : $user->password;
            $user->save();
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($request->input('roles'));

            return redirect()->route('backend.users.index')->with('success', 'Patient added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['success' => 'User deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }
    
}
