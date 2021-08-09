<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function create(Request $request)
    {
        $request->validate([
            'review'=>'required'
        ]);
        Comment::create([
            'user_id'=>auth()->user()->id,
            'review'=>$request->review,
            'ratings'=>$request->rating,
            'product_id'=>$request->product_id
        ]);
        return redirect()->back()->with('status','Comment Successfully Added');
    }
}

