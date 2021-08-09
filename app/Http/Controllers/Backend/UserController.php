<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Hash;

class UserController extends BackendController
{
    //
    public function userProfile()
    {
        return view($this->_mainpages . 'user.profile');
    }

    public function userList()
    {
        $users = User::with('roles')->orderBy('id', 'DESC')->get();

        return view($this->_mainpages . 'user.index', compact('users'));
    }

    public function adminList()
    {
        $users = User::whereRoleIs(['admin'])->get();
        return view($this->_mainpages . 'user.adminlist', compact('users'));

    }

    public function vendorList()
    {
        $users = User::whereRoleIs(['vendor'])->get();
        return view($this->_mainpages . 'user.vendorlist', compact('users'));
    }

    public function edit($id)
    {
        $users = User::with('roles')->orderBy('id', 'DESC')->get();
        $user = User::findOrFail($id);
        return view($this->_mainpages . 'user.index', compact('user', 'users'));

    }

    public function customerList()
    {
        $users = User::whereRoleIs(['user'])->get();
        return view($this->_mainpages . 'user.adminlist', compact('users'));
    }

    public function userAdd(Request $request)
    {
        $data=$request->validate([
                'email' => 'required|email',
                'name' => 'required',
                'role' => 'required',
                'user_type'=>'',
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required| min:6'
            ]
        );
        try {
            $user=new User();
            $user->user_type=$request->role;
            $user->fill($data);
            $user->password=bcrypt($request->password);
            $success=$user->save();
            $user->attachRole($request->role);
            if ($user) {
                return redirect()->back()->with('status', 'User Successfully Created');
            }
        } catch (Throwable $e) {
            dd($e->getMessage());
        }

    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
                'email' => 'required|email',
                'name' => 'required',
                'role' => 'required',
                'password' => 'confirmed',
                'password_confirmation' => ''
            ]
        );

        try {
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $user->syncRoles([$request->role]);
            if ($user) {
                return redirect()->back()->with('status', 'User Succesfully Updated');
            }
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->detachRole($user);
        $user->detachPermission($user);
        $delete = $user->delete();
        if ($delete) {
            return redirect()->back()->with('status', 'Successfully Deleted');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

}
