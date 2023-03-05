<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;

class StripeController extends Controller
{
    public function stripe_order(Request $request){
        $total_amount =Cart::total();
        //replace comma in total price
        
        $total = str_replace(",","",$total_amount);
        $total_price = (float)$total;

        // $total = ((float)($total_amount));
        // $total = floatval($total_amount);
        // var_dump($total);
        // var_dump(str_replace(",","",$total_amount));
        // $total_amount = Cart::total();
        // dd($total_price);

// $i = "25,25.00";
// $j = (float)$i;
// dd($j);

        \Stripe\Stripe::setApiKey('sk_test_51KK6g7JPRcCF9jDyzAig5biknDtzj0b3TGnF4VyuV340uW7Bo4FuF4ovSrXicKsFizBLe0YG5CD0QU4yJUr6L9ZK00lrf5a6yh');


        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
        'amount' => $total_price * 100,
        'currency' => 'usd',
        'description' => 'Sky Light ',
        'source' => $token,
        'metadata' => ['order_id' => uniqid()],
        ]);
        dd($charge);
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'notes' => $request->notes,


            'payment_method' => 'Stripe',
            'payment_type' => $charge->payment_method,
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,

            'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),

        ]);

        $carts = Cart::content();
        foreach($carts as $cart){
            OrderItem::insert([
                'order_id'=>$order_id,
                'product_id'=>$cart->id,
                'color'=>$cart->options->color,
                'size'=>$cart->options->size,
                'qty'=>$cart->qty,
                'price'=>$total_amount,
                'created_at' => Carbon::now(),
            ]);
        }
        Cart::destroy();
        $notification = array(
			'message' => 'Your Order Place Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('dashboard')->with($notification);

    }
}
