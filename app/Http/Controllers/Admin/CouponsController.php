<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;

class CouponsController extends Controller
{
    public function addCoupon(Request $request)
    {
      if($request->isMethod('post')) {
      $data = $request->all();
      // echo "<pre>"; print_r($date);die;
      $coupon = new Coupon;
      $coupon->coupon_code = $data['coupon_code'];
      $coupon->amount = $data['amount'];
      $coupon->amount_type = $data['amount_type'];
      $coupon->expiry_date = $data['expiry_date'];
      $coupon->status = $data['status'];
      $coupon->save();
      return redirect()->route('admin.coupon.view')->with('flash_message_success','Coupon added successfully');
      }
    return view('admin.coupons.add_coupon');
    }


    public function viewCoupon()
    {
      $coupons = Coupon::get();
      return view('admin.coupons.view_coupon',compact('coupons'));
    }

    public function editCoupon(Request $request,$id=null)
    {

       if ($request->isMethod('post')) {
         $data = $request->all();
          //echo "<pre>"; print_r($data); die;

          $coupon = Coupon::find( $id);
          $coupon->coupon_code = $data['coupon_code'];
          $coupon->amount = $data['amount'];
          $coupon->amount_type = $data['amount_type'];
          $coupon->expiry_date = $data['expiry_date'];
          if (empty($data['status'])) {
          $data['status'] = 0;
              }
          $coupon->status = $data['status'];
          $coupon->save();
          return redirect()->route('admin.coupon.view')->with('flash_message_success','Coupon update successfully');

       }
      $couponDetails = Coupon::find($id);

      return view('admin.coupons.edit_coupon',compact('couponDetails'));
    }

    public function deleteCoupon($id = null)
    {
      $deleteCoupon = Coupon::where(['id'=>$id])->delete();

    return redirect()->back()->with('flash_message_success',' Coupon delete Successfully');

    }
}
