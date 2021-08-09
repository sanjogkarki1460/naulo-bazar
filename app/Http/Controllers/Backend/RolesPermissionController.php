<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use App\Attribute;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RolesPermissionController extends BackendController
{
    //
    public function index()
    {
        $permissions = Permission::orderByDesc('id')->get();
        $roles = Role::orderByDesc('id')->get();
        return view($this->_mainpages . 'roles_permission.index', compact('permissions', 'roles'));
    }

    public function createPermission(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'display_name' => 'required',
                'description' => 'required'
            ]);
            $createPermission = Permission::create([
                'name' => $request->title,
                'display_name' => $request->display_name,
                'description' => $request->description
            ]);
            if ($createPermission) {
                return redirect()->back()->with('status', 'Permission Added Successfully');
            }
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Create Failed or Permission already exist');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }


    }

    public function updatePermission(Request $request)
    {
        $role = Role::findOrFail($request->role_id);

        $permission = Permission::findOrFail($request->permission_id);
        $role->attachPermission($permission);
        return response()->json(['status', 'Successfully Changed']);
    }

    public function deletePermission(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $permission = Permission::findOrFail($request->permission_id);
        $role->detachPermission($permission);
        return response()->json(['status', 'Successfully Changed']);
    }

    public function roles()
    {
        $roles = Role::orderByDesc('id')->get();

        return view($this->_mainpages . 'roles_permission.roles', compact('roles'));
    }

    public function createRoles(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'display_name' => 'required',
                'description' => 'required'
            ]);
            Role::create([
                'name' => $request->title,
                'display_name' => $request->display_name,
                'description' => $request->description
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }


        return redirect()->back()->with('status', 'Successfully created roles');
    }

    public function updateRoles(Request $request)
    {

        return redirect()->back();
    }

    public function deleteRoles($id)
    {
        Role::destroy($id);
        return redirect()->back()->with('status', 'Successfully Deleted Roles');
    }

}
