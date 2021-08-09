<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Models\Market;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorFollowController extends FrontendController
{
    //
    public function index()
    {
        $markets = Market::with('users')->get();
        \
        return view($this->_mainpages.'vendor-follow.vendorfollow',compact('markets'));
    }

    public function follow($market_id)
    {
        $market = Market::findOrFail($market_id);
         $user = User::findOrFail(Auth::user()->id);
      
       if(!$user->hasSubscribed($market))
       {
            $user->subscribe($market);
            return redirect()->back()->with('status','Successfully Followed');
       }
       else
       {
            $user->unsubscribe($market);
            return redirect()->back()->with('status','Successfully unfollowed');
        }
    }
}
