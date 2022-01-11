<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ShipCity;
use App\Models\ShipDistrict;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function DistrictGetAjax($city_id)
    {

        $ship = ShipDistrict::where('city_id', $city_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($ship);

    } // end method

    public function CheckoutStore(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['city_id'] = $request->city_id;
        $data['district_id'] = $request->district_id;
        $data['city_name'] = ShipCity::where('id', $request->city_id)->pluck('city_name')->first();
        $data['district_name'] = ShipDistrict::where('id', $request->city_id)->pluck('district_name')->first();
        $data['address'] = $request->address;
        $data['notes'] = $request->notes;
        $cartTotal = Cart::total();

        return view('frontend.payment.cash', compact('data', 'cartTotal'));

    } // end mehtod.

}
