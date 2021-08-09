<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SortController extends FrontendController
{
    //
    public function high()
    {
        
        $othercategories = Category::where('status',1)->take(10)->get();
        $categoryproduct = Product::orderBy('price','DESC')->where('offer','deals')->paginate(5);
        $brands = Brand::where('status',1)->where('feature',1)->get();
        $returnHTML = view('frontend.body.view-product.product-data')->with( ['othercategories'=>$othercategories,
        'categoryproduct'=>$categoryproduct,
        'brands'=>$brands])->render();
        return response()->json(['success'=>true,'html'=>$returnHTML]);
    }

    public function low()
    {
        $othercategories = Category::where('status',1)->take(10)->get();
        $categoryproduct = Product::orderBy('price','DESC')->where('offer','deals')->paginate(5);
        $brands = Brand::where('status',1)->where('feature',1)->get();
        $returnHTML = view('frontend.body.view-product.product-data')->with(['othercategories'=>$othercategories,
        'categoryproduct'=>$categoryproduct,
        'brands'=>$brands])->render();
        
        return response()->json(['success'=>true,'html'=>$returnHTML]);
    }
}
