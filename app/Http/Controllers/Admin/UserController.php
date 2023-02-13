<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(){

        // get all users
        $users = User::all();

        return view('admin.users.index',compact('users'));

    }

    public function add(){

        // return add user view
        return view('admin.users.add');

    }

    public function store(Request $request){


        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'power' =>'required'
           ]);

        try {
            // create new instance of User model
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->power = $request->power;
            $user->save();

            return redirect()->route('admin.users.index')->with('success', 'Patient added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }




    }

    public function edit($id){

        // get user based on user_id
        $user = User::find($id);
        
        return view('admin.users.edit', compact('user'));
        
    }

    public function update(Request $request,$id){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'power' =>'required'
           ]);

        try{

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->power = $request->power;
            
            $user->save();
            return redirect()->route('admin.users.index')->with('success', 'Patient added successfully');
            
    
    
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Something went wrong');
            }
    
    
        
    }
}
