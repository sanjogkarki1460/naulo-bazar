<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Brand;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends BackendController
{
    public function home_settings(Request $request)
    {
        return view($this->_mainpages . 'home_settings.index');
    }

    public function top_10_settings(Request $request)
    {
        foreach (Category::all() as $key => $category) {
            if (in_array($category->id, $request->top_categories)) {
                $category->top = 1;
                $category->save();
            } else {
                $category->top = 0;
                $category->save();
            }
        }

        foreach (Brand::all() as $key => $brand) {
            if (in_array($brand->id, $request->top_brands)) {
                $brand->top = 1;
                $brand->save();
            } else {
                $brand->top = 0;
                $brand->save();
            }
        }
        return redirect()->route('home_settings.index')->with('status', 'Top 10 categories and brands updated successfully !');
    }
}
