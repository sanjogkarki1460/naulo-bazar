<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ReviewProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BackendController;

class ReviewController extends BackendController
{
    public function index() {


        return view($this->_mainpages.'reviews.index' );
    }


    public function getReviewJson()
    {
        $reviews = ReviewProduct::all();
        foreach ($reviews as $review) {
            $review->product_name= Product::where('id', $review->product_id)->first()->name;
            $review->user_name= User::where('id', $review->user_id)->first()->user_name;
        }
        return datatables($reviews )->toJson();
    }


    public function updateStatus( Request $request, $id ) {
//        dd($request);

        $r=ReviewProduct::findorfail($id);
        $r->status=$request->status==1?0:1;
        $r->update();

        return response()->json( [
            'success' => true,
            'message' => 'Review status successfully updated!!'
        ] );
    }

    public function destroy( $id ) {
ReviewProduct::findorfail($id)->delete();
        return redirect()->back()->with( 'success', 'Review successfully deleted!!' );

    }

    public function seller_reviews()
    {
        $reviews = DB::table('reviews')
                    ->orderBy('id', 'desc')
                    ->join('products', 'reviews.product_id', '=', 'products.id')
                    ->where('products.user_id', Auth::user()->id)
                    ->select('reviews.id')
                    ->distinct()
                    ->paginate(9);

        foreach ($reviews as $key => $value) {
            $review = \App\Review::find($value->id);
            $review->viewed = 1;
            $review->save();
        }

        return view($this->_mainpages.'comment-review.comments', array('comments' => $reviews));
    }
    
}
