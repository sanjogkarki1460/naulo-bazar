<?php

namespace App\Http\Controllers\Backend;

use App\AdminCommission;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Category;
use App\Variation;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductSettingController extends BackendController
{
    //
    public function index()
    {
        $id = 0;
        $categories = Category::orderByDesc('id')->get();
        $admin_commissions = AdminCommission::with('category')->get();
        return view($this->_mainpages.'product-setting.product-setting',compact('id','categories','admin_commissions'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        if (AdminCommission::where('category_id', '=', $request->category_id)->count() > 0) {
            // user found
            return redirect()->back()->with('error','Commission for Category Already Exist');
         }
        $request->validate([
            'category_id'=>'required',
            'admin_commisson'=>'required'

        ]);
        AdminCommission::create([
            'category_id'=>$request->category_id,
            'admin_commisson'=>$request->admin_commisson
        ]);
        return redirect()->back()->with('status','Admin Commission Inserted');
    }

    public function edit($id)
    {
        $commission = AdminCommission::findOrFail($id);
        $categories = Category::orderByDesc('id')->get();
        return view($this->_mainpages.'product-setting.product-setting',compact('commission','id','categories'));

    }
    public function update(Request $request,$id)
    {
            $request->validate([
                'category_id'=>'unique:admin_commissions,category_id,'.$request->category_id,
            ]);
            $update = AdminCommission::where('id',$id)->update([
                'admin_commisson'=>$request->admin_commisson,
                'category_id'=>$request->category_id
            ]);
            if($update)
            {
                return redirect()->route('product.setting.index')->with('status','Updated Successfully');
            }
            else{
                return redirect()->route('product.setting.index')->with('error','Something Went Wrong');
            }



    }
}
