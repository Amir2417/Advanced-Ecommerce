<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function stripe_order(Request $request){

\Stripe\Stripe::setApiKey('sk_test_51KK6g7JPRcCF9jDyzAig5biknDtzj0b3TGnF4VyuV340uW7Bo4FuF4ovSrXicKsFizBLe0YG5CD0QU4yJUr6L9ZK00lrf5a6yh');


$token = $_POST['stripeToken'];

$charge = \Stripe\Charge::create([
  'amount' => 999*100,
  'currency' => 'usd',
  'description' => 'Sky Light ',
  'source' => $token,
  'metadata' => ['order_id' => '6735'],
]);
dd($charge);
    }
}
