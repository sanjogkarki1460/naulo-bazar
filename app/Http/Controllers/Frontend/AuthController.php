<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;

use App\Models\Shop;
use App\Seller;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends FrontendController
{
    //
    public function login()
    {
        if (Auth::check()) {
            return redirect()->intended(route('home'))->with('status', 'Welcome To zholaa !');
        }
        return view($this->_loginpages . 'login.login');

    }

    public function checkLogin(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',

        ]);

        try {
            $remember = '';
            if ($request->remember_me) {
                $remember = True;
            } else {
                $remember = False;
            }

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                Auth::login($user, $remember);
                if ($user->hasRole('user')) {

                    return redirect()->intended(route('home'))->with('status', 'Welcome To zholaa !');
                } elseif ($user->hasRole('vendor')) {
                    return redirect()->intended(route('vendor-dashboard'))->with('status', 'Welcome To Vendor Dashboard !');
                } elseif ($user->hasRole('superadministrator')) {
                    return redirect()->intended(route('admin-dashboard'))->with('status', 'Welcome to Admin Dashboard');
                }

            } else {

                return redirect()->back()->with('error', "Sorry Your Credentials Don't Match Try Again !!");
            }
        } catch (QueryException $q) {
            return $q->getMessage();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:4',
            'phone' => 'unique:users'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);
        if ($request->role == 'buyer') {
            $user->attachRole('user');
        } elseif ($request->role == 'seller') {
            $user->user_type = 'vendor';
            $user->attachRole('vendor');
            $seller = new Seller;
            $seller->user_id = $user->id;
            if ($seller->save()) {
                $shop = new Shop;
                $shop->user_id = $user->id;
                $shop->slug = 'demo-shop-' . $user->id;
                $shop->save();
            }
            if ($user) {
                return redirect()->back()->with('status', 'Registered Successfully !');
            }

            return redirect()->back()->with('error', 'Something went wrong');

        }


    }
}