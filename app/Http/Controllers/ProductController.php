<?php

namespace App\Http\Controllers;
use App\Product;
use  App\User;
use App\Review;
use Illuminate\Support\Collectionl;
use App\FlashDealProduct;
use App\FlashDeal;
use App\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product_detail($slug){
        $product= Product::where('slug',$slug)->with('reviews.user','category','user.shop','subCategory','stocks')->first();
        //return $product;
        $related_product = Product::where('category_id',$product->category_id)->where('id','!=',$product->id)->with('user')->limit(10)->get();
        
        return view('front.productDetail',compact('product','related_product'));
    }

    

    public function flashSell(){
      $flashDeal = FlashDeal::with('flash_deal_products')->where('status',true)->where('end_date','>',strtotime(now()))->where('start_date','<',strtotime(now()))->first();
      
      if($flashDeal){
        return view('front.flash-sell',compact('flashDeal'));
      }
      return redirect()->route('welcome');
    }

    public function flasProduct($id){
      $flashProduct = FlashDealProduct::where('flash_deal_id',$id)->with('product.user')->paginate(25);
      return response()->json($flashProduct,200);
    }

    public function productReviews($id){
        $reviews= Review::where('product_id',$id)->with('user')->latest()->get();
        $count = $reviews->count();
        $rating_percent = [];
        $i=5;
        if($count >0){
          for($i=5; $i>=1; $i--){
            $rating_percent[$i] = floor($reviews->where('rating',$i)->count()/$count*100);
          }
        }else{
          $rating_percent=[
            '1'=>0,
            '2'=>0,
            '3'=>0,
            '4'=>0,
            '5'=>0
          ];
        }
        return response()->json(['reviews'=>$reviews,'rating_precent'=>$rating_percent],200);
    }

    public function addReview(Request $request,$id){
     
      $this->validate($request, [
        'rating' => 'required',
        'comment'=> 'required',
      ]);
      $review = new Review();
      $review->product_id = $request->id;
      $review->user_id = auth()->id();
      $review->rating = $request->rating;
      $review->comment = $request->comment;
      $review->save();
      return response()->json('Thank you for your feedback',200);
    }

    public function add_to_wishlist($id){
        if(auth()->check()){
            $user= Auth::user();
            $isfavorite = $user->wishlist_product()->where('product_id',$id)->count();
            if($isfavorite == 0){
              $user->wishlist_product()->attach($id);
              return response()->json('succefully added to wishlist',200);
            }else{
              $user->wishlist_product()->detach($id);
              return response()->json('removed from wishlist',200);
            }
        }
        return response()->json('Please login first',403);
    }

    public function wishlistCount(){
      
      if(auth()->check()){
        $wishlistCount = Wishlist::where('user_id',auth()->id())->count();
        
      }else{
        $wishlistCount = 0;
      }
      return response()->json($wishlistCount,200);
    }
}
