<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function pending(){
        $orders = Order::where('status','pending')->orderBy('id','DESC')->paginate(10);
        return view('backend.orders.pending_orders',compact('orders'));
    }
    public function pending_details($order_id){
        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();

        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        return view('backend.orders.pending_details',compact('order','orderItem'));
    }
    public function pendingToconfirm($order_id){
        Order::findOrFail($order_id)->update(['status'=>'confirm']);
        $notification = array(
			'message' => 'Order Confirm Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('admin.pending.orders')->with($notification);
    }
    public function confirm(){
        $orders = Order::where('status','confirm')->orderBy('id','DESC')->paginate(10);
        return view('backend.orders.confirm_orders',compact('orders'));
    }
    public function confirmToprocessing($order_id){
        Order::findOrFail($order_id)->update(['status'=>'processing']);
        $notification = array(
			'message' => 'Order Processing Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('admin.confirm.orders')->with($notification);
    }
    public function processing(){
        $orders = Order::where('status','processing')->orderBy('id','DESC')->paginate(10);
        return view('backend.orders.processing_orders',compact('orders'));
    }
    public function picked(){
        $orders = Order::where('status','picked')->orderBy('id','DESC')->paginate(10);
        return view('backend.orders.picked_orders',compact('orders'));
    }
    public function shipped(){
        $orders = Order::where('status','shipped')->orderBy('id','DESC')->paginate(10);
        return view('backend.orders.shipped_orders',compact('orders'));
    }
    public function delivered(){
        $orders = Order::where('status','delivered')->orderBy('id','DESC')->paginate(10);
        return view('backend.orders.delivered_orders',compact('orders'));
    }
    public function cancel(){
        $orders = Order::where('status','cancel')->orderBy('id','DESC')->paginate(10);
        return view('backend.orders.cancel_orders',compact('orders'));
    }
    public function processingTopicked($order_id){
        Order::findOrFail($order_id)->update(['status'=>'picked']);
        $notification = array(
			'message' => 'Order Picked Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('admin.processing.orders')->with($notification);
    }
    public function pickedToshipped($order_id){
        Order::findOrFail($order_id)->update(['status'=>'shipped']);
        $notification = array(
			'message' => 'Order Shipped Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('admin.picked.orders')->with($notification);
    }
    public function shippedTodelivered($order_id){
        Order::findOrFail($order_id)->update(['status'=>'delivered']);
        $notification = array(
			'message' => 'Order Delivered Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('admin.shipped.orders')->with($notification);
    }
    public function order_invoice($order_id){
        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();

        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        $pdf = PDF::loadView('backend.orders.order_invoice',compact('order','orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }
}
