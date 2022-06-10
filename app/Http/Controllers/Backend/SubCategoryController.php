<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\SubSubCategory;

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
    public function SubCategoryEdit($id){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.category.subcategory_edit',compact('categories','subcategory'));
    }
    public function SubCategoryUpdate(Request $request){
        $subcat_id =$request->id;

        SubCategory::findOrFail($subcat_id)->update([
            'category_id' =>$request->category_id,
            'subcategory_name_en' =>$request->subcategory_name_en,
            'subcategory_name_ban' =>$request->subcategory_name_ban,
            'subcategory_slug_en' => strtolower(str_replace(' ','-',$request->subcategory_name_en)),
            'subcategory_slug_ban' => str_replace(' ','-',$request->subcategory_name_ban),
        ]);
        $notification = array(
            'message' => "Category Updated Succesfully",
            'alert-type'=>'success',
        );
        return Redirect()->route('all.subcategory')->with($notification);
    }
    public function SubCategoryDelete($id){
        SubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => "Category Deleted Succesfully",
            'alert-type'=>'success',
        );
        return Redirect()->back()->with($notification);
    }

    //Subsub Category
    public function SubSubCategoryView(){
        
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subsubcategory = SubSubCategory::latest()->get();
        return view('backend.category.subsubcategory_view',compact('categories','subsubcategory'));
    }
    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
     	return json_encode($subcat);
    }
    public function GetSubSubCategory($subcategory_id){
        $subsubcat = SubSubCategory::where('subcategory_id',$subcategory_id)->orderBy('subsubcategory_name_en','ASC')->get();
     	return json_encode($subsubcat);
    }
    public function SubSubCategoryStore(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_ban' => 'required',
        ],
        [
            'category_id.required' =>"Select the Category",
            'subcategory_id.required' =>"Select the Sub Category",
            'subsubcategory_name_en.required' =>"Input the Sub Sub Category in English",
            'subsubcategory_name_ban.required' =>"Input the Sub Sub Category in Bangla",
        ]);

        SubSubCategory::insert([
            'category_id' => $request ->category_id,
            'subcategory_id' => $request ->subcategory_id,
            'subsubcategory_name_en' => $request ->subsubcategory_name_en,
            'subsubcategory_name_ban' => $request ->subsubcategory_name_ban,
            'subsubcategory_slug_en' => strtolower(str_replace(' ','-', $request ->subsubcategory_name_en)),
            'subsubcategory_slug_ban' => str_replace(' ','-',$request ->subsubcategory_name_ban),
        ]);

        $notification = array(
            'message' => 'SubSub Category Inserted Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

    public function SubSubCategoryEdit($id){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en','ASC')->get();
        $subsubcategories = SubSubCategory::findOrFail($id);
        return view('backend.category.sub_subcategory_edit',compact('categories','subcategories','subsubcategories'));
    }
    public function SubSubCategoryUpdate(Request $request){
        $subsubcat_id =$request->id;
        SubSubCategory::findOrFail($subsubcat_id)->update([
            'category_id' => $request ->category_id,
            'subcategory_id' => $request ->subcategory_id,
            'subsubcategory_name_en' => $request ->subsubcategory_name_en,
            'subsubcategory_name_ban' => $request ->subsubcategory_name_ban,
            'subsubcategory_slug_en' => strtolower(str_replace(' ','-', $request ->subsubcategory_name_en)),
            'subsubcategory_slug_ban' => str_replace(' ','-',$request ->subsubcategory_name_ban),
        ]);
        $notification = array(
            'message' => 'SubSub Category Updated Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->route('all.subsubcategory')->with($notification);
    }
    public function SubSubCategoryDelete($id){
        SubSubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'SubSub Category Deleted Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

}
