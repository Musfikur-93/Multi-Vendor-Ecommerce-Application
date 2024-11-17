<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;
use Image;
use Carbon\Carbon;

class SlideController extends Controller
{
    public function AllSlider()
    {
        $slider = Slide::latest()->get();
        return view('backend.slider.slider_all', compact('slider'));

    } // End Method


    public function AddSlider()
    {
        return view('backend.slider.slider_add');

    } // End Method


    public function StoreSlider(Request $request)
    {
        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(2376,807)->save('upload/slider/'.$name_gen);
        $save_url = 'upload/slider/'.$name_gen;

        Slide::insert([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_image' => $save_url,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Slider Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.slider')->with($notification);

    } // End Method


    public function EditSlider($id)
    {
        $slider = Slide::findorFail($id);
        return view('backend.slider.slider_edit',compact('slider'));

    } // End Method


    public function UpdateSlider(Request $request)
    {
        $slider_id = $request->id;
        $old_img = $request->old_img;

        if($request->file('slider_image')){
            $image = $request->file('slider_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(2376,807)->save('upload/slider/'.$name_gen);
            $save_url = 'upload/slider/'.$name_gen;

            if(file_exists($old_img)){
                unlink($old_img);
            }

            Slide::findorFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'slider_image' => $save_url,
                'updated_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => 'Slider Update Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.slider')->with($notification);

        } else{
            Slide::findorFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'updated_at' => Carbon::now(),
                ]);

            $notification = array(
                'message' => 'Slider Update Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.slider')->with($notification);

        } //End Else

    } // End Method


    public function DeleteSlider($id)
    {
        $slider = Slide::findorFail($id);
        $img = $slider->slider_image;
        unlink($img);

        Slide::findorFail($id)->delete();

        $notification = array(
                'message' => 'Slider Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

    } // End Method



}
