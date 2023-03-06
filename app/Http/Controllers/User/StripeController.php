<?php

namespace App\Http\Controllers\User;

use Auth;
use Carbon\Carbon;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;

class StripeController extends Controller
{
    public function stripe_order(Request $request){

        $total_amount =Cart::total();

        //replace comma in total price

        $total = str_replace(",","",$total_amount);
        $total_price = (float)$total;

        // if (Session::has('coupon')) {
        //     $total_price = Session::get('coupon')['total_amount'];
        // } else {
        //     $total_amount =Cart::total();

        //     //replace comma in total price

        //     $total = str_replace(",","",$total_amount);
        //     $total_price = (float)$total;
        // }

        \Stripe\Stripe::setApiKey('sk_test_51KK6g7JPRcCF9jDyzAig5biknDtzj0b3TGnF4VyuV340uW7Bo4FuF4ovSrXicKsFizBLe0YG5CD0QU4yJUr6L9ZK00lrf5a6yh');

        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
        'amount' => $total_price * 100,
        'currency' => 'usd',
        'description' => 'Sky Light ',
        'source' => $token,
        'metadata' => ['order_id' => uniqid()],
        ]);
        // dd($charge);
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
            'amount' => $total_price,
            'order_number' => $charge->metadata->order_id,

            'invoice_no' => 'SL'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),

        ]);

        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no'=>$invoice->invoice_no,
            'amount'=>$total_price,
            'name'=>$invoice->name,
            'email'=>$invoice->email,
        ];
        Mail::to($request->email)->send(new OrderMail($data));

        $carts = Cart::content();
        foreach($carts as $cart){
            OrderItem::insert([
                'order_id'=>$order_id,
                'product_id'=>$cart->id,
                'color'=>$cart->options->color,
                'size'=>$cart->options->size,
                'qty'=>$cart->qty,
                'price'=>$total_price,
                'created_at' => Carbon::now(),
            ]);
        }
        // if(Session::has('coupon')){
        //     Session::forget('coupon');
        // }
        Cart::destroy();
        $notification = array(
			'message' => 'Your Order Place Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('dashboard')->with($notification);

    }
}
