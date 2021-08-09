<?php
namespace App\Http\ViewComposer;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class TestViewComposer
{
    public function compose(View $view)
    {
      
        $categories = Category::where('parent_id',0)->with('subCategory')->get();
        if(Auth::check())
        {
            $cart = Cart::where('user_id',auth()->user()->id)->get();
        }
        else
        {
            $cart = null;
        }
        $contacts = Contact::orderBy('id','DESC')->take(5)->get();
        
        $view->with(['categories'=>$categories,'cart'=>$cart,'contacts'=>$contacts]);
    }
}

?>