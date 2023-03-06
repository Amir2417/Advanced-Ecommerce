<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class AllUserController extends Controller
{
    public function my_orders(){
        $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->paginate(6);
        return view('frontend.user.order.order_view',compact('orders'));
    }
}
