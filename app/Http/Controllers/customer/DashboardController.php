<?php

namespace App\Http\Controllers\Customer;
use App\Order;
use App\Review;
use App\Wishlist;
use App\Address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $myOrders = Order::where('user_id',auth()->id())->whereHas('orderDetails')->with('orderDetails.product')->limit(4)->latest()->get();
        $myOrderCount = Order::where('user_id',auth()->id())->whereHas('orderDetails')->with('orderDetails.product')->latest()->count();
        $wishlistCount = Wishlist::where('user_id',auth()->id())->count();
        $address = Address::where('user_id',auth()->id())->first();
        return view('customer.dashboard',compact('myOrders','wishlistCount','myOrderCount','address'));
    }

    public function profile(){
        
        return view('customer.profile');
    }

    public function address(){
        $address = Address::where('user_id',auth()->id())->first();
        return view('customer.address',compact('address'));
    }

    public function order(){
        $myOrders = Order::where('user_id',auth()->id())->whereHas('orderDetails')->with('orderDetails.product')->get();
        
        return view('customer.order',compact('myOrders'));
    }

    public function wishlist(){
        $wishlists = Wishlist::where('user_id',auth()->id())->with('product')->get();
        return view('customer.wishlist',compact('wishlists'));
    }

    public function review(){
        $reviews = Review::where('user_id',auth()->id())->with('product.user')->latest()->get();
        
        return view('customer.reviews',compact('reviews'));
    }

    public function changePassword(){
        return view('customer.changePassword');
    }

    public function cart(){
        return view('customer.cart');
    }

    public function trackOrder(){
        return view('customer.track-order');
    }
}
