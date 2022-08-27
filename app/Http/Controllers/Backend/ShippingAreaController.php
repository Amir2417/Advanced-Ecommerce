<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDivision;
use Carbon\Carbon;

class ShippingAreaController extends Controller
{
    public function index(){
        $divisions = ShipDivision::orderBy('id','DESC')->get();
        return view('backend.ship.division.index',compact('divisions'));
    }
    public function store(Request $request){
        $request->validate([
            'division_name'=>'required',
        ]);
        $data = new ShipDivision();
        $input = $request->all();
        $data->fill($input)->save();
        $notification = array(
            'message' => "Division Inserted Succesfully",
            'alert-type'=>'success',
        );
        return Redirect()->route('division_management')->with($notification);
    }
    public function edit($id){
        $divisions = ShipDivision::findOrFail($id);
        return view('backend.ship.division.edit',compact('divisions'));
    }
    public function update(Request $request,$id){
        ShipDivision::findOrFail($id)->update([
            'division_name'=>$request->division_name,
        ]);
        $notification = array(
            'message' => "Division Updated Succesfully",
            'alert-type'=>'success',
        );
        return Redirect()->route('division_management')->with($notification);
    }
}
