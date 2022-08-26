<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function index(){
        $coupons = Coupon::orderBy('id','DESC')->get();
        return view('backend.coupon.index',compact('coupons'));
    }
    public function show(){
        return view('backend.coupon.create');
    }
    public function store(Request $request){
        $request->validate([
            'coupon_name'=>'required',
            'coupon_discount'=>'required',
            'coupon_validity'=>'required',
        ]);
        Coupon::insert([
            'coupon_name' =>strtoupper($request->coupon_name),
            'coupon_discount' =>$request->coupon_discount,
            'coupon_validity' =>$request->coupon_validity,
            'created_at'=>Carbon::now(),
        ]);
        $notification = array(
            'message' => "Coupon Inserted Succesfully",
            'alert-type'=>'success',
        );
        return Redirect()->route('coupons')->with($notification);

    }


}
