<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Address;
use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
		$request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6'
        ]);
        $user = '';
        $userType = $request->role;
        switch ($userType) {
            case 'vendor':
                $user = new User([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'email_verified_at' => Carbon::now()
                ]);
			
                $user->save();
                $user->attachRole('vendor');
		
                break;
            default:
                $user = new User([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'email_verified_at' => Carbon::now()
                ]);
                $user->save();
                $customer = new Customer;
                $customer->user_id = $user->id;
                $customer->save();
                break;
        }
		
        $user->referral_code()->create([
            'user_id' => $user->id,
            'referal_code' => $user->user_name . rand(0, 9) . rand(0, 9) . rand(0, 9)
        ]);
		
	    return response()->json([
            'message' => 'Registration Successful. Please log in to your account'
        ], 201);
    }

    public function login(Request $request)
    {
		
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json(['message' => 'Unauthorized'], 401);
        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        return $this->loginSuccess($tokenResult, $user);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Logged Out Successfully !'
        ]);
    }

    public function socialLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email'
        ]);
        if (User::where('email', $request->email)->first() != null) {
            $user = User::where('email', $request->email)->first();
        } else {
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'provider_id' => $request->provider,
                'email_verified_at' => Carbon::now()
            ]);
            $user->save();
            $customer = new Customer;
            $customer->user_id = $user->id;
            $customer->save();
        }
        $tokenResult = $user->createToken('Personal Access Token');
        return $this->loginSuccess($tokenResult, $user);
    }

    protected function loginSuccess($tokenResult, $user)
    {
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addWeeks(100);
        $token->save();
        $address = Address::where([['user_id',$user->id],['set_default',1]])->first();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'user' => [
                'id' => $user->id,
                'type' => $user->user_type,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'avatar_original' => $user->avatar_original,
                'address' => $user->address != '' ? $user->address : $address->address ?? 'N/A',
                'country' => $user->country != '' ? $user->country : $address->country ?? 'N/A',
                'city' =>  $user->city != '' ? $user->city : $address->city ?? 'N/A',
                'postal_code' => $user->postal_code !='' ? $user->postal_code : $address->postal_code ?? 'N/A',
                'phone' =>$user->phone !='' ? $user->phone : $address->phone ?? 'N/A',
                'FollowedStore' => $user->subscriptions()->count(), 
                'storesFollowed' => $this->following($user),                ]
            
        ]);
    }

    public function changePassword(Request $request)
    {
        $this->validate($request,[
            'oldPassword' => 'required',
            'password' => 'required|string',
        ]);
        
        $oldPassword = $request->oldPassword;
        if (!Hash::check($oldPassword, Auth::user()->password)) {
            return response()->json(['success'=>false, 'message' => 'Old Password Not Matched']);
         } else {
             Auth::user()->password = bcrypt($request->password);
             Auth::user()->save();
             return response()->json(['success'=> True, 'message' => 'Password Changed Successfully']);
         }
    }

   
    protected function following(User $user)
	{
    $shops = $user->subscriptions()->get();
		$ids = collect();
        foreach($shops as $shop) {
            // echo $user->name;
            $ids->push($shop->subscribable_id);
        }
		return $ids;
    }
}
