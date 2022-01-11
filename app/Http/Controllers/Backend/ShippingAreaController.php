<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipCity;
use App\Models\ShipDistrict;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{

    public function CityView()
    {
        $cities = ShipCity::orderBy('id', 'DESC')->get();
        return view('backend.ship.city.view_city', compact('cities'));

    }

    public function CityStore(Request $request)
    {

        $request->validate([
            'city_name' => 'required',

        ]);

        ShipCity::insert([

            'city_name' => $request->city_name,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'City Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    } // end method

    public function CityEdit($id)
    {

        $cities = ShipCity::findOrFail($id);
        return view('backend.ship.city.edit_city', compact('cities'));
    }

    public function CityUpdate(Request $request, $id)
    {

        ShipCity::findOrFail($id)->update([

            'city_name' => $request->city_name,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'City Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('manage-city')->with($notification);

    } // end mehtod

    public function CityDelete($id)
    {

        ShipCity::findOrFail($id)->delete();

        $notification = array(
            'message' => 'City Deleted Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);

    } // end method

    //// Start Ship District

    public function DistrictView()
    {
        $city = ShipCity::orderBy('city_name', 'ASC')->get();
        $district = ShipDistrict::with('city')->orderBy('id', 'DESC')->get();
        return view('backend.ship.district.view_district', compact('city', 'district'));
    }

    public function DistrictStore(Request $request)
    {

        $request->validate([
            'city_id' => 'required',
            'district_name' => 'required',

        ]);

        ShipDistrict::insert([

            'city_id' => $request->city_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'District Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    } // end method

    public function DistrictEdit($id)
    {

        $city = ShipCity::orderBy('city_name', 'ASC')->get();
        $district = ShipDistrict::findOrFail($id);
        return view('backend.ship.district.edit_district', compact('district', 'city'));
    }

    public function DistrictUpdate(Request $request, $id)
    {

        ShipDistrict::findOrFail($id)->update([

            'city_id' => $request->city_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'District Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('manage-district')->with($notification);

    } // end mehtod

    public function DistrictDelete($id)
    {

        ShipDistrict::findOrFail($id)->delete();

        $notification = array(
            'message' => 'District Deleted Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);

    } // end method

    //// End Ship District

}
