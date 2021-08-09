<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Color;
use App\Models\Product;
use App\Models\FlashDeal;
use Illuminate\Http\Request;
use App\Models\FlashDealProduct;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CartCollection;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index()
    {

        return new CartCollection(Cart::where('user_id', auth()->user()->id)->latest()->get());
    }

    public function add(Request $request)
    {

        try{
        $product = Product::findOrFail($request->id);
        $variant = '';
        if($request->variant)
        {
              $variant = $request->variant;
        }
        else
        {
            $variant = null;
        }
        
        $str = '';
        if($request->color){
             $str = Color::where('code', $request['color'])->first()->name;
          $variant = $str.'-'.$variant;
        }
        
       
        $tax = 0;

        if ($variant == null && $str == null){
            $price = $product->unit_price;
        
        }else{ 
            //$variations = json_decode($product->variations);
            $product_stock = $product->stocks->where('variant', $variant)->first();
            if($request->quantity > $product_stock->qty)
            {
                return response()->json(['message'=>'Stock Unavailable','status'=>400]);
            }
            $price = $product_stock->price;
        }

          $flash_deals = \App\Models\FlashDeal::where('status', 1)->get();
        $inFlashDeal = false;
        foreach ($flash_deals as $flash_deal) {
            if ($flash_deal != null && $flash_deal->status == 1  && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first() != null) {
                $flash_deal_product = \App\Models\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();
                if($flash_deal_product->discount_type == 'percent'){
                    $price -= ($price*$flash_deal_product->discount)/100;
                }
                elseif($flash_deal_product->discount_type == 'amount'){
                    $price -= $flash_deal_product->discount;
                }
                $inFlashDeal = true;
                break;
            }
        }
        if (!$inFlashDeal) {
            if($product->discount_type == 'percent'){
                $price -= ($price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $price -= $product->discount;
            }
        }

        if($product->tax_type == 'percent'){
            $tax = ($price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $tax = $product->tax;
        }

    
        if(Cookie::has('referred_product_id') && Cookie::get('referred_product_id') == $product->id) {
            $product_referral_code = Cookie::get('product_referral_code');
        }
        else{
            $product_referral_code = null;
        }
        Cart::updateOrCreate([
            'user_id' => $request->user_id ?? auth()->user()->id,
            'product_id' => $request->id,
            'variation' => $variant
        ], [
            'price' => $price,
            'tax' => $tax,

//            'product_referral_code' => $product_referral_code,
            'shipping_cost' => $product->shipping_type == 'free' ? 0 : $product->shipping_cost,
            'quantity' => $request->quantity ?? DB::raw('quantity + 1')
        ]);
            return response()->json(['message' => 'Product added to cart successfully'], 200);
    }catch(\Exception $e){
    return $e->getMessage();
        }
    }

    public function changeQuantity(Request $request)
    {
        $product = Product::where('id',$request->product_id)->first();
        if($product['current_stock'] < $request->quantity){
             return response()->json(['message' =>'Stock Available'.$product['current_stock']], 400);
        }
        elseif($request->quantity < 0){
          return response()->json(['message' =>'Error, Minimum 1 quantity required'], 400);   
        }
        $cart = Cart::findOrFail($request->id);
        $cart->update([
            'quantity' => $request->quantity
        ]);
        return response()->json(['message' => 'Cart updated'], 200);
    }

    public function destroy($id)
    {
      
       $delete = Cart::destroy($id);
     
        return response()->json(['message' => 'Product is successfully removed from your cart'], 200);
    }
}
