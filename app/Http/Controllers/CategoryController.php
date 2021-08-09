<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\SubCategory;
use Illuminate\Pipeline\Pipeline;
use App\Brand;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug){
        $category = Category::where('slug',$slug)->with('subcategories')->first();
        $brand = Brand::all(); 
        return view('front.CategoryProduct',compact('category','brand'));
    }

    public function subcategory($slug){
        $subcategory = Subcategory::where('slug',$slug)->with('category')->first();
        $brand = Brand::all();
        return view('front.SubCategoryProduct',compact('subcategory','brand'));
    }

    public function categoryProduct(Request $request,$slug){
        
        //$subcategory = SubCategory::where('id',$slug)->with('category')->first();
        $user_type = $request->user_type;
        //$products = Product::where('category_id',$slug)->with('user','reviews')->paginate($request->per_page);
        $product = app(Pipeline::class)
        ->send(Product::query())
        ->through([
             \App\Filter\Brand::class,
             \App\Filter\Sort::class,
             \App\Filter\Brand::class,
             \App\Filter\Price::class,
        ])
        ->thenReturn();
        
        $products = $product->where('category_id',$slug)->with('user','reviews')
                            ->whereHas('user', function($q) use ($user_type){
                                if($user_type){
                                    $q->whereIn('user_type',$user_type);
                                }
                            })
                           ->paginate($request->per_page)
                           ->appends([
                            'sort' => request('sort'),
                            'per_page' => request('per_page'),
                            'brand_id' => request('brand_id'),
                            'user_type'=> request('user_type'),
                            'price'=> request('price')
                           ]);
        $total_product = $products->total();
        return response()->json(['products'=>$products,'total_product'=>$total_product],200);
    }

    public function subCategoryProduct(Request $request,$slug){
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
        $products =$product->where('subcategory_id',$slug)->with('user','reviews')
                            ->whereHas('user', function($q) use ($user_type){
                                if($user_type){
                                    $q->whereIn('user_type',$user_type);
                                }
                            })
                           ->paginate($request->per_page)
                           ->appends([
                            'sort' => request('sort'),
                            'per_page' => request('per_page'),
                            'brand_id' => request('brand_id'),
                            'user_type'=> request('user_type'),
                            'price'=> request('price')
                           ]);
        $total_product = $products->total();
        return response()->json(['products'=>$products,'total_product'=>$total_product],200);
    }

    public function getAllCategory(){
        $category = Category::with('subcategories')->get();
        return response()->json($category,200);
    }
}
