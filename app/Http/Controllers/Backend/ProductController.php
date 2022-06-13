<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;

use App\Models\Product;
use App\Models\MultiImg;
use Carbon\Carbon;
use Image;

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

         ////////// Multiple Image Upload Start ///////////

      $images = $request->file('multi_img');
      foreach ($images as $img) {
      	$make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
    	Image::make($img)->resize(917,1000)->save('upload/products/multi_image/'.$make_name);
    	$uploadPath = 'upload/products/multi_image/'.$make_name;

    	MultiImg::insert([

    		'product_id' => $product_id,
    		'photo_name' => $uploadPath,
    		'created_at' => Carbon::now(), 

    	]);
    }

        $notification = array(
            'message' =>'Products Inserted Successfully',
            'alert-type'=>"success",
        );
        return Redirect()->route('manage-products')->with($notification);

    }

    public function ProductShow(){
        $products = Product::latest()->get();
        return view('backend.product.product_manage',compact('products'));
    }

    public function ProductEdit($id){
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $multiImgs = MultiImg::where('product_id',$id)->get();
        $products = Product::findOrFail($id);
        return view('backend.product.product_edit',compact('brands','categories','subcategories','subsubcategories','products','multiImgs'));

    }
    public function ProductUpdate(Request $request){
        $product_id = $request->id;
        Product::findOrFail($product_id)->update([
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
 
           
            'hot_deals'=>$request->hot_deals, 
            'featured'=>$request->featured, 
            'special_offer'=>$request->special_offer, 
            'special_deals'=>$request->special_deals, 
            'status'=>1, 
            'created_at'=>Carbon::now(), 
         ]);
         $notification = array(
            'message' =>'Products Updated Without Image Successfully',
            'alert-type'=>"success",
        );
        return Redirect()->route('manage-products')->with($notification);

    }
    public function MultiImageUpdate(Request $request){
        $imgs = $request->multi_img;
        foreach($imgs as $id =>$img){
            $imgDel = MultiImg::findOrFail($id);
            unlink( $imgDel ->photo_name);
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/products/multi_image/'.$make_name);
            $uploadPath = 'upload/products/multi_image/'.$make_name; 

            MultiImg::where('id',$id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
        }//end foreach
        $notification = array(
            'message' =>'Products Image Updated Successfully',
            'alert-type'=>"success",
        );
        return Redirect()->back()->with($notification);
    }

    //Thambnail Image Update
    public function ThambImageUpdate(Request $request){
        $pro_id = $request->id;
        $oldImg = $request->old_img;
        unlink($oldImg);

        $image = $request->file('product_thambnail');
        $image_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$image_gen);
        $save_url = 'upload/products/thambnail/'.$image_gen;

        Product::findOrFail($pro_id)->update([
            'product_thambnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' =>'Products Image Updated Successfully',
            'alert-type'=>"success",
        );
        return Redirect()->back()->with($notification);

    }

}
