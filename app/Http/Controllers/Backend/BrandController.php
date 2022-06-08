<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    public function BrandView(){
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view',compact('brands'));
    }
    public function BrandStore(Request $request){
        $validatedData =$request->validate([
            'brand_name_en' =>'required',
            'brand_name_hin' =>'required',
            'brand_image' =>'required',
        ],
        [
            'brand_name_en.required' =>'Please Write The Brand Name In English',
            'brand_name_hin.required' =>'Please Write The Brand Name In Bangla',
        ]);

        $image = $request->file('brand_image');
        $image_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$image_gen);
        $save_url = 'upload/brand/'.$image_gen;

        Brand::insert([
            'brand_name_en' =>$request-> brand_name_en,
            'brand_name_hin' =>$request-> brand_name_hin,
            'brand_slug_en' =>strtolower(str_replace(' ','-',$request-> brand_name_en)),
            'brand_slug_hin' =>str_replace(' ','-',$request-> brand_name_en),
            'brand_image' =>$save_url,
        ]);
        $notification = array(
            'message' =>'Admin Profile Updated Successfully',
            'alert-type'=>"success",
        );
        return Redirect()->back()->with($notification);
        
    }
}
