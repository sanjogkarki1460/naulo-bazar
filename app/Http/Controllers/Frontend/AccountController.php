<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DeliveryAddress;
use App\Models\UserAddress;
use App\Models\WishList;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //
    public function profile()
    {
        return view('frontend.body.account.profile');
    }
    public function address()
    {
        $deliveries = DeliveryAddress::orderBy('id','DESC')->get();
        return view('frontend.body.account.address',compact('deliveries'));
    }
    public function wishlist()
    {
        $wishlist = null;
        if(Auth::check())
        {
            $wishlist = WishList::where('user_id',auth()->user()->id)->get();
        }
        return view('frontend.body.account.wishlist',compact('wishlist'));
    }
    public function order()
    {
        $orders = Order::where('user_id',auth()->user()->id)->get();
        return view('frontend.body.account.order',compact('orders'));
    }

 

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        if(Hash::check($request->old_password, auth()->user()->password))
        {
             User::findOrFail(auth()->user()->id)->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->back()->with('status','Successfully Changed!!');
        }
        else
        {
            return redirect()->back()->with('error','Password is incorrect');
        }

        return redirect()->back()->with('error','Something went wrong!!');
        
    }

    public function updateProfile(Request $request)
    {
        if(Hash::check($request->confirmpassword, auth()->user()->password))
        {
             User::findOrFail(auth()->user()->id)->update([
                'phonenumber' => $request->phonenumber,
                'name' => $request->name,
            ]);
            return redirect()->back()->with('status','Successfully Updated!!');
        }
        else
        {
            return redirect()->back()->with('error','Password is incorrect');
        }

        return redirect()->back()->with('error','Something went wrong!!');
        
    }

    public function updateAddress(Request $request)
    {
       
        $userAddress = UserAddress::where('user_id',auth()->user()->id)->first();
        if($userAddress)
        {
            $userAddress->update([
                'user_id'=>auth()->user()->id,
                'address1'=>$request->address1,
                'address2'=>$request->address2,
                'city'=>$request->city,
                'zip_code'=>$request->zip_code,
                'company' => $request->company
            ]);
            return redirect()->back()->with('status','Successfully Updated');
        }
        else{
            UserAddress::create([
                'user_id'=>auth()->user()->id,  
                'address1'=>$request->address1,
                'address2'=>$request->address2,
                'city'=>$request->city,
                'zip_code'=>$request->zip_code,
                'company' => $request->company
            ]);

            return redirect()->back()->with('status','Successfully Created');
        }

        return redirect()->back('error','Something went wrong!');
    }


}
