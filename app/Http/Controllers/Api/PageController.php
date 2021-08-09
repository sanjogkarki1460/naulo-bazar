<?php

namespace App\Http\Controllers\Api;


use App\Pages;
use Illuminate\Support\Facades\DB;



Class PageController extends Controller {

    function index(){
        $pages = DB::table('pages')->where('display',1)->get();
        return $pages;
    }

    function details(String $slug){
        $page = Pages::where('slug',$slug)->firstOrFail();
       if(isset($page)){
           return [
            
               'pageTitle' => $page->title,
               'subTitle' => $page->subtitles,
               'slug' => $page->slug,
               'orderNumber' => $page->order_item,
               'image' => $page->image ?? 'N/A',
               'featured' => $page->featured,
               'parent_id' => $apage->parent_id,
               'child' => $page->child_id,
               'shortContent' => $page->excerpt,
               'description' => $page->content, 
           ];
       }else{
           abort('404');
       }
    }
   
}