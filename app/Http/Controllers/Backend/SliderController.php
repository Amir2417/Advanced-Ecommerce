<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Image;

class SliderController extends Controller
{
    public function SliderView(){
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_view',compact('sliders'));
    }
    public function SliderStore(Request $request){
        $request->validate([
            'slider_img' => 'required',
        ],
        [
            'slider_img.required' => 'Slider Image Is Required',
        ]
    
    );

    $slider_img = $request->file('slider_img');
    $name_gen = hexdec(uniqid()).'.'.$slider_img->getClientOriginalExtension();
    Image::make($slider_img)->resize(870,370)->save('upload/slider/'.$name_gen);
    $save_url= 'upload/slider/'.$name_gen;

    Slider::insert([
        'title'=>$request->title,
        'description'=>$request->description,
        'slider_img'=>$save_url,
    ]);
    $notification = array(
        'message' =>'Slider Inserted Successfully',
        'alert-type'=>"success",
    );
    return Redirect()->back()->with($notification);

    }
    public function SliderInactive($id){
        Slider::findOrFail($id)->update(['status'=> 0]);
        $notification = array(
            'message' =>'Slider Inactive Successfully',
            'alert-type'=>"success",
        );
        return Redirect()->back()->with($notification);
    }
    public function SliderActive($id){
        Slider::findOrFail($id)->update(['status'=>1]);
        $notification = array(
            'message' =>'Slider Active Successfully',
            'alert-type'=>"success",
        );
        return Redirect()->back()->with($notification);
    }
    //slider Edit Page Load
    public function SliderEdit($id){
        $sliders = Slider::findOrFail($id);
        return view('backend.slider.slider_edit',compact('sliders'));
    }
    //Slider Update
    public function SliderUpdate(Request $request){
        $slider_id = $request->id;
        $old_image = $request->old_image;
        if($request->file('slider_img')){
            unlink($old_image);
            $slider_img = $request->file('slider_img');
            $name_gen = hexdec(uniqid()).'.'.$slider_img->getClientOriginalExtension();
            Image::make($slider_img)->resize(870,370)->save('upload/slider/'.$name_gen);
            $save_url= 'upload/slider/'.$name_gen;

            Slider::findOrFail($slider_id)->update([
                'title'=>$request->title,
                'description'=>$request->description,
                'slider_img'=>$save_url,
            ]);

            $notification = array(
                'message' =>'Slider Updated Successfully',
                'alert-type'=>"success",
            );
            return Redirect()->route('manage-slider')->with($notification);

        }else{
            Slider::findOrFail($slider_id)->update([
                'title'=>$request->title,
                'description'=>$request->description,
                
            ]);

            $notification = array(
                'message' =>'Slider Updated Without Successfully',
                'alert-type'=>"success",
            );
            return Redirect()->route('manage-slider')->with($notification);
        }
    }

    //Slider Delete Method
    public function SliderDelete($id){
        $sliders = Slider::findOrFail($id);
        unlink($sliders->slider_img);
        Slider::findOrFail($id)->delete();

        $notification = array(
            'message' =>'Slider Deleted Successfully',
            'alert-type'=>"success",
        );
        return Redirect()->back()->with($notification);
    }
}
