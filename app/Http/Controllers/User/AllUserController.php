<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Barryvdh\DomPDF\Facade\Pdf;

class AllUserController extends Controller
{
    public function my_orders(){
        $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->paginate(6);
        return view('frontend.user.order.order_view',compact('orders'));
    }
    public function order_details($order_id){
        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();

        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        return view('frontend.user.order.order_details',compact('order','orderItem'));
    }
    public function invoice($order_id){
        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();

        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        $pdf = PDF::loadView('frontend.user.order.order_invoice',compact('order','orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }
}
