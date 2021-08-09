<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\ApiIntegration;
use Exception;
use Illuminate\Http\Request;

class ApiIntregationController extends BackendController
{
    //
    public function paypal()
    {

        return view('paypal');
    }
    public function gmailIndex()
    {
        return view($this->_mainpages.'api-intregation.api-gmail');
    }
    public function googleAnalytics()
    {
        return view($this->_mainpages.'api-intregation.api-googleanalytics');
    }
    public function googleAnalyticsStore()
    {

    }
    public function checkoutIntregation()
    {
        $id=0;
        return view($this->_mainpages.'api-intregation.api-checkout',compact('id'));
    }
    public function checkoutIntregationstore(Request $request)
    {
        
        if($request->mode == 'sandbox')
        {
            $this->setEnv('PAYPAL_SANDBOX_API_USERNAME',$request->value['username']);
            $this->setEnv('PAYPAL_SANDBOX_API_PASSWORD',$request->value['password']);
            $this->setEnv('PAYPAL_SANDBOX_API_SECRET',$request->value['secret']);
            $this->setEnv('PAYPAL_SANDBOX_API_CERTIFICATE',$request->value['certificate']);
        }
        else{
            $this->setEnv('PAYPAL_LIVE_CLIENT_ID',$request->value['client_id']);
            $this->setEnv('PAYPAL_LIVE_CLIENT_SECRET',$request->value['client_secret']);
        }
       try{
           if(ApiIntegration::where('title','paypal')->exists())
           {
            $paypal = ApiIntegration::where('title','paypal')->first();
            $paypal->update([
                'title'=>'paypal',
                'mode'=>$request->mode,
                'status'=>$request->status,
                'values'=>json_encode($request->value)
            ]);
            return redirect()->back()->with('status','Successfully Updated');
           }

           else
           {
            ApiIntegration::create([
                'title'=>'paypal',
                'mode'=>$request->mode,
                'status'=>$request->status,
                'values'=>json_encode($request->value)
            ]);
           }

        return redirect()->back()->with('status','Successfully added');
       }
       catch(Exception $e)
       {
            dd($e->getMessage());
       }
    }
    public function gmailIntregation(Request $request)
    {


        if($request->mode )
        {
            $this->setEnv('MAIL_MAILER',$request->value['MAIL_MAILER']);
            $this->setEnv('MAIL_HOST',$request->value['MAIL_HOST']);
            $this->setEnv('MAIL_PORT',$request->value['MAIL_PORT']);
            $this->setEnv('MAIL_USERNAME',$request->value['MAIL_USERNAME']);
            $this->setEnv('MAIL_PASSWORD',$request->value['MAIL_PASSWORD']);
            $this->setEnv('MAIL_ENCRYPTION',$request->value['MAIL_ENCRYPTION']);
        }
        else
        {
            return redirect()->back()->with('error','Mode required');
        }
       try{
           if(ApiIntegration::where('title','gmail')->exists())
           {
            $paypal = ApiIntegration::where('title','gmail')->first();
            $paypal->update([
                'title'=>'gmail',
                'mode'=>$request->mode,
                'status'=>$request->status,
                'values'=>json_encode($request->value)
            ]);
            return redirect()->back()->with('status','Successfully Updated');
           }

           else
           {
            ApiIntegration::create([
                'title'=>'gmail',
                'mode'=>$request->mode,
                'status'=>$request->status,
                'values'=>json_encode($request->value)
            ]);
           }

        return redirect()->back()->with('status','Successfully added');
       }
       catch(Exception $e)
       {
            dd($e->getMessage());
       }
    }
    private function setEnv($key, $value)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . \config('example.'.$key),
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }
    public function checkoutIntregationEsewa(Request $request)
    {

        if($request->mode )
        {
            $this->setEnv('MERCHANT_ID',$request->value['merchant_id']);
            $this->setEnv('MERCHANT_PASSWORD',$request->value['merchant_password']);
        }
        else
        {
            return redirect()->back()->with('error','Mode required');
        }
       try{
           if(ApiIntegration::where('title','esewa')->exists())
           {
            $paypal = ApiIntegration::where('title','esewa')->first();
            $paypal->update([
                'title'=>'esewa',
                'mode'=>$request->mode,
                'status'=>$request->status,
                'values'=>json_encode($request->value)
            ]);
            return redirect()->back()->with('status','Successfully Updated');
           }

           else
           {
            ApiIntegration::create([
                'title'=>'esewa',
                'mode'=>$request->mode,
                'status'=>$request->status,
                'values'=>json_encode($request->value)
            ]);
           }

        return redirect()->back()->with('status','Successfully added');
       }
       catch(Exception $e)
       {
            dd($e->getMessage());
       }
    }
}
