<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function ViewWishList(){
        return view('frontend.wishlist.show_wishlist');
    }
    //Get Wishlist Data Method Start
    public function GetWishlistProduct(){
        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
        return response()->json($wishlist);
    }
    //Get Wishlist Data Method End

    //Remove wishlist method

    public function RemoveWishlist($id){
        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' =>'Successfully Remove The Product From The WishList']);
    }


    //Remove wishlist method end
}
