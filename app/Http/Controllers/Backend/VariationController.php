<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Variation;
use Illuminate\Http\Request;

class VariationController extends BackendController
{
    //
    public function store(Request $request)
    {
        if (Variation::where('category_id', '=', $request->category_id)->where('user_id', auth()->user()->id)->count() > 0) {
            // user found
            return redirect()->back()->with('error', 'Category Already Exist');
        }
        $variation = Variation::create([
            'category_id' => $request->category_id,
            'title' => json_encode($request->title),
            'user_id' => auth()->user()->id
        ]);
        if ($variation) {
            return redirect()->back()->with('status', 'Added Succesfully');
        }
    }

    public function delete($id)
    {
        $delete = Variation::where('id', $id)->delete();
        return redirect()->back()->with('status', 'Deleted Successfully');
    }

}
