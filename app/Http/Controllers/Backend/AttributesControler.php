<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use Illuminate\Http\Request;

class AttributesControler extends Controller
{
    public function AttributesView()
    {

        $attributes = Attributes::latest()->get();
        return view('backend.attributes.attributes_view', compact('attributes'));

    }

    public function AttributesStore(Request $request)
    {

        $request->validate([
            'attribute_name' => 'required',
        ], [
            'attribute_name.required' => 'You should name your attribute',
        ]);

        Attributes::insert([
            'name' => $request->attribute_name,
        ]);

        $notification = array(
            'message' => 'Attribute Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    } // end method

    public function AttributesUpdate($name, $id)
    {

        Attributes::findOrFail($id)->update([
            'name' => $name,

        ]);

        $notification = array(
            'message' => 'Attribute Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.attribites')->with($notification);

    } // end method

    public function AttributesDelete($id)
    {

        Attributes::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Attribute Deleted Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);

    } // end method
}
