<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function AddToCart(Request $request,$id){
        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL) {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],

            ]);
            return response()->json(['success' =>'Successfully Added To Your Cart']);
        }
        else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],

            ]);
            return response()->json(['success' =>'Successfully Added To Your Cart']);
        }
    }
    //mini cart section
    public function AddMiniCart(){
        $carts = Cart::content();
        $cartsQty = Cart::count();
        $cartTotal = Cart::total();


        return response()->json(array(
            'carts'=> $carts ,
            'cartsQty'=> $cartsQty ,
            'cartTotal'=> $cartTotal ,
        ));
    }//end mini cart section

    //RemoveMiniCart method start

    public function RemoveMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' =>'Product Remove From Cart']);
    }
    //RemoveMiniCart method end

    // AddToWishList method start
    public function AddToWishList(Request $request,$product_id){
        
    }
    // AddToWishList method end

}
