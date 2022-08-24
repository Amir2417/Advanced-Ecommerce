<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartPageController extends Controller
{
    public function ViewMyCart(){
        return view('frontend.cart.view_cart');
    }
    public function GetCartlistProduct(){
        $carts = Cart::content();
        $cartsQty = Cart::count();
        $cartTotal = Cart::total();


        return response()->json(array(
            'carts'=> $carts ,
            'cartsQty'=> $cartsQty ,
            'cartTotal'=> $cartTotal ,
        ));
    }
}
