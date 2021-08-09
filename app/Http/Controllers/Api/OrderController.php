<?php

namespace App\Http\Controllers\Api;

use App\ClubPoint;
use App\Http\Controllers\Backend\ClubPointController;
use DB;
use App\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\CouponUsage;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function processOrder(Request $request)
    {

        try{
        $shippingAddress = json_decode($request->shipping_address);

        // create an order
        $order = Order::create([
            'user_id' => $request->user_id,
            'shipping_address' => json_encode($shippingAddress),
            'payment_type' => $request->payment_type,
            'payment_status' => $request->payment_status,
            'grand_total' => $request->grand_total - $request->coupon_discount,
            'coupon_discount' => $request->coupon_discount,
            'code' => date('Ymd-his'),
			'date' => strtotime('now')

        ]);

        $cartItems = Cart::where('user_id', $request->user_id)->get();
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
                'payment_status' => $request->payment_status
            ]);
            $product->update([
                'num_of_sale' => DB::raw('num_of_sale + ' . $cartItem->quantity)
            ]);
        }
        // apply coupon usage
        if ($request->coupon_code != '') {
            CouponUsage::create([
                'user_id' => $request->user_id,
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
        $user = User::findOrFail($request->user_id);
        $user->carts()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Your order has been placed successfully'
        ]);
    }catch(\Exception $e){
        return $e->getMessage();
    }
    }

    public function store(Request $request)
    {
        return $this->processOrder($request);
    }

    public function guestCheckout(Request $request)
    {
        $order = new Order;
        if (Auth::check()) {
            $order->user_id = Auth::user()->id;
        } else {
            $order->guest_id = mt_rand(100000, 999999);
        }

        $order->shipping_address = json_encode($request['shipping_info']);

        $order->payment_type = $request->payment_option;
        $order->delivery_viewed = '0';
        $order->payment_status_viewed = '0';
        $order->code = date('Ymd-His') . rand(10, 99);
        $order->date = strtotime('now');

        if ($order->save()) {
            $subtotal = 0;
            $tax = 0;
            $shipping = 0;
            $admin_products = array();
            $seller_products = array();

            //Calculate Shipping Cost
            if (\App\Models\BusinessSetting::where('type', 'shipping_type')->first()->value == 'flat_rate') {
                $shipping = \App\Models\BusinessSetting::where('type', 'flat_rate_shipping_cost')->first()->value;
            } elseif (\App\Models\BusinessSetting::where('type', 'shipping_type')->first()->value == 'seller_wise_shipping') {
                foreach ($request->carts as $key => $cartItem) {
                    $product = \App\Models\Product::find($cartItem['product_id']);
                    if ($product->added_by == 'admin') {
                        array_push($admin_products, $cartItem['product_id']);
                    } else {
                        $product_ids = array();
                        if (array_key_exists($product->user_id, $seller_products)) {
                            $product_ids = $seller_products[$product->user_id];
                        }
                        array_push($product_ids, $cartItem['product_id']);
                        $seller_products[$product->user_id] = $product_ids;
                    }
                }
                if (!empty($admin_products)) {
                    $shipping = \App\Models\BusinessSetting::where('type', 'shipping_cost_admin')->first()->value;
                }
                if (!empty($seller_products)) {
                    foreach ($seller_products as $key => $seller_product) {
                        $shipping += \App\Models\Shop::where('user_id', $key)->first()->shipping_cost;
                    }
                }
            }
            //End Shipping Cost Calculation

            //Order Details Storing
            foreach ($request->carts as $key => $cartItem) {
                $product = Product::find($cartItem['product_id']);

                $subtotal += $cartItem['price'] * $cartItem['quantity'];
                $tax += $cartItem['tax'] * $cartItem['quantity'];

                $product_variation = $cartItem['variant'];
                if ($product_variation != null) {
                    $product_stock = $product->stocks->where('variant', $product_variation)->first();
                    $product_stock->qty -= $cartItem['quantity'];
                    $product_stock->save();
                } else {
                    $product->current_stock -= $cartItem['quantity'];
                    $product->save();
                }

                $order_detail = new OrderDetail;
                $order_detail->order_id = $order->id;
                $order_detail->seller_id = $product->user_id;
                $order_detail->product_id = $product->id;
                $order_detail->variation = $product_variation;
                $order_detail->price = $cartItem['price'] * $cartItem['quantity'];
                $order_detail->tax = $cartItem['tax'] * $cartItem['quantity'];
                $order_detail->shipping_type = $cartItem['shipping_type'];
                $order_detail->product_referral_code = $cartItem['product_referral_code'];

                //Dividing Shipping Costs
                if ($cartItem['shipping_type'] == 'home_delivery') {
                    if (\App\Models\BusinessSetting::where('type', 'shipping_type')->first()->value == 'flat_rate') {
                        $order_detail->shipping_cost = $shipping / count($request->carts);
                    } elseif (\App\Models\BusinessSetting::where('type', 'shipping_type')->first()->value == 'seller_wise_shipping') {
                        if ($product->added_by == 'admin') {
                            $order_detail->shipping_cost = \App\Models\BusinessSetting::where('type', 'shipping_cost_admin')->first()->value / count($admin_products);
                        } else {
                            $order_detail->shipping_cost = \App\Models\Shop::where('user_id', $product->user_id)->first()->shipping_cost / count($seller_products[$product->user_id]);
                        }
                    } else {
                        $order_detail->shipping_cost = \App\Models\Product::find($cartItem['product_id'])->shipping_cost;
                        $shipping += \App\Models\Product::find($cartItem['product_id'])->shipping_cost;
                    }
                } else {
                    $order_detail->shipping_cost = 0;
                    $order_detail->pickup_point_id = $cartItem['pickup_point'];
                }
                //End of storing shipping cost

                $order_detail->quantity = $cartItem['quantity'];
                $order_detail->save();

                $product->num_of_sale++;
                $product->save();
            }

            $order->grand_total = $subtotal + $tax + $shipping;

            if ($request->has('coupon_discount')) {
                $order->grand_total -= $request['coupon_discount'];
                $order->coupon_discount = $request['coupon_discount'];

                $coupon_usage = new CouponUsage;
                if(Auth::user()){
                    $coupon_usage->user_id = Auth::user()->id;
                }
                else{
                    $coupon_usage->user_id=$order->guest_id;
                }
                $coupon_usage->coupon_id = $request['coupon_id'];
                $coupon_usage->save();
            }

            $order->save();

            //stores the pdf for invoice

            // foreach ($seller_products as $key => $seller_product) {
            //     try {
            //         Mail::to(\App\User::find($key)->email)->queue(new InvoiceEmailManager($array));
            //     } catch (\Exception $e) {

            //     }
            // }

//            if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_order')->first()->value) {
//                try {
//                    $otpController = new OTPVerificationController;
//                    $otpController->send_order_code($order);
//                } catch (\Exception $e) {
//
//                }
//            }

            //sends email to customer with the invoice pdf attached
            // if (env('MAIL_USERNAME') != null) {
            //     try {
            //         Mail::to($request->session()->get('shipping_info')['email'])->queue(new InvoiceEmailManager($array));
            //         Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new InvoiceEmailManager($array));
            //     } catch (\Exception $e) {

            //     }
            // }
            // unlink($array['file']);

            $request->session()->put('order_id', $order->id);
        }
    }

    public function checkout_done($order_id, $payment)
    {
        $order = Order::findOrFail($order_id);
        $order->payment_status = 'paid';
        $order->payment_details = $payment;
        $order->save();

        if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
            $affiliateController = new AffiliateController;
            $affiliateController->processAffiliatePoints($order);
        }

        if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
            $clubpointController = new ClubPointController;
            $clubpointController->processClubPoints($order);
        }

        if(\App\Addon::where('unique_identifier', 'seller_subscription')->first() == null || !\App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated){
            if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
                $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
                foreach ($order->orderDetails as $key => $orderDetail) {
                    $orderDetail->payment_status = 'paid';
                    $orderDetail->save();
                    if($orderDetail->product->user->user_type == 'seller'){
                        $seller = $orderDetail->product->user->seller;
                        $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100 + $orderDetail->tax + $orderDetail->shipping_cost;
                        $seller->save();
                    }
                }
            }
            else{
                foreach ($order->orderDetails as $key => $orderDetail) {
                    $orderDetail->payment_status = 'paid';
                    $orderDetail->save();
                    if($orderDetail->product->user->user_type == 'seller'){
                        $commission_percentage = $orderDetail->product->category->commision_rate;
                        $seller = $orderDetail->product->user->seller;
                        $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100  + $orderDetail->tax + $orderDetail->shipping_cost;
                        $seller->save();
                    }
                }
            }
        }
        else {
            foreach ($order->orderDetails as $key => $orderDetail) {
                $orderDetail->payment_status = 'paid';
                $orderDetail->save();
                if($orderDetail->product->user->user_type == 'seller'){
                    $seller = $orderDetail->product->user->seller;
                    $seller->admin_to_pay = $seller->admin_to_pay + $orderDetail->price + $orderDetail->tax + $orderDetail->shipping_cost;
                    $seller->save();
                }
            }
        }

        $order->commission_calculated = 1;
        $order->save();
	}
}
