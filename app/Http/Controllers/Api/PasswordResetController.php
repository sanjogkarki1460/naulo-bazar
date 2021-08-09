<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\User;
use App\Models\PasswordReset;
use App\Notifications\PasswordResetRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function create(Request $request)
    {
		$request->validate([
            'email' => 'required|string|email',
        ]);
try
{
        $user = User::where('email', $request->email)->first();

        if (!$user)
            return response()->json([
                'success' => false,
                'message' => 'We can not find a user with that e-mail address'], 404);

        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(60)
            ]
        );

        if ($user && $passwordReset)
            $user->notify(
                new PasswordResetRequest($passwordReset->token,$request->link)
            );

        return response()->json([
            'success' => true,
            'message' => 'Please check your email. We have e-mailed your password reset link'
        ], 200);
    }catch(QueryException $q){
	return 'Email Address Not Found !';
}catch(\Exception $e){
	return $e->getMessage();
	}
	}

	
	public function resetPassword(Request $request)
	{
	try{
        $userMail = PasswordReset::where('token',$request->token)->firstOrFail();

		if($userMail){
		$user = User::where('email',$userMail->email)->FirstOrFail();
		$user->password = Bcrypt($request->password);
			$user->save();
			return response()->json(['message'=>'Password Changed Successfully!!'],200);
		}else{
		return response()->json(['message' => 'User Not Found ! Try Again !']);	
		}
	
	}catch(QueryException $q){
        return 'Email Not Found || Token Expired';
    }catch(\Exception $e){
        return $e->getMessage();
    }
}

}