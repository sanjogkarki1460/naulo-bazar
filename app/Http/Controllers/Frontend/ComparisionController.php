<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;

class ComparisionController extends FrontendController
{
    //
    public function index()
    {
        return view($this->_mainpages.'compare.index');
    }
}
