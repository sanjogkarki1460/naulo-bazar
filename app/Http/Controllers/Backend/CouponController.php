<?php

namespace App\Http\Controllers\Backend;

use App\Contact;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\User;
use App\Coupon;
use App\Product;
use Illuminate\Http\Request;

class CouponController extends BackendController
{
    //
 
    public function index()
    {

        $coupons = Coupon::orderBy('created_at', 'desc')->get();
        return view($this->_mainpages . 'coupon.index', compact('coupons'));
    }

    public function create()
    {

        return view($this->_mainpages . 'coupon.create');
    }

    public function store(Request $request)
    {
        if (count(Coupon::where('code', $request->coupon_code)->get()) > 0) {
            return back()->with('error', 'Coupon already exist for this coupon code');

        }
        $coupon = new Coupon;
        if ($request->coupon_type == "product_base") {
            $coupon->type = $request->coupon_type;
            $coupon->code = $request->coupon_code;
            $coupon->discount = $request->discount;
            $coupon->discount_type = $request->discount_type;
            $coupon->start_date = strtotime($request->start_date);
            $coupon->end_date = strtotime($request->end_date);
            $coupon->uses_per_coupon = $request->uses_per_coupon;
            $cupon_details = array();
            for ($key = 0; $key < count($request->category_ids) - 1; $key++) {
                $data['category_id'] = $request->category_ids[$key];
                $data['subcategory_id'] = $request->subcategory_ids[$key];
                $data['subsubcategory_id'] = $request->subsubcategory_ids[$key];
                $data['product_id'] = $request->product_ids[$key];
                array_push($cupon_details, $data);
            }
            if($request->vendor) {
                $vendor = Product::where('user_id', $request->vendor)->pluck('id', 'id')->toArray();
                $coupon->products()->attach($vendor);
            }
            $coupon->details = json_encode($cupon_details);
            if ($coupon->save()) {
                return redirect()->route('coupons.list')->with('status', 'Coupon has been saved successfully');
            } else {
                return back()->with('error', 'Something Went Wrong');;
            }
        } elseif ($request->coupon_type == "cart_base") {
            $coupon->type = $request->coupon_type;
            $coupon->code = $request->coupon_code;
            $coupon->discount = $request->discount;
            $coupon->discount_type = $request->discount_type;
            $coupon->start_date = strtotime($request->start_date);
            $coupon->end_date = strtotime($request->end_date);
            $data = array();
            $data['min_buy'] = $request->min_buy;
            $data['max_discount'] = $request->max_discount;
            $coupon->details = json_encode($data);
            if ($coupon->save()) {
                return redirect()->route('coupons.list')->with('status', 'Coupon has been saved successfully');
            } else {
                return back()->with('error', 'Something Went Wrong');;
            }
        }
    }


    public function update(Request $request)
    {

        $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'coupon_code' => 'required',
                'type' => 'required',
                'price' => 'required',
                'start_date' => 'required|after:today',
                'expiry_date' => 'required|after:today',
                'status' => 'required'
            ]
        );
        
        $update = Coupon::where('id', $request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'coupon_code' => $request->coupon_code,
            'type' => $request->type,
            'price' => $request->price,
            'start_date' => $request->start_date,
            'user_id' => auth()->user()->id,
            'expiry_date' => $request->expiry_date,
            'status' => $request->status,
            'amount' => $request->amount,
            'uses_per_coupon' => $request->uses_per_coupon
        ]);
        if($request->vendor) {
            $vendor = Product::where('user_id', $request->vendor)->pluck('id', 'id')->toArray();
            $update->products()->syncWithoutDetaching($vendor);
        }
        if ($update) {
            return redirect()->route('coupons.list')->with('status', 'Successfully Updated');
        }
        return redirect()->back()->with('error', 'Something Went Wrong');
    }

    public function delete($id)
    {
        $id = base64_decode($id);
        $delete = Coupon::where('id', base64_decode($id))->delete();
        $delete->products()->detach();
        if ($delete) {
            return redirect()->route('coupons.list')->with('status', 'Delete Successfully');
        }
        return redirect()->back()->with('error', 'Something went wrong');

    }

    public function get_coupon_form(Request $request)
    {
        if ($request->coupon_type == "product_base") {
            return view($this->_mainpages . 'coupon.product_base');
        } elseif ($request->coupon_type == "cart_base") {
            return view($this->_mainpages . 'coupon.cart_base');
        }
    }

    public function get_coupon_form_edit(Request $request)
    {
        if ($request->coupon_type == "product_base") {
            $vendors = User::with(['roles' => function($q){
                $q->where('name', 'vendor');
            }])->pluck('user_name', 'id')->toArray();
            $coupon = Coupon::findOrFail(base64_decode($request->id));
            return view($this->_mainpages . 'coupon.product_base_edit', compact('coupon','vendors'));
        } elseif ($request->coupon_type == "cart_base") {
            $vendors = User::with(['roles' => function($q){
                $q->where('name', 'vendor');
            }])->pluck('user_name', 'id')->toArray();
            $coupon = Coupon::findOrFail(base64_decode($request->id));
            return view($this->_mainpages . 'coupon.cart_base_edit', compact('coupon','vendors'));
        }
    }
}
