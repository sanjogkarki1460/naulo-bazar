<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index(Request $request)
    {
        //dd($request->session()->get('compare'));
        $categories = Category::all();
        return json_encode($categories);
    }

    //clears the session data for compare
    public function reset(Request $request)
    {
        $request->session()->forget('compare');
        return back();
    }

    //store comparing products ids in session
    public function addToCompare(Request $request)
    {
        if ($request->has('compare')) {
            $compare = $request->get('compare', collect([]));
            if (!$compare->contains($request->slug)) {
                if (count($compare) == 3) {
                    $compare->forget(0);
                    $compare->push($request->slug);
                } else {
                    $compare->push($request->slug);
                }
            }
        } else {
            $compare = collect([$request->slug]);
            return json_encode($compare);
        }


    }
}
