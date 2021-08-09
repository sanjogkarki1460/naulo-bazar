<?php

namespace App\Http\Controllers\Api;

use App\Addon;
use App\Models\Shop;
use App\Models\Product;

use Illuminate\Support\Facades\Session;
use App\Models\BusinessSetting;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Illuminate\Http\Request;

class AddOnController extends Controller

{

    public function rewardPoint(Request $request)
    {
    $total_point = 0;
    $carts = $request->carts;
    if(Addon::where('unique_identifier', 'club_point')->first() != null && Addon::where('unique_identifier', 'club_point')->first()->activated)
    {
    foreach($carts as $key => $cartItem)
    {
        $product = Product::find($cartItem['id']);
        $total_point += $product->earn_point*$cartItem['quantity'];
    } 
    return $total_point;
    }
    return $total_point;
    }

    public function detailPrice()
    {
    $subtotal = 0;
    $tax = 0;
    $shipping = 0;
    if (BusinessSetting::where('type', 'shipping_type')->first()->value == 'flat_rate') 
    {
    $shipping = BusinessSetting::where('type', 'flat_rate_shipping_cost')->first()->value;
    }
    $admin_products = array();
    $seller_products = array();
    foreach (Session::get('cart') as $key => $cartItem)
    {
    $product = Product::find($cartItem['id']);
    if($product->added_by == 'admin')
    {
        array_push($admin_products, $cartItem['id']);
    }
    else
    {
        $product_ids = array();
        if(array_key_exists($product->user_id, $seller_products))
        {
            $product_ids = $seller_products[$product->user_id];
        }
        array_push($product_ids, $cartItem['id']);
        $seller_products[$product->user_id] = $product_ids;
    }
        $subtotal += $cartItem['price']*$cartItem['quantity'];
        $tax += $cartItem['tax']*$cartItem['quantity'];
        if (BusinessSetting::where('type', 'shipping_type')->first()->value == 'product_wise_shipping') 
        {
        $shipping += $cartItem['shipping'];
        }
        $product_name_with_choice = $product->name;
        if ($cartItem['variant'] != null) {
            $product_name_with_choice = $product->name.' - '.$cartItem['variant'];
        }
    } 
        if(BusinessSetting::where('type', 'shipping_type')->first()->value == 'seller_wise_shipping')
            {
            if(!empty($admin_products))
            {
                $shipping = BusinessSetting::where('type', 'shipping_cost_admin')->first()->value;
            }
            if(!empty($seller_products)){
                foreach ($seller_products as $key => $seller_product) {
                    $shipping += Shop::where('user_id', $key)->first()->shipping_cost;
                }
            }
        }
    }
}