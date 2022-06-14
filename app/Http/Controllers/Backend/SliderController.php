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
}
