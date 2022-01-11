<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RoleModel;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function RolesView()
    {

        $roles = RoleModel::latest()->get();
        return view('backend.roles.roles_view', compact('roles'));

    }

    public function RolesStore(Request $request)
    {

        $request->validate([
            'role_name' => 'required',
        ], [
            'role_name.required' => 'You should name the role',
        ]);

        RoleModel::insert([
            'name' => $request->role_name,
        ]);

        $notification = array(
            'message' => 'Role Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    } // end method

    public function RolesUpdate($name, $id)
    {

        RoleModel::findOrFail($id)->update([
            'name' => $name,

        ]);

        $notification = array(
            'message' => 'Role Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.roles')->with($notification);

    } // end method

    public function RolesDelete($id)
    {

        RoleModel::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);

    } // end method
}
