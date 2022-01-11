<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

class AdminUserController extends Controller
{
    public function AllAdminRole()
    {

        $adminuser = Admin::with('role')->latest()->get();
        return view('backend.role.admin_role_all', compact('adminuser'));

    } // end method

    public function AddAdminRole()
    {
        return view('backend.role.admin_role_create');
    }

    public function StoreAdminRole(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        if ($request->file('profile_photo_path')) {
            $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = config('default_admin_image_path') . $name_gen;
            Image::make($image)->resize(225, 225)->save($save_url);
        } else {
            $save_url = config('default_user_image');
        }

        Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role_id' => $request->role,
            'profile_photo_path' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Admin User Created Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.admin.user')->with($notification);

    } // end method

    public function EditAdminRole($id)
    {

        $adminuser = Admin::findOrFail($id);
        return view('backend.role.admin_role_edit', compact('adminuser'));

    } // end method

    public function UpdateAdminRole(Request $request)
    {

        $admin_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('profile_photo_path')) {
            if ($old_img !== config('default_user_image')) {
                unlink($old_img);
            }

            $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = config('default_admin_image_path') . $name_gen;
            Image::make($image)->resize(225, 225)->save($save_url);
        }
        Admin::findOrFail($admin_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'profile_photo_path' => ($request->file('profile_photo_path')) ? $save_url : $old_img,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Admin User Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.admin.user')->with($notification);

    } // end method

    public function DeleteAdminRole($id)
    {

        $adminimg = Admin::findOrFail($id);
        $img = $adminimg->profile_photo_path;
        if ($img !== config('default_user_image')) {
            unlink($img);
        }

        Admin::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);

    } // end method

}
