<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    public function pending_confirm($order_id){
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
    public function confirm_processing($order_id){
        Order::findOrFail($order_id)->update(['status'=>'processing']);
        $notification = array(
			'message' => 'Order Processing Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('admin.confirm.orders')->with($notification);
    }
}
