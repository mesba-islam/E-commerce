<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function addCoupon(){
        // $coupons = Coupon::latest()->get();

        return view('admin.addcoupon');

    }

    public function storeCoupon(Request $request){
        Coupon::insert([
            'coupon' => $request->coupon,
            'discount' => $request->discount,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        return redirect()->route('admin.allcoupon')->with('message','category Update Successfully');
    }

    public function allCoupon(){
        $coupons = Coupon::get();

        return view('admin.allcoupon', compact('coupons'));

    }

    public function editCoupon($id){
        $coupons = coupon::FindOrFail($id);

        return view('admin.editcoupon', compact('coupons'));
    }

    public function updateCoupon(Request $request){
        $coupon_id = $request->id;



        Coupon::findOrFail($coupon_id)->update([
            'coupon' => $request->coupon,
            'discount' =>  $request->discount
        ]);

        return redirect()->route('all.coupon')->with('message','Coupon Update Successfully');
    }

    public function deleteCoupon($id){
        Coupon::FindOrFail($id)->delete();

        return redirect()->route('all.coupon')->with('message', 'Coupon deleted Successfully!');
    }

}
