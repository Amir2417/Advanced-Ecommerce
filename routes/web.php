<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function(){
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard')->middleware('auth:admin');
    //All Routes For the Admin

    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
    Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');

});





//All Routes For the Home Page

Route::get('/',[IndexController::class,'index']);
Route::get('user/logout',[IndexController::class,'UserLogout'])->name('user.logout');
Route::get('user/profile',[IndexController::class,'UserProfile'])->name('user.profile');
Route::post('user/profile/store',[IndexController::class,'UserProfileStore'])->name('user.profile.store');
Route::get('user/change/password',[IndexController::class,'UserChangePassword'])->name('user.change.password');
Route::post('user/password/update',[IndexController::class,'UserPasswordUpdate'])->name('user.password.update');
//Frontend Product Deatils Page Url
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);
//subcategory wise product show
Route::get('subcategory/product/{subcat}/{slug}', [IndexController::class, 'SubCatProduct']);
//subsubcategory wise product show
Route::get('subsubcategory/product/{subsubcat}/{slug}', [IndexController::class, 'SubSubCatProduct']);
//product view modal
Route::get('/product/view/modal/{id}', [IndexController::class, 'ViewAjax']);
// add to cart store data
Route::POST('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

//Get data from Mini Cart
Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);
//Remove Mini Cart
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);
// add to WishList
Route::POST('/add-to-wishlist/{product_id}', [CartController::class, 'AddToWishList']);
// Route::POST('/coupon_apply', [CartController::class, 'coupon_apply']);
// Route::get('/coupon_calculation', [CartController::class, 'coupon_calculation']);


Route::group(['prefix'=>'user','middleware'=>['user','auth'],'namespace'=>'User'],
    function(){
        //WishList Data show
        Route::get('/wishlist',[WishlistController::class,'ViewWishList'])->name('wishlist');
        Route::get('/get-wishlist-product',[WishlistController::class,'GetWishlistProduct']);
        Route::get('/wishlist-remove/{id}',[WishlistController::class,'RemoveWishlist']);

    }
);
//Mycart Data show
Route::get('/mycart',[CartPageController::class,'ViewMyCart'])->name('mycart');
Route::get('/user/get-cart-product',[CartPageController::class,'GetCartlistProduct']);
Route::get('/user/cart-remove/{rowId}',[CartPageController::class,'RemoveCart']);
Route::get('/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);
Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);


// All Routes For Brands Section
Route::prefix('brand')->group(function(){
    Route::get('/view',[BrandController::class,'BrandView'])->name('all.brands');
    Route::post('/store',[BrandController::class,'BrandStore'])->name('brand.store');
    Route::get('/edit/{id}',[BrandController::class,'BrandEdit'])->name('brand.edit');
    Route::post('/update',[BrandController::class,'BrandUpdate'])->name('brand.update');
    Route::get('/delete/{id}',[BrandController::class,'BrandDelete'])->name('brand.delete');
});

//All Routes For the Category Section
Route::prefix('category')->group(function(){
    Route::get('/view',[CategoryController::class,'CategoryView'])->name('all.category');
    Route::post('/store',[CategoryController::class,'CategoryStore'])->name('category.store');
    Route::get('/edit/{id}',[CategoryController::class,'CategoryEdit'])->name('category.edit');
    Route::post('/update',[CategoryController::class,'CategoryUpdate'])->name('category.update');
    Route::get('/delete/{id}',[CategoryController::class,'CategoryDelete'])->name('category.delete');


    //All Routes For Sub Category
    Route::get('/sub/view',[SubCategoryController::class,'SubCategoryView'])->name('all.subcategory');
    Route::post('/sub/store',[SubCategoryController::class,'SubCategoryStore'])->name('subcategory.store');
    Route::get('/sub/edit/{id}',[SubCategoryController::class,'SubCategoryEdit'])->name('subcategory.edit');
    Route::post('/sub/update',[SubCategoryController::class,'SubCategoryUpdate'])->name('subcategory.update');
    Route::get('/sub/delete/{id}',[SubCategoryController::class,'SubCategoryDelete'])->name('subcategory.delete');

    //All Routes For the Sub Sub Category


    Route::get('/sub/sub/view',[SubCategoryController::class,'SubSubCategoryView'])->name('all.subsubcategory');
    Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);
    Route::get('/subsubcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);
    Route::post('/sub/sub/store',[SubCategoryController::class,'SubSubCategoryStore'])->name('subsubcategory.store');
    Route::get('/sub/sub/edit/{id}',[SubCategoryController::class,'SubSubCategoryEdit'])->name('subsubcategory.edit');
    Route::post('/sub/sub/update',[SubCategoryController::class,'SubSubCategoryUpdate'])->name('subsubcategory.update');
    Route::get('/sub/sub/delete/{id}',[SubCategoryController::class,'SubSubCategoryDelete'])->name('subsubcategory.delete');
});
Route::prefix('products')->group(function(){
    Route::get('/add',[ProductController::class,'AddProduct'])->name('add-products');
    Route::post('/store',[ProductController::class,'ProductStore'])->name('product-store');
    Route::post('/data/update',[ProductController::class,'ProductUpdate'])->name('product-update');
    Route::post('/image/update',[ProductController::class,'MultiImageUpdate'])->name('update-product-image');
    Route::post('/thamb/image/update',[ProductController::class,'ThambImageUpdate'])->name('update-product-thambnail');
    Route::get('/view',[ProductController::class,'ProductShow'])->name('manage-products');
    Route::get('/multi/image/delete/{id}',[ProductController::class,'MultiImageDelete'])->name('multi.image.delete');
    Route::get('/edit/{id}',[ProductController::class,'ProductEdit'])->name('product.edit');
    Route::get('/inactive/{id}',[ProductController::class,'ProductInactive'])->name('product.inactive');
    Route::get('/active/{id}',[ProductController::class,'ProductActive'])->name('product.active');
    Route::get('/delete/{id}',[ProductController::class,'ProductDelete'])->name('product.delete');
});

