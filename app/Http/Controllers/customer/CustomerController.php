<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\User;
use App\Address;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function updateCustomerProfile(Request $request){
        $user = User::where('id',auth()->id())->first();
        $this->validate($request, [
            'name' => 'required | max:50',
            'email'=> 'required|email|unique:users,email,'.$user->id,
            'phone'=>'required|digits:10|numeric',
            'country' => 'required|max:30',
            'city' =>'required | max:30',
            'address' => 'required | max:250'
        ]);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->update();
        return response()->json('Profile updated succefully.',200);
    }

    public function addCustomerAddress(Request $request){
        
        $this->validate($request, [
            'home_region'=> 'required | max:255',
            'office_address'=> 'required | max:255',
            'office_region'=> 'required | max:255',
            'phone'=>'required|digits:10|numeric',
            'country' => 'required|max:30',
            'city' =>'required | max:30',
            'address' => 'required | max:250'
        ]);
        
        $address = new Address();
        $address->user_id = auth()->id();
        $address->address = $request->address;
        $address->home_region = $request->home_region;
        $address->phone = $request->phone;
        $address->country = $request->country;
        $address->city = $request->city;
        $address->office_region = $request->office_region;
        $address->office_address = $request->office_address;
        $address->save();

        return response()->json('Address Book updated succefully.',200);
    }

    public function updateCustomerAddress(Request $request){
        
        $this->validate($request, [
            'home_region'=> 'required | max:255',
            'office_address'=> 'required | max:255',
            'office_region'=> 'required | max:255',
            'phone'=>'required|digits:10|numeric',
            'country' => 'required|max:30',
            'city' =>'required | max:30',
            'address' => 'required | max:250'
        ]);
        
        $address = Address::where('user_id',auth()->id())->first();
        $address->address = $request->address;
        $address->home_region = $request->home_region;
        $address->phone = $request->phone;
        $address->country = $request->country;
        $address->city = $request->city;
        $address->office_region = $request->office_region;
        $address->office_address = $request->office_address;
        $address->update();

        return response()->json('Address Book updated succefully.',200);
    }
}
