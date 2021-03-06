<?php

namespace App\Http\Controllers\User;

use App\Events\GetRequestEvent;
use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CashController extends Controller
{
    public function CashOrder(Request $request)
    {

        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        // dd($charge);

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'notes' => $request->notes,

            'payment_type' => 'Cash On Delivery',
            'payment_method' => 'Cash On Delivery',

            'currency' => 'Usd',
            'amount' => $total_amount,

            'invoice_no' => 'EOS' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),

        ]);

        // Start Send Email
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,

        ];

        Mail::to($request->email)->send(new OrderMail($data));

        // End Send Email

        $carts = Cart::content();
        foreach ($carts as $cart) {
            $Pattributes = '';
            if ($cart->options->attributes) {
                foreach ($cart->options->attributes as $key => $value) {
                    $Pattributes .= $value . ',';
                }
            }
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'attributes' => $Pattributes,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),

            ]);
        }

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        $notification = array(
            'message' => 'Your Order Place Successfully',
            'alert-type' => 'success',
        );

        $message = array(
            'message' => 'an order made by ' . Auth::user()->name,
            'order_id' => $order_id,
        );

        event(new GetRequestEvent($message));
        return redirect()->route('dashboard')->with($notification);

    } // end method

}
