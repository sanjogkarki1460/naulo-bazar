<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pipeline\Pipeline;
use App\User;
use App\Product;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function seller($id){
       $user = User::with('shop','seller')->findOrFail($id);
       return view('customer.sellerDetail',compact('user'));
    }

    public function sellerProduct($id){
      $products = app(Pipeline::class)
                  ->send(Product::query())
                  ->through([
                       \App\Filter\Sort::class,
                  ])
                  ->thenReturn();
      
      $product = $products->where('user_id',$id)->paginate(20);
      $total_product = $product->total();
      return response()->json(['product'=>$product,'total_product'=>$total_product],200);
    }

    public function login(){
        if(!Auth::check()){
            return view('customer.login');
        }
        return redirect()->route('welcome');
    }

    public function signup(){
        if(!Auth::check()){
            return view('customer.signup');
        }
        return redirect()->route('welcome');
        
    }

    public function register(Request $request){
      $request->validate([
          'name' => 'required|string|max:50',
          'email' => 'required|email|max:50|unique:users',
          'password' => 'required|min:6',
          'password_confirmation' =>'required_with:password|same:password|min:6',
          'phone' => 'required|digits:10|numeric',
          'date_of_birth'=>'required|date|before:16 years ago',
          'gender' => 'required',
      ]);
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->phone = $request->phone;
      $user->dob = $request->date_of_birth;
      $user->gender = $request->gender;
      $user->save();
      Auth::login($user);
      return response()->json('Welcome to '.config('app.name'),200);
    }

    public function authenticate(Request $request){
        
        
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);
        $remember = $request->remember;
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials,$remember)) {
            return redirect()->route('welcome');
        }
        return redirect()->route('customer.login')->withErrors('Oppes! You have entered invalid credentials');
    }

    public function changePassword(Request $request){
        $this->validate($request, [
          'old_password' => 'required|min:6',
          'password'      => 'required|min:6',
          'password_confirmation' =>'required_with:password|same:password|min:6',
        ]);
        $hashedPassword= Auth::user()->password;
        if(Hash::check($request->old_password,$hashedPassword)){
          if(!Hash::check($request->password,$hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::guard('web')->logout();
            session()->flush();
            return response()->json(['success'=>'Password Changed Succefully !'],200);
          }
          else
          {
            return response()->json(['error'=>'New password cannot be same as old password'],200);
          }
        }
        else
        {
          return response()->json(['error'=>'Invalid Old Password'],200);

        }
      }
}
