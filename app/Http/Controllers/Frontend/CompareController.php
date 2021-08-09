<?php

namespace App\Http\Controllers\Frontend;

use App\Compare;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    //

    public function create($id)
    {
        $product = Product::findOrFail($id);
        $oldCompare = session()->get('compare') ?  session()->get('compare') : null;
        $compare = new Compare($oldCompare);
        $compare->create($id,$product);
        session()->put('compare',$compare);
        return redirect()->back()->with('status','Comparision Added');


    }

    public function delete($id)
    {
        $deleteCompare = session()->get('compare') ?  session()->get('compare') : null;
        if($deleteCompare)
        {
            unset($deleteCompare->items[$id]);              //step 2
            session()->put('product', $deleteCompare); 
          
        }
     
        return redirect()->back()->with('status','Comparision Deleted');
    }
    public function removeGuestCart($id)
    {
       
        $deleteCart = session()->get('cart') ?  session()->get('cart') : null;
      
        if($deleteCart)
        {
            unset($deleteCart->items[$id]);              //step 2
            session()->put('cart', $deleteCart); 
          
        }
     
        return redirect()->back()->with('status','Cart Deleted');
    }
}
