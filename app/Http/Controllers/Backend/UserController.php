<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use DB;

class UserController extends Controller
{
    //
    public function index(){

        // get all users
        $users = User::all();

        return view('backend.pages.users.index',compact('users'));

    }

    public function add(){
        $roles = Role::pluck('name','name')->all();
        // return add user view
        return view('backend.pages.users.add',compact('roles'));

    }

    public function store(StoreUserRequest $request){


        $request->validate();

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            
            $user->assignRole($request->input('roles'));

            return redirect()->route('backend.users.index')->with('success', 'Patient added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }




    }

    public function edit($id){

        // // get user based on user_id
        // $user = User::findOrFail($id);
        // $roles = Role::pluck('name')->all();
        // // dd($roles);
        // $userRole = $user->roles;
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('backend.pages.users.edit',compact('user','roles','userRole'));
        
        
    }

    public function update(Request $request,$id){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            // 'password' => 'required',
            
           ],
           [
            'name.required'=>'يجب أدخال أسم المستخدم',
            'email.required'=>'يجب أدخال البريد الألكترونى',
            // 'password.required'=>'يجب أدخال كلمة المرور',
            
           ]
        );

        // try{
            // dd($request->all());

            $user = User::findorFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password ? Hash::make($request->password) : $user->password;
            // $user->roles = $request->roles;
            $user->save();
  
            DB::table('model_has_roles')->where('model_id',$id)->delete();
    
            $user->assignRole($request->input('roles'));
        
            return redirect()->route('backend.users.index')->with('success', 'Patient added successfully');
            
    
    
            // } catch (\Exception $e) {
            //     return redirect()->back()->with('error', 'Something went wrong');
            // }
    
    
        
    }
}
