<?php

namespace App\Http\Controllers\Customer;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Http\Controllers\Api\ClubPointController;
use App\Http\Controllers\Api\AffiliateController;
use App\Models\CouponUsage;
use App\Models\OrderDetail;
use Illuminate\Support\Carbon;
use App\Models\BusinessSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CheckoutController extends Controller
{
    public function index(){
        return view('customer.checkout');
    }

    public function applyCoupon(Request $request){
        
        $coupon = Coupon::where('code',$request->coupon)->first();
        if($coupon){
            if(session()->has('coupon')){
                return response()->json(['error'=>'coupon already applied'],422);
            }
            if($coupon->user_per_coupon){
                if (CouponUsage::where('coupon_id', $coupon->id)->get()->count() >= $coupon->uses_per_coupon) {
                    return response()->json(['error', 'Coupon Expired'],422);
                }
            }
            if (strtotime(Carbon::now()) < $coupon->start_date) {
                return response()->json(['error', 'Coupon Not Started Yet!'],422);
            }
            if (strtotime(Carbon::now()) > $coupon->end_date) {
                return response()->json(['error'=>'Coupon date Expired'],422);
            }
            if($coupon->discount_type= "amount"){
                //$cart= Cart::where('user_id',auth()->id())->get();
                if($coupon->type == 'cart_base'){
                    session()->put('coupon', $coupon->discount);
                    return response()->json(['message'=>'discount applied','discount'=>$coupon->discount],200);
                }else{
                    session()->put('coupon', $coupon->discount);
                    return response()->json(['message'=>'discount applied','discount'=>$coupon->discount],200);
                }
            }else{
                return "percent base";
            }
        }
        return response()->json(['error'=>'Invalid coupon'],422);
    }

    public function processOrder(Request $request)
    {
        
        $this->validate($request, [
            'shipping_address.name'=> 'required | max:255',
            'payment_type'=> 'required | max:255',
            'shipping_address.phone'=>'required|digits:10|numeric',
            'shipping_address.email' =>'required| email | max:30',
            'shipping_address.address' => 'required | max:250',
        ]);
       
        try{
        //$shippingAddress = json_decode($request->shipping_address);
            $date = strtotime('now');
            $code = rand(22222,88888).'-'.rand(11111,99999);
            
            
        // create an order
        $order = Order::create([
            'user_id' => Auth::id(),
            'shipping_address' => json_encode($request->shipping_address),
            'payment_type' => $request->payment_type,
            'payment_status' => $request->payment_value,
            'grand_total' => $request->grand_total,
            'coupon_discount' => 0,
            'code' => $code,
			'date' => $date

        ]);
        
        $cartItems = Cart::where('user_id', Auth::id())->get();
        // save order details

        $shipping = 0;
        $admin_products = array();
        $seller_products = array();
        //
        
        if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'flat_rate') {
            $shipping = \App\BusinessSetting::where('type', 'flat_rate_shipping_cost')->first()->value;
            
        }
        
        elseif (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'seller_wise_shipping') {
            
            foreach ($cartItems as $cartItem) {
                $product = \App\Product::find($cartItem->product_id);
                if($product->added_by == 'admin'){
                    array_push($admin_products, $cartItem->product_id);
                }
                else{
                    $product_ids = array();
                    if(array_key_exists($product->user_id, $seller_products)){
                        $product_ids = $seller_products[$product->user_id];
                    }
                    array_push($product_ids, $cartItem->product_id);
                    $seller_products[$product->user_id] = $product_ids;
                }
            }
                if(!empty($admin_products)){
                    $shipping = \App\BusinessSetting::where('type', 'shipping_cost_admin')->first()->value;
                    
                }
                if(!empty($seller_products)){
                    foreach ($seller_products as $key => $seller_product) {
                        $shipping += \App\Shop::where('user_id', $key)->first()->shipping_cost;
                    }
                    
                    
                }
        }


        foreach ($cartItems as $cartItem) {
            $product = Product::findOrFail($cartItem->product_id);
            if ($cartItem->variation) {
                $cartItemVariation = $cartItem->variation;
                $product_stocks = $product->stocks->where('variant', $cartItem->variation)->first();
                $product_stocks->qty -= $cartItem->quantity;
                $product_stocks->save();
            } else {
                $product->update([
                    'current_stock' => DB::raw('current_stock - ' . $cartItem->quantity)
                ]);
            }

            $order_detail_shipping_cost= 0;
            
            if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'flat_rate') {
                $order_detail_shipping_cost = $shipping/count($cartItems);
            }
            elseif (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'seller_wise_shipping') {
                if($product->added_by == 'admin'){
                    $order_detail_shipping_cost = \App\BusinessSetting::where('type', 'shipping_cost_admin')->first()->value/count($admin_products);
                }
                else {
                    $order_detail_shipping_cost = \App\Shop::where('user_id', $product->user_id)->first()->shipping_cost/count($seller_products[$product->user_id]);
                }
            }
            else{
                $order_detail_shipping_cost = \App\Product::find($cartItem['id'])->shipping_cost;
            }
            

            
            OrderDetail::create([
                'order_id' => $order->id,
                'seller_id' => $product->user_id,
                'product_id' => $product->id,
                'variation' => $cartItem->variation,
                'price' => $cartItem->price * $cartItem->quantity,
                'tax' => $cartItem->tax * $cartItem->quantity,
                'shipping_cost' => $order_detail_shipping_cost,
                'quantity' => $cartItem->quantity,
                'payment_status' => 'unpaid'
            ]);
            $product->update([
                'num_of_sale' => DB::raw('num_of_sale + ' . $cartItem->quantity)
            ]);
        }
        // apply coupon usage
        if ($request->coupon_code != '') {
            CouponUsage::create([
                'user_id' => Auth::id(),
                'coupon_id' => Coupon::where('code', $request->coupon_code)->first()->id
            ]);
        }
        // calculate commission
        $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;

        foreach ($order->orderDetails as $orderDetail) {
            if ($orderDetail->product->user->user_type == 'seller') {
                $seller = $orderDetail->product->user->seller;
                $price = $orderDetail->price + $orderDetail->tax + $orderDetail->shipping_cost;
                $seller->admin_to_pay = ([
                    'admin_to_pay' => ($request->payment_type == 'cash_on_delivery') ? $seller->admin_to_pay - ($price * $commission_percentage) / 100 : $seller->admin_to_pay + ($price * (100 - $commission_percentage)) / 100
                ]);
            }
        }
        if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
            $affiliateController = new AffiliateController;
            $affiliateController->processAffiliatePoints($order);
        }

        if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
            $rewardPoint =  new ClubPointController;
            $rewardPoint->processOrder($order);
        }

        // clear user's cart
        $user = User::findOrFail(auth()->id());
        $user->carts()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Your order has been placed successfully'
        ]);
    }catch(\Exception $e){
        return $e->getMessage();
    }
    }
}