<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SubCategoryCollection;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function index($slug)
    {
		
	    return new SubCategoryCollection(SubCategory::where('slug', $slug)->get());
    }
}