//manage-slider

Route::prefix('slider')->group(function(){
    Route::get('/view',[SliderController::class,'SliderView'])->name('manage-slider');
    Route::post('/store',[SliderController::class,'SliderStore'])->name('slider.store');
    Route::get('/edit/{id}',[SliderController::class,'SliderEdit'])->name('slider.edit');
    Route::post('/update',[SliderController::class,'SliderUpdate'])->name('slider.update');
    Route::get('/delete/{id}',[SliderController::class,'SliderDelete'])->name('slider.delete');
    //slider.inactive
    Route::get('/inactive/{id}',[SliderController::class,'SliderInactive'])->name('slider.inactive');
    Route::get('/active/{id}',[SliderController::class,'SliderActive'])->name('slider.active');
});
//manage-coupons all routes
Route::prefix('coupons')->group(function(){
    Route::get('/index',[CouponController::class,'index'])->name('coupons');
    Route::get('/show',[CouponController::class,'show'])->name('coupon.show');
    Route::post('/store',[CouponController::class,'store'])->name('coupon.store');
    Route::get('/edit/{id}',[CouponController::class,'edit'])->name('coupon.edit');
    Route::post('/update/{id}',[CouponController::class,'update'])->name('coupon.update');
    Route::get('/delete/{id}',[CouponController::class,'delete'])->name('coupon.delete');
});
//manage-shipping-division all routes
Route::prefix('shipping')->group(function(){
    Route::get('/index',[ShippingAreaController::class,'index'])->name('division_management');
    Route::post('/division/store',[ShippingAreaController::class,'store'])->name('division.store');
    Route::get('/division/edit/{id}',[ShippingAreaController::class,'edit'])->name('division.edit');
    Route::post('/division/update/{id}',[ShippingAreaController::class,'update'])->name('division.update');
    Route::get('/division/delete/{id}',[ShippingAreaController::class,'destroy'])->name('division.delete');
    Route::get('/division/inactive/{id}',[ShippingAreaController::class,'inactive'])->name('division.inactive');
    Route::get('/division/active/{id}',[ShippingAreaController::class,'active'])->name('division.active');

    // Ship Division All Routes

    Route::get('/district/index',[ShippingAreaController::class,'district_index'])->name('district_management');
    Route::post('/district/store',[ShippingAreaController::class,'district_store'])->name('district.store');
    Route::get('/district/edit/{id}',[ShippingAreaController::class,'district_edit'])->name('district.edit');
    Route::post('/district/update/{id}',[ShippingAreaController::class,'district_update'])->name('district.update');
    Route::get('/district/delete/{id}',[ShippingAreaController::class,'district_destroy'])->name('district.delete');
    Route::get('/district/inactive/{id}',[ShippingAreaController::class,'district_inactive'])->name('district.inactive');
    Route::get('/district/active/{id}',[ShippingAreaController::class,'district_active'])->name('district.active');

    // Ship State All Routes

    Route::get('/state/index',[ShippingAreaController::class,'state_index'])->name('state_management');
    Route::get('/division/district/ajax/{division_id}',[ShippingAreaController::class,'get_district_data']);
    Route::post('/state/store',[ShippingAreaController::class,'state_store'])->name('state.store');
    Route::get('/state/edit/{id}',[ShippingAreaController::class,'state_edit'])->name('state.edit');
    Route::post('/state/update/{id}',[ShippingAreaController::class,'state_update'])->name('state.update');
    Route::get('/state/delete/{id}',[ShippingAreaController::class,'state_destroy'])->name('state.delete');
    Route::get('/state/inactive/{id}',[ShippingAreaController::class,'state_inactive'])->name('state.inactive');
    Route::get('/state/active/{id}',[ShippingAreaController::class,'state_active'])->name('state.active');

});



//All Frontend Routes
// Language Routes

Route::get('/language/english',[LanguageController::class,'English'])->name('language.english');
Route::get('/language/bangla',[LanguageController::class,'Bangla'])->name('language.bangla');
// Coupon
Route::post('/coupon_apply',[CartController::class,'coupon_apply']);
Route::get('/coupon_calculation',[CartController::class,'coupon_calculation']);

// Checkout routes
Route::get('/checkout',[CartController::class,'checkout'])->name('checkout');
Route::get('/district_get/ajax/{division_id}',[CheckoutController::class,'district_get']);
Route::get('/state_get/ajax/{district_id}',[CheckoutController::class,'state_get']);
Route::post('/checkout/store',[CheckoutController::class,'store'])->name('checkout.store');




Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);

    return view('dashboard',compact('user'));
})->name('dashboard');
