<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function CategoryView(){
        $category = Category::latest()->get();
        return view('backend.category.category_view',compact('category'));
    }
    public function CategoryStore(Request $request){
        $request->validate([
            'category_name_en' =>'required',
            'category_name_ban' =>'required',
            'category_icon' =>'required',
        ],
        [
            'category_name_en.required' => 'Please Write The Category Name In English',
            'category_name_ban.required' => 'Please Write The Category Name In Bangla',
            'category_icon.required' => 'Please Write The Category Name In English',
        ]);

        Category::insert([
            'category_name_en' =>$request->category_name_en,
            'category_name_ban' =>$request->category_name_ban,
            'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
            'category_slug_ban' => str_replace(' ','-',$request->category_name_ban),
            'category_icon' =>$request->category_icon,
        ]);
        $notification = array(
            'message' => "Category Inserted Succesfully",
            'alert-type'=>'success',
        );
        return Redirect()->back()->with($notification);
    }
    public function CategoryEdit($id){
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit',compact('category'));
    }
    public function CategoryUpdate(Request $request){

        $category = $request->id;

        Category::findOrFail($category)->update([
            'category_name_en' =>$request->category_name_en,
            'category_name_ban' =>$request->category_name_ban,
            'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
            'category_slug_ban' => str_replace(' ','-',$request->category_name_ban),
            'category_icon' =>$request->category_icon,
        ]);
        $notification = array(
            'message' => "Category Updated Succesfully",
            'alert-type'=>'success',
        );
        return Redirect()->route('all.category')->with($notification);
    }
    public function CategoryDelete($id){
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => "Category Deleted Succesfully",
            'alert-type'=>'success',
        );
        return Redirect()->back()->with($notification);
        
    }
}
