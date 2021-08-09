<?php

namespace App\Http\Controllers;
use App\Banner;
use App\Category;
use App\FlashDealProduct;
use App\FlashDeal;
use App\product;
use App\Shop;
use App\User;
use Carbon\Carbon;
use App\OrderDetail;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
   public function index(){
      $flashDeal = FlashDeal::with('flash_deal_products.product.user')->where('status',true)->where('end_date','>',strtotime(now()))->where('start_date','<',strtotime(now()))->first();
      //return $flashDeal;
      //$date = Carbon::parse($flashDeal->end_date);
      //$flash_date = gmdate("H:i:s", $date);
      //return secondsToTime($flashDeal->end_date);
      
      $topVendors = User::where('user_type','vendor')->with('shop')->withCount('products')->having('products_count','>',10)->orderBy('products_count','DESC')->limit(10)->get();
      
      $banners = Banner::where('published',true)->orderBy('position','desc')->get();
      $category = Category::latest()->get();
      $bestSelling = Product::whereHas('orderDetails')
                    ->withCount('orderDetails')
                    ->with('user','reviews')
                    ->orderBy('order_details_count','desc')
                    ->limit(10)->get();
      $recommended = Product::where('featured',true)->where('published',true)->with('user')->get();
      
      return view('welcome',compact('category','banners','flashDeal','bestSelling','recommended','topVendors'));
   }

   public function homepageData(){
      $flashDeal = FlashDealProduct::with('product')->get();
 
      $recommended = Product::where('featured',true)->where('published',true)->with('user')->get();
      return response()->json($flashDeal,200);
   }

   public function allProduct(){
      $product =Product::with('user','reviews')->simplePaginate(12);
      return response()->json($product,200);
   }

   public function stores(){
      $stores  = User::where('user_type','vendor')->with('shop')->get();
      return view('stores',compact('stores'));
   }
}
