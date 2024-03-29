<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;
use Illuminate\Support\Facades\Hash;
use Image;

class IndexController extends Controller
{
    public function index(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $products = Product::where('status',1)->orderBy('id','DESC')->get();
        $featured = Product::where('status',1)->where('featured',1)->orderBy('id','DESC')->get();
        $hotDeals = Product::where('status',1)->where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
        $specialOffer = Product::where('status',1)->where('special_offer',1)->orderBy('id','DESC')->limit(3)->get();
        $specialDeals = Product::where('status',1)->where('special_deals',1)->orderBy('id','DESC')->limit(3)->get();
        //skip function
        // $skip_category_0 = Category::skip(0)->first();
        // $skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->get();

        // $skip_category_1 = Category::skip(1)->first();
        // $skip_product_1 = Product::where('status',1)->where('category_id',$skip_category_1->id)->orderBy('id','DESC')->get();

        // $skip_brand_0 = Brand::skip(0)->first();
        // $skip_brand_product_0 = Product::where('status',1)->where('brand_id',$skip_brand_0->id)->orderBy('id','DESC')->get();,'skip_category_0','skip_product_0','skip_category_1','skip_product_1','skip_brand_0','skip_brand_product_0'



        return view('frontend.index',compact('categories','sliders','products','featured','hotDeals','specialOffer','specialDeals'));
    }
    public function UserLogout(){
        Auth::logout();
        return Redirect()->route('login');
    }
    public function UserProfile(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile',compact('user'));
    }
    public function UserProfileStore(Request $request){
        $data = User::find(Auth::user()->id);
        $data -> name = $request ->name;
        $data -> email = $request ->email;
        $data -> phone = $request -> phone;

        if($request->file('profile_photo_path')){
            $file = $request -> file('profile_photo_path');
            // @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
            $filename = date('TmdHmi').$file->getClientOriginalName();
            $file->move(('upload/user_images'),$filename);
            $data['profile_photo_path'] = $filename;

        //     $image = $request->file('profile_photo_path');
        // $image_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // Image::make($image)->resize(300,300)->save('upload/user_images/'.$image_gen);
        // $save_url = 'upload/user_images/'.$image_gen;
        }
        $data->save();
        $notification = array(
            'message' =>'User Profile Updated Successfully',
            'alert-type'=>"success",
        );
        return Redirect()->route('dashboard')->with($notification);
    }
    public function UserChangePassword(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password',compact('user'));

    }
    public function UserPasswordUpdate(Request $request){
       $validatedData = $request ->validate([
        'oldpassword' =>'required',
        'password' =>'required|confirmed',
       ]);

       $hashPassword = Auth::user()->password;
       if( Hash::check($request->oldpassword,$hashPassword)){
           $user = User::find(Auth::id());
           $user ->password = Hash::make($request->password);
           $user->save();
           Auth::logout();
           $noitifation = array(
               'message' => 'Password Change Successfully',
               'alert-type'=>'primary',
           );
           return Redirect()->route('user.logout')->with($noitifation);
       }
       else{
           return Redirect()->back();
       }
    }
    public function ProductDetails($id,$slug){


        $products = Product::findOrFail($id);


        $color_en = $products->product_color_en;
        $product_color_en = explode(',',$color_en);

        $color_ban = $products->product_color_ban;
        $product_color_ban = explode(',',$color_ban);

        $size_en = $products->product_size_en;
        $product_size_en = explode(',',$size_en);

        $size_ban = $products->product_size_ban;
        $product_size_ban = explode(',',$size_ban);

        $cat_id = $products->category_id;
        $related_products = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->get();

        $image = MultiImg::where('product_id',$id)->get();
        $hotDeals = Product::where('status',1)->where('hot_deals',1)->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.product.product_details',compact('products','image','hotDeals','product_color_en','product_color_ban','product_size_en','product_size_ban','related_products'));
    }

    public function TagWiseProduct($tag){

        if(session()->get('language')=='bangla'){
            $products = Product::where('status',1)->where('product_tags_ban',$tag)->orderBy('id','DESC')->paginate(3);
        }
        else{
            $products = Product::where('status',1)->where('product_tags_en',$tag)->orderBy('id','DESC')->paginate(3);
        }

		$categories = Category::orderBy('category_name_en','ASC')->get();
		return view('frontend.tag.tags_view',compact('products','categories'));

	}
    public function SubCatProduct($subcat,$slug){

        $products = Product::where('status',1)->where('subcategory_id',$subcat)->orderBy('id','DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en','ASC')->get();
		return view('frontend.product.subcat_view',compact('products','categories'));

	}
    public function SubSubCatProduct($subsubcat,$slug){

        $products = Product::where('status',1)->where('subsubcategory_id',$subsubcat)->orderBy('id','DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en','ASC')->get();
		return view('frontend.product.subsubcat_view',compact('products','categories'));

	}
    public function ViewAjax($id){

        $products = Product::with('category','brand')->findOrFail($id);


        $color = $products->product_color_en;
        $product_color = explode(',',$color);

        $size = $products->product_size_en;
        $product_size = explode(',',$size);
        return response()->json(array(
            'product' => $products,
            'color' => $product_color,
            'size' => $product_size,

        ));


	}


}
