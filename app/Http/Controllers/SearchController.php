<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use App\Brand;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Http\Request;

class SearchController extends Controller
{
   
    public function index(){
        $brand = Brand::all();
        $category = request()->category;
        $keyword = request()->keyword;
        return view('front.searchResult',compact('brand','category','keyword'));
    }

    

    public function result(Request $request){
       
        $user_type = $request->user_type;
        
        $user_type = $request->user_type;
        $product = app(Pipeline::class)
        ->send(Product::query())
        ->through([
             \App\Filter\Brand::class,
             \App\Filter\Sort::class,
             \App\Filter\Brand::class,
             \App\Filter\Price::class,
        ])
        ->thenReturn();
        
        if($request->category){
            $category = Category::where('slug',$request->category)->first();
            if($category){
                $product->where('category_id',$category->id);
            }
            
        }

        if($request->keyword){
            $product->where('name','LIKE',"%{$request->keyword}%");
        }
        
        //$product = Product::where('category_id',$category->id)->orWhere('title','LIKE', "%{$keyword}%");
        $products=$product->with('user')->whereHas('user', function($q) use ($user_type){
            if($user_type){
                $q->whereIn('user_type',$user_type);
            }
        })->paginate($request->per_page)
        ->appends([
         'sort' => request('sort'),
         'per_page' => request('per_page'),
         'brand_id' => request('brand_id'),
         'user_type'=> request('user_type'),
         'price'=> request('price'),
         'category' => request('category'),
         'keyword'  => request('keyword')
        ]);
        $total_product = $products->total();
        return response()->json(['products'=>$products,'total_product'=>$total_product],200);
    }
}
