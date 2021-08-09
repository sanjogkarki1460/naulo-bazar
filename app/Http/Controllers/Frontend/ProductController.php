<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends FrontendController
{
    //
    public function index($id)
    {
        $category = Category::with('products')->findOrFail($id);
        $categoryproduct = $category->products()->paginate(5);
        $othercategories = Category::where('id', '<>', $id)->take(10)->get();
        $brands = Brand::where('status', 1)->where('feature', 1)->get();
        return view($this->_mainpages . 'view-product.category-product', compact('categoryproduct', 'category', 'othercategories', 'brands'));
    }

    public function hotProduct()
    {

        $othercategories = Category::where('status', 1)->take(10)->get();
        $categoryproduct = Product::where('offer', 'flash')->get();
        $brands = Brand::where('status', 1)->where('feature', 1)->get();
        return view($this->_mainpages . 'view-product.hot-product', compact('categoryproduct', 'othercategories', 'brands'));
    }

    public function dealsProduct()
    {
        $othercategories = Category::where('status', 1)->take(10)->get();
        $categoryproduct = Product::where('offer', 'deals')->get();
        $brands = Brand::where('status', 1)->where('feature', 1)->get();
        return view($this->_mainpages . 'view-product.deals-product', compact('categoryproduct', 'othercategories', 'brands'));
    }


}
