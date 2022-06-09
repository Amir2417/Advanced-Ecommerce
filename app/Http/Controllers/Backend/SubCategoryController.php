<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function SubCategoryView(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = SubCategory::latest()->get();
        return view('backend.category.subcategory_view',compact('subcategory','categories'));
    }
    public function SubCategoryStore(Request $request){
        $request->validate([
            'category_id' =>'required',
            'subcategory_name_en' =>'required',
            'subcategory_name_ban' =>'required',
        ],
        [
            'category_id.required' => 'Please Select Any Option',
            'subcategory_name_en.required' => 'Input SubCategory Name English',
            'subcategory_name_ban.required' => 'Input SubCategory Name Bangla',
        ]);

        SubCategory::insert([
            'category_id' =>$request->category_id,
            'subcategory_name_en' =>$request->subcategory_name_en,
            'subcategory_name_ban' =>$request->subcategory_name_ban,
            'subcategory_slug_en' => strtolower(str_replace(' ','-',$request->subcategory_name_en)),
            'subcategory_slug_ban' => str_replace(' ','-',$request->subcategory_name_ban),
            
        ]);
        $notification = array(
            'message' => "Category Inserted Succesfully",
            'alert-type'=>'success',
        );
        return Redirect()->back()->with($notification);
    }
}
