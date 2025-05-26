<?php

namespace App\Http\Controllers\Backend\MedicalLaboratory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreUserRequest;
use App\Models\MedicalLaboratory;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{


    public function index()
    {

        $users = User::with('roles')->get();
        $roles = Role::where('guard_name','=','medical_laboratory')->get();


        return view('backend.dashboards.medicalLaboratory.pages.users.index', compact('users', 'roles'));
    }

    public function data()
    {
        $users = User::
        fromSameOrganization()
        ->with(['roles','organization'])
        ->select('id', 'name', 'email', 'organization_id', 'organization_type')
        ->get();


        return DataTables::of($users)
            ->addColumn('actions', function ($user) {
                return '<button class="btn btn-warning btn-sm" onclick="editUser(' . $user->id . ')">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="deleteUser(' . $user->id . ')">
                        <i class="fa fa-trash"></i>
                    </button>';
            })
            ->addColumn('organization', function ($user) {
                if ($user->organization) {
                    return $user->organization->name;
                }
                return 'N/A';
            })
            
            ->addColumn('roles', function ($user) {
                $roles = $user->roles->pluck('name');
                $rolesWithBadges = $roles->map(function ($role) {
                    return '<span class="badge bg-primary text-white" style="font-size: 14px;">' . $role . '</span>';
                })->implode(' ');

                return $rolesWithBadges;
            })
            ->rawColumns(['roles', 'actions', 'organization', 'roles'])
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
            'organization_id' => auth()->user()->organization_id,
            'organization_type'=>MedicalLaboratory::class
        ]);

        $user->assignRole($request->roles);

        return response()->json(['success' => 'User added successfully!']);
    }

    public function edit($id)
{
    $user = User::with('roles')->findOrFail($id);
    $userRole = $user->roles->pluck('name', 'name')->all();
    return response()->json([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'roles' => $user->roles->pluck('name'),
        'userRole' => $userRole
    ]);
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
