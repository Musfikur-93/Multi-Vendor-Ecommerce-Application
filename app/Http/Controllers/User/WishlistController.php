<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use Carbon\Carbon;

class WishlistController extends Controller
{
    public function AddToWishlist(Request $request, $product_id){

        if (Auth::check()) {
           $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();

           if (!$exists) {
            Wishlist::insert([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'created_at' => Carbon::now(),
            ]);

            return response()->json(['success' => 'Add To Wishlist Success']);

           }else{
                return response()->json(['error' => 'Already Exists this Product']);
           }
        }else{
            return response()->json(['error' => 'At First Login your Account']);
        }

    } // End Method


    public function AllWishlist(){

        return view('frontend.wishlist.view_wishlist');

    } // End Method


    public function GetWishlistProduct(){

        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
        $wishQty = Wishlist::count();

        return response()->json([
            'wishlist' => $wishlist,
            'wishQty' => $wishQty,
        ]);

    } // End Method


    public function WishlistRemove($id){

        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Wishlist Product Remove Success']);

    } // End Method



} // End Main Method
