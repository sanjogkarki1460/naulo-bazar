<?php
namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\BackendController;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends BackendController
{
    public function login()
    {
        
        if (!Auth::check()) {
            return view($this->_login . 'login')->with('error', 'Please Log In First To Continue');
        } else {
            return redirect(route('admin-dashboard'));
        }


    }

    public function loginAction(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',

        ]);

        try {
            $remember = '';
            if ($request->remember) {
                $remember = True;
            } else {
                $remember = False;
            }
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
		  if($user->hasRole('admin'))   {
                return redirect()->intended(route('admin-dashboard'))->with('status', 'Welcome To Admin Dashboard !');
                }
                elseif($user->hasRole('vendor')){
            
                    return redirect()->intended(route('vendor-dashboard'))->with('status', 'Welcome To Vendor Dashboard !');
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

    public function logOut(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        return redirect('/')->with('status', 'Logged Out Successfully !');
    }

    
}
