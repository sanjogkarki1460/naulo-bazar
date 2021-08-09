<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Category;
use App\CategoryPoint;
use App\RewardPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Miracuthbert\Royalty\Models\Point;
use Illuminate\Support\Str;
class RewardController extends BackendController
{
    //
    public function index()
    {
        $categories = Category::with('rewardPoint')->get();
    
        return view($this->_mainpages."reward-point.index",compact('categories'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'category_id' => 'required|unique:category_points,category_id'
        ]);
       $point = new Point();
       $point->name = 'completed checkout';
       $point->key = $this->createSlug('complete-checkout');
       $point->description = 'Reward For Completing a order';
       $point->points = $request->points; 
       $point->save();

            CategoryPoint::create([
                'point_id'=>$point->id,
                'category_id' => $request->category_id
            ]);
       

        return redirect()->back()->with('status','Reward Point Set');
        
    }
    public function createSlug($title, $id = 0)
    {
        $slug = Str::slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (!$allSlugs->contains('key', $slug)){
            return $slug;
        }
      
        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('key', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
        
    }
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Point::select('key')->where('key', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }

    public function edit(Request $request,$id)
    {
        $point = Point::findOrFail($id);
        $update = $point->update([
            'points' => $request->points
        ]);
        if($update)
        {
            return redirect()->back()->with('status','Reward Point Successfully Updated');
        }

        return redirect()->back()->with('error','Something Went Wrong!!');
    }

    public function delete($id)
    {

        // $rewardPoint = CategoryPoint::with('points')->where('category_id',$id)->first();
        $data = DB::table("points")->where('id', $id)->delete();
        $category = CategoryPoint::where('point_id',$id)->delete();
        if($data && $category)
        {
            return redirect()->back()->with('status','Reward Point Successfully Updated');
        }

        return redirect()->back()->with('error','Something Went Wrong!!');
    }
}
