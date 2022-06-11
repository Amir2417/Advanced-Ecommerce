<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Product;
use App\Models\MultiImg;
use Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function AddProduct(){
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.product_add',compact('categories','brands'));
    }
    public function ProductStore(Request $request){
        $image = $request->file('product_thambnail');
        $image_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$image_gen);
        $save_url = 'upload/products/thambnail/'.$image_gen;

        $product_id = Product::insertGetId([
           'brand_id'=>$request->brand_id, 
           'category_id'=>$request->category_id, 
           'subcategory_id'=>$request->subcategory_id, 
           'subsubcategory_id'=>$request->subsubcategory_id, 

           'product_name_en'=>$request->product_name_en, 
           'product_name_ban'=>$request->product_name_ban, 
           'product_slug_en'=>strtolower(str_replace(' ','-',$request->product_name_en)), 
           'product_slug_ban'=>str_replace(' ','-',$request->product_name_ban), 
           'product_code'=>$request->product_code,

           'product_qty'=>$request->product_qty, 
           'product_tags_en'=>$request->product_tags_en, 
           'product_tags_ban'=>$request->product_tags_ban, 
           'product_size_en'=>$request->product_size_en, 
           'product_size_ban'=>$request->product_size_ban, 
           'product_color_en'=>$request->product_color_en, 
           'product_color_ban'=>$request->product_color_ban, 

           'selling_price'=>$request->selling_price, 
           'discount_price'=>$request->discount_price, 
           'short_descp_en'=>$request->short_descp_en, 
           'short_descp_ban'=>$request->short_descp_ban, 
           'long_descp_en'=>$request->long_descp_en, 
           'long_descp_ban'=>$request->long_descp_ban,

           'product_thambnail'=>$save_url,
           'hot_deals'=>$request->hot_deals, 
           'featured'=>$request->featured, 
           'special_offer'=>$request->special_offer, 
           'special_deals'=>$request->special_deals, 
           'status'=>1, 
           'created_at'=>Carbon::now(), 
        ]);

        $multi_image = $request->file('multi_img');
        foreach($multi_image as $img){
            $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/products/multi_image/'.$name_gen);
            $multi_img_save_url = 'upload/products/multi_image/'.$name_gen;
        }

        MultiImg::insert([
            'product_id'=>$product_id,
            'photo_name'=>$multi_img_save_url,
            'created_at'=>Carbon::now(), 
        ]);
        $notification = array(
            'message' =>'Products Inserted Successfully',
            'alert-type'=>"success",
        );
        return Redirect()->back()->with($notification);
    }
}
