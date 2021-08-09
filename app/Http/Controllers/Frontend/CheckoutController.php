<?php

namespace App\Http\Controllers\Frontend;

use App\AdminCommission;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Models\Cart;
use App\Models\DeliveryAddress;
use App\Models\Product;
use App\Models\UserAddress;
use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends FrontendController
{
    //
   
   public function checkoutAddress()
   {
        $deliveries = DeliveryAddress::orderBy('id','DESC')->get();
        $useraddress = null;
        if(Auth::check())
        {
          $useraddress = UserAddress::where('user_id',auth()->user()->id)->first();
        }
        return view($this->_mainpages.'checkout.checkoutaddress',compact('deliveries','useraddress'));
   }

   public function createCheckoutAddress(Request $request)
   {
        $request->validate([
          'name' => 'required',
          'email' =>'required',
          'phone_number'=>'required',
          'city' => 'required',
          'address1'=>'required'
        ]);
        if(session()->has('checkoutaddress'))
        {
          $request->session()->forget('checkoutaddress');
        }

          session()->put('checkoutaddress',$request->except('_token'));
        return $this->checkoutShipping();
   }

   public function checkoutShipping()
   {
        if(Auth::check())
        {
          $cart = Cart::where('user_id',auth()->user()->id)->get();
        
          return view($this->_mainpages.'checkout.checkoutShipping',compact('cart'));
        }
        else
        {

          return view($this->_mainpages.'checkout.checkoutShipping');
        }
       
   }

   public function createCheckoutShipping(Request $request)
   {
        
        if($request->shipping_method == 'cashondelivery')
        {
             return $this->checkoutReview($request->shipping_method);
        }
        else
        {
             return $this->checkoutPayment();
        }

   }

   public function checkoutPayment()
   {

        return view($this->_mainpages.'checkout.checkoutPayment');
   }

   public function checkoutReview($shipping_method)
   {
        return view($this->_mainpages.'checkout.checkoutReview',compact('shipping_method'));
   }

   public function checkoutComplete(Request $request)
   {
     
     if(Auth::check())
     {
          $cart = Cart::where('user_id',auth()->user()->id)->get();
          
          $admin_commission = [];
          $delivery = [];
          $vendor = [];
          foreach($cart as $value)
          {
               $product = Product::findOrFail($value->product_id);
               $category_id = $product->pluck('category_id')->first();
               $admin_commission[$value->product_id]=AdminCommission::where('category_id',$category_id)->pluck('admin_commisson')->first();
               $delivery[$value->product_id] = $product->deliveryCharge();
               $vendor[$value->product_id] = $product->user->id;
          }
          
          $order=Order::create([
               'user_id' => auth()->user()->id,
               'quantity' => $cart->sum('quantity'),
               'total_price'=> $cart->sum('total_price')+array_sum($delivery),
               'delivery_fee'=>array_sum($delivery),
               'order_status_id'=>2,
               'payment_method'=>$request->shipping_method,
               'admin_commision'=>array_sum($admin_commission),
               'description'=>json_encode(session()->get('checkoutaddress')),
               'tax'=>0

          ]);
          foreach($cart as $value)
          {
          OrderProduct::create([
               'product_id'=>$value->product_id,
               'quantity' => $value->quantity,
               'price'=> $value->total_price,
               'delivery_charge'=>$delivery[$value->product_id],
               'admin_commision'=>$admin_commission[$value->product_id],
               'order_id' => $order->id,
               'vendor_id'=> $vendor[$value->product_id]
          ]);
          }
          return view($this->_mainpages.'checkout.checkoutComplete');
     }
     else
     {
          return view($this->_mainpages.'checkout.checkoutComplete');
     }
      
   }
}
