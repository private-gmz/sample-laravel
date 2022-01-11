<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Models\AttributesVal;
use Illuminate\Http\Request;

class AttributesValController extends Controller
{
    public function ValuesView()
    {

        $attributes = Attributes::orderBy('name', 'ASC')->get();
        $values = AttributesVal::latest()->get();
        return view('backend.values.values_view', compact('values', 'attributes'));

    }

    public function ValuesStore(Request $request)
    {

        $request->validate([
            'attribute_id' => 'required',
            'value_name' => 'required',
        ], [
            'attribute_id.required' => 'Please select Any option',
            'value_name.required' => 'Input SubCategory English Name',
        ]);

        AttributesVal::insertOrIgnore([
            'attribute_id' => $request->attribute_id,
            'name' => $request->value_name,
        ]);

        $notification = array(
            'message' => 'Value Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    } // end method

    public function ValuesUpdate($name, $id)
    {

        AttributesVal::findOrFail($id)->update([
            'name' => $name,
        ]);

        $notification = array(
            'message' => 'Value Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.values')->with($notification);

    } // end method

    public function ValuesDelete($id)
    {

        AttributesVal::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Value Deleted Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);

    }

}
