<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AffilateUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AffiliateController extends FrontEndController
{
    //
    public function index()
    {
        return view($this->_mainpages.'affiliate.index');
    }

    public function create(Request $request)
    {
       
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'address'=>'required',
            'phone_number'=>'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required| min:6',
            'email'=>'required|unique:users'
        ]);   
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->phonenumber = $request->phone_number;
        $user->save();
        $affilate = AffilateUser::create([
            'user_id' => $user->id,
            'email' => $request->email,
            'description'=>$request->description
        ]);
        if($user && $affilate)
        {
            return redirect()->back()->with('status','Successfully Created');
        }

        return redirect()->back()->with('status','Successfully Created');
    }
}
