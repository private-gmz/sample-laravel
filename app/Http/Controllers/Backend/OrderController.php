<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use DB;
use PDF;

class OrderController extends Controller
{

    // Pending Orders
    public function PendingOrders()
    {
        $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();
        return view('backend.orders.pending_orders', compact('orders'));

    } // end mehtod

    // Pending Order Details
    public function PendingOrdersDetails($order_id)
    {

        $order = Order::with('city', 'district', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('backend.orders.pending_orders_details', compact('order', 'orderItem'));

    } // end method

    // Confirmed Orders
    public function ConfirmedOrders()
    {
        $orders = Order::where('status', 'confirm')->orderBy('id', 'DESC')->get();
        return view('backend.orders.confirmed_orders', compact('orders'));

    } // end mehtod

    // Processing Orders
    public function ProcessingOrders()
    {
        $orders = Order::where('status', 'processing')->orderBy('id', 'DESC')->get();
        return view('backend.orders.processing_orders', compact('orders'));

    } // end mehtod

    // Picked Orders
    public function PickedOrders()
    {
        $orders = Order::where('status', 'picked')->orderBy('id', 'DESC')->get();
        return view('backend.orders.picked_orders', compact('orders'));

    } // end mehtod

    // Shipped Orders
    public function ShippedOrders()
    {
        $orders = Order::where('status', 'shipped')->orderBy('id', 'DESC')->get();
        return view('backend.orders.shipped_orders', compact('orders'));

    } // end mehtod

    // Delivered Orders
    public function DeliveredOrders()
    {
        $orders = Order::where('status', '=', "delivered")->orderBy('id', 'DESC')->get();
        return view('backend.orders.delivered_orders', compact('orders'));

    } // end mehtod

    // Cancel Orders
    public function CancelOrders()
    {
        $orders = Order::where('cancel_order', '!=', 0)->orderBy('id', 'DESC')->get();
        return view('backend.orders.cancel_orders', compact('orders'));

    } // end mehtod

    public function CancelRequestApprove($order_id)
    {
        Order::where('id', $order_id)->update(['cancel_order' => 2]);

        $notification = array(
            'message' => 'Cancel Order Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    }

    public function PendingToConfirm($order_id)
    {

        Order::findOrFail($order_id)->update(['status' => 'confirm', 'confirmed_date' => Carbon::now()]);

        $notification = array(
            'message' => 'Order Confirm Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('pending-orders')->with($notification);

    } // end method

    public function ConfirmToProcessing($order_id)
    {

        Order::findOrFail($order_id)->update(['status' => 'processing', 'processing_date' => Carbon::now()]);

        $notification = array(
            'message' => 'Order Processing Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('confirmed-orders')->with($notification);

    } // end method

    public function ProcessingToPicked($order_id)
    {

        Order::findOrFail($order_id)->update(['status' => 'picked', 'picked_date' => Carbon::now()]);

        $notification = array(
            'message' => 'Order Picked Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('processing-orders')->with($notification);

    } // end method

    public function PickedToShipped($order_id)
    {

        Order::findOrFail($order_id)->update(['status' => 'shipped', 'shipped_date' => Carbon::now()]);

        $notification = array(
            'message' => 'Order Shipped Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('picked-orders')->with($notification);

    } // end method

    public function ShippedToDelivered($order_id)
    {

        $product = OrderItem::where('order_id', $order_id)->get();
        foreach ($product as $item) {
            Product::where('id', $item->product_id)
                ->update(['product_qty' => DB::raw('product_qty-' . $item->qty)]);
        }

        Order::findOrFail($order_id)->update(['status' => 'delivered', 'delivered_date' => Carbon::now()]);

        $notification = array(
            'message' => 'Order Delivered Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('shipped-orders')->with($notification);

    } // end method

    public function AdminInvoiceDownload($order_id)
    {

        $order = Order::with('city', 'district', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        $pdf = PDF::loadView('backend.orders.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    } // end method

    public function deleteOrder($order_id)
    {

        Order::find($order_id)->delete();
        $notification = array(
            'message' => 'Order Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    } // end method

}
