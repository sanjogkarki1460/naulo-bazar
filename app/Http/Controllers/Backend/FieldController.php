<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Category;
use App\Variation;
use Illuminate\Http\Request;

class FieldController extends BackendController
{
    //
    public function index()
    {
        $id =0;
        $categories = Category::orderByDesc('id')->get();
        $fields = Variation::where('user_id',auth()->user()->id)->with('category')->get();
        return view($this->_mainpages.'fields.list',compact('id','categories','fields'));
    }
    
  
}
