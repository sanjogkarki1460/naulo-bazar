<?php

namespace App\Http\Controllers\Seller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Seller;
use App\Shop;
use Carbon\Carbon;
use App\Http\Requests\SellerRequest;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function sellerSignUp(){
        return view('seller.signUp');
    }

    public function sellerLogin(){
        return view('seller.signUp');
    }

    public function SellerRegister(SellerRequest $request){
        $user = new User();
        $user->name     = $request->first_name." ".$request->last_name;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone    = $request->phone;
        $user->country  = $request->country;
        $user->city     = $request->city;
        $user->address  = $request->address;
        $user->user_type     = 'vendor';
        $user->save();
        $user->attachRole('vendor');
        if($user){
            //shop table store data
            $shop = new shop();
            $shop->user_id = $user->id;
            $shop->name = $request->shop_name;
            $shop->address = $request->shop_address;
            $shop->phone  = $request->shop_phone;
            $shop->slug  = $request->shop_url;
            $shop->phone = $request->shop_phone;
            $shop->pan = $request->shop_pan_or_vat_no;
            $shop->save();


            //seller table store data
            $seller = new Seller();
            $cover = $request->file('citizen_front_photo');
            
            $currentDate = Carbon::now()->toDateString();
            
            $front_cover = $currentDate.'-'.uniqid().'.'.$request->citizen_front_photo->getClientOriginalExtension();
            $back_cover = $currentDate.'-'.uniqid().'.'.$request->citizen_back_photo->getClientOriginalExtension();
            
            $request->citizen_front_photo->storeAs('citizenship/',$front_cover);
            $request->citizen_back_photo->storeAs('citizenship/',$back_cover);
            $seller->user_id =  $user->id;
            $seller->citizenship_front_photo = $front_cover;
            $seller->citizenship_back_photo  = $back_cover;
            $seller->save();
            Auth::login($user);
            return response()->json('waint for admin response',200);
        } 
    }
}
