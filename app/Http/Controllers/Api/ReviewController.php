<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ReviewProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    public function index($id)
    {
        $reviews = ReviewProduct::where('status', 1)->where('product_id', $id)->get();
        foreach ($reviews as $review) {
            $review->image = $review->users != null ? $review->users->getImage() ? $review->users->getImage()->smallUrl : asset('/front/img/default-product.jpg') : '';
            $review->name =$review->users !=null ? $review->users->name : '';
            $review->date = Carbon::parse($review->created_at)->format('d m, Y');
            unset($review->users);
        }

        $ratings = getRatings($id);
        $product_reviews = [
            'reviews' => $reviews,
            'ratings' => $ratings
        ];

        return response()->json($product_reviews);
    }

    public function store(Request $request)
    {
		if(user_purchased_product($request->product_id)){
         $validator = Validator::make($request->all(), [
            'stars'    => 'required',
            'review' => 'required',
        ] );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], Response::HTTP_NOT_ACCEPTABLE);
        }
		$user = auth()->user();
        $review             = new ReviewProduct();
        $review->user_id    = $user->id;
        $review->product_id = $request->product_id;
        $review->stars      = $request->stars;
        $review->review     = $request->review;
        $review->user_id   = Product::where('id', $request->product_id)->first()->user_id;
        $review->status     = 1;

        $review->save();

        return response()->json( ['messsage' => 'Review successfully added!'], 201 );   
    }else{
			 return  response()->json(['message'=>'You Cannot Review This Product']);
		
	}
}
}
