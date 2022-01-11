<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

class AdminProfileController extends Controller
{

    public function AdminProfileEdit()
    {

        return view('admin.admin_profile_edit');

    }

    public function AdminProfileStore(Request $request)
    {

        $id = Auth::user()->id;
        $data = Admin::find($id);
        $data->name = $request->name;
        $data->email = $request->email;

        if ($request->file('profile_photo_path')) {
            $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = config('default_admin_image_path') . $name_gen;
            Image::make($image)->resize(225, 225)->save($save_url);
            $data['profile_photo_path'] = $save_url;
        }
        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    } // end method

    public function AdminChangePassword()
    {

        return view('admin.admin_change_password');

    }

    public function AdminUpdateChangePassword(Request $request)
    {

        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $admin = Admin::find(Auth::id());
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        } else {
            return redirect()->back();
        }

    } // end method

    public function AllUsers()
    {
        $users = User::latest()->get();
        return view('backend.user.all_user', compact('users'));
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);

    }

}
