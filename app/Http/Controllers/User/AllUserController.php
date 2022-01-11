<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class AllUserController extends Controller
{
    public function MyOrders()
    {

        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        return view('frontend.user.order.order_view', compact('orders'));

    } // end mehtod

    public function OrderDetails($order_id)
    {

        $order = Order::with('city', 'district', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('frontend.user.order.order_details', compact('order', 'orderItem'));

    } // end mehtod

    public function InvoiceDownload($order_id)
    {
        $order = Order::with('city', 'district', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        // return view('frontend.user.order.order_invoice',compact('order','orderItem'));
        $pdf = PDF::loadView('frontend.user.order.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    } // end mehtod

    public function ReturnOrder(Request $request, $order_id)
    {

        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1,
        ]);

        $notification = array(
            'message' => 'Return Request Send Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('my.orders')->with($notification);

    } // end method

    public function CancelOrder(Request $request, $order_id)
    {

        Order::findOrFail($order_id)->update([
            'cancel_date' => Carbon::now()->format('d F Y'),
            'cancel_reason' => $request->cancel_reason,
            'cancel_order' => 1,
        ]);

        $notification = array(
            'message' => 'Cancel Request Send Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('my.orders')->with($notification);

    } // end method

    public function ReturnOrderList()
    {

        $orders = Order::where('user_id', Auth::id())->where('return_order', '!=', 0)->orderBy('id', 'DESC')->get();
        return view('frontend.user.order.return_order_view', compact('orders'));

    } // end method

    public function CancelOrders()
    {

        $orders = Order::where('user_id', Auth::id())->where('cancel_order', '!=', 0)->orderBy('id', 'DESC')->get();
        return view('frontend.user.order.cancel_order_view', compact('orders'));

    } // end method

    ///////////// Order Traking ///////

    public function OrderTraking(Request $request)
    {

        $tracks = Order::where('user_id', Auth::id())->get();

        if ($tracks) {

            // echo "<pre>";
            // print_r($track);

            return view('frontend.traking.track_order', compact('tracks'));

        } else {

            $notification = array(
                'message' => 'Invoice Code Is Invalid',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);

        }

    } // end mehtod

}
