<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Carbon\Carbon;

class ShipAreaController extends Controller
{
    public function AllDivision()
    {
        $division = ShipDivision::latest()->get();
        return view('backend.ship.division.division_all', compact('division'));

    } // End Method


    public function AddDivision(){

        return view('backend.ship.division.division_add');

    } // End Method


    public function StoreDivision(Request $request){

        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'ShipDivision Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.division')->with($notification);

    } // End Method


    public function EditDivision($id){

        $division = ShipDivision::find($id);
        return view('backend.ship.division.division_edit', compact('division'));

    } // End Method


    public function UpdateDivision(Request $request){

        $div_id = $request->id;

        ShipDivision::findOrFail($div_id)->update([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'ShipDivision Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.division')->with($notification);

    } // End Method


    public function DeleteDivision($id){

        ShipDivision::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Division Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method



    //////////////////////////////// ShipDistrict Area Method /////////////////////////////

    public function AllDistrict()
    {
        $district = ShipDistrict::latest()->get();
        return view('backend.ship.district.district_all', compact('district'));

    } // End Method


    public function AddDistrict(){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        return view('backend.ship.district.district_add',compact('division'));

    } // End Method


    public function StoreDistrict(Request $request){

        ShipDistrict::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'ShipDistrict Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.district')->with($notification);

    } // End Method


    public function EditDistrict($id){

        $district = ShipDistrict::findOrFail($id);
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        return view('backend.ship.district.district_edit', compact('division','district'));

    } // End Method


    public function UpdateDistrict(Request $request){

        $distr_id = $request->id;

        ShipDistrict::findOrFail($distr_id)->update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'ShipDistrict Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.district')->with($notification);

    } // End Method


    public function DeleteDistrict($id){

        ShipDistrict::findOrFail($id)->delete();

         $notification = array(
            'message' => 'ShipDistrict Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    } // End Method



//////////////////////////////  ShipState Area Method ///////////////////

    public function AllState(){

        $state = ShipState::latest()->get();
        return view('backend.ship.state.state_all', compact('state'));

    } // End Method


    public function AddState(){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::orderBy('district_name','ASC')->get();
        return view('backend.ship.state.state_add',compact('division','district'));

    } // End Method


    public function GetDistrict($division_id){

        $dist = ShipDistrict::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
        return json_encode($dist);

    } // End Method


    public function StoreState(Request $request){

        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'ShipState Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.state')->with($notification);

    } // End Method


    public function EditState($id){

        $state = ShipState::findOrFail($id);
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::orderBy('district_name','ASC')->get();
        return view('backend.ship.state.state_edit', compact('division','district','state'));

    } // End Method


    public function UpdateState(Request $request){

        $state_id = $request->id;

        ShipState::findOrFail($state_id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'ShipState Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.state')->with($notification);

    } // End Method


    public function DeleteState($id){

        ShipState::findOrFail($id)->delete();

         $notification = array(
            'message' => 'ShipState Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    } // End Method



} // End Main Method
