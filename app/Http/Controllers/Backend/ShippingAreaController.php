<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShipState;
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
    public function destroy($id){
        ShipDivision::findOrFail($id)->delete();
        $notification = array(
            'message' => "Division Delete Succesfully",
            'alert-type'=>'success',
        );
        return Redirect()->back()->with($notification);
    }
    public function inactive($id){
        ShipDivision::findOrFail($id)->update(['status'=>0]);
        $notification = array(
            'message' => "Division Inactive Succesfully",
            'alert-type'=>'info',
        );
        return Redirect()->back()->with($notification);
    }
    public function active($id){
        ShipDivision::findOrFail($id)->update(['status'=>1]);
        $notification = array(
            'message' => "Division Active Succesfully",
            'alert-type'=>'info',
        );
        return Redirect()->back()->with($notification);
    }
    // end ship division

    // start ship district method
    public function district_index(){
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $districts = ShipDistrict::orderBy('id','DESC')->get();
        return view('backend.ship.district.index',compact('divisions','districts'));
    }
    public function district_store(Request $request){
        $request->validate([
            'division_id'=>'required',
            'district_name'=>'required',
        ]);
        $data = new ShipDistrict();
        $input = $request->all();
        $data->fill($input)->save();

        $notification = array(
            'message' => "District Inserted Succesfully",
            'alert-type'=>'success',
        );
        return Redirect()->route('district_management')->with($notification);

    }
    public function district_edit($id){
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $districts = ShipDistrict::findOrFail($id);
        return view('backend.ship.district.edit',compact('divisions','districts'));
    }
    public function district_update(Request $request,$id){
        ShipDistrict::findOrFail($id)->update([
            'division_id'=>$request->division_id,
            'district_name'=>$request->district_name,
        ]);
        $notification = array(
            'message' => "District Update Succesfully",
            'alert-type'=>'success',
        );
        return Redirect()->route('district_management')->with($notification);
    }
    public function district_destroy($id){
        ShipDistrict::findOrFail($id)->delete();
        $notification = array(
            'message' => "District Delete Succesfully",
            'alert-type'=>'info',
        );
        return Redirect()->back()->with($notification);
    }
    public function district_inactive($id){
        ShipDistrict::findOrFail($id)->update(['status'=>0]);
        $notification = array(
            'message' => "District Inactive Succesfully",
            'alert-type'=>'success',
        );
        return Redirect()->back()->with($notification);
    }
    public function district_active($id){
        ShipDistrict::findOrFail($id)->update(['status'=>1]);
        $notification = array(
            'message' => 'District Active Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }
    // End ship district method

    // Start ship state method
    public function state_index(){
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $districts = ShipDistrict::orderBy('district_name','ASC')->get();
        $states = ShipState::orderBy('id','DESC')->get();
        return view('backend.ship.state.index',compact('divisions','districts','states'));
    }
    public function get_district_data($division_id){
        $districts = ShipDistrict::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
        return json_encode($districts);
    }
    public function state_store(Request $request){
        $request->validate([
            'division_id'=>'required',
            'district_id'=>'required',
            'state_name'=>'required',
        ]);
        $data = new ShipState();
        $input = $request->all();
        $data->fill($input)->save();

        $notification = array(
            'message' => 'State Inserted Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }
    public function state_edit($id){
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $districts = ShipDistrict::orderBy('district_name','ASC')->get();
        $states = ShipState::findOrFail($id);
        return view('backend.ship.state.edit',compact('divisions','districts','states'));
    }
    public function state_update(Request $request,$id){

        ShipState::findOrFail($id)->update([
            'division_id'=>$request->division_id,
            'district_id'=>$request->district_id,
            'state_name'=>$request->state_name,
        ]);
        $notification = array(
            'message' => 'State Updated Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->route('state_management')->with($notification);

    }
    public function state_destroy($id){
        ShipState::findOrFail($id)->delete();
        $notification = array(
            'message' => 'State Delete Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }
    public function state_inactive($id){
        ShipState::findOrFail($id)->update(['status'=>0]);
        $notification = array(
            'message' => 'State Inactive Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }
    public function state_active($id){
        ShipState::findOrFail($id)->update(['status'=>1]);
        $notification = array(
            'message' => 'State Active Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }

}
