<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Category;
use App\Seller;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class ReportController extends BackendController
{
    //
    public function wishlistReport(Request $request)
    {
        if ($request->has('category_id')) {
            $products = Product::where('category_id', $request->category_id)->get();
        } else {
            $products = Product::all();
        }
        return view($this->_mainpages . 'report.wish-report', compact('products'));
    }

    public function sellerReport(Request $request)
    {
        if ($request->has('verification_status')) {
            $sellers = Seller::where('verification_status', $request->verification_status)->get();
        } else {
            $sellers = Seller::all();
        }
        return view($this->_mainpages . 'report.seller-report', compact('sellers'));
    }

    public function sellerBasedReport(Request $request)
    {
        if ($request->has('verification_status')) {
            $sellers = Seller::where('verification_status', $request->verification_status)->get();
        } else {
            $sellers = Seller::all();
        }
        return view($this->_mainpages . 'report.seller-based', compact('sellers'));
    }

    public function stock_report(Request $request)
    {
        if ($request->has('category_id')) {
            $products = Product::where('category_id', $request->category_id)->get();
        } else {
            $products = Product::all();
        }
        return view($this->_mainpages . 'report.stock-report', compact('products'));
    }

    public function in_house_sale_report(Request $request)
    {
        if ($request->has('category_id')) {
            $products = Product::where('category_id', $request->category_id)->orderBy('num_of_sale', 'desc')->get();
        } else {
            $products = Product::orderBy('num_of_sale', 'desc')->get();
        }
        return view($this->_mainpages . 'report.in_house_sale_report', compact('products'));
    }

    public function commissionReport(Request $request)
    {
        if($request->all()){
            $commission = Seller::where('user_id',$request->user_id)->get();
            return view($this->_mainpages . 'report.commission', compact('commission'));
        }
        $commission = Seller::get();
        return view($this->_mainpages . 'report.commission', compact('commission'));

    }

}
