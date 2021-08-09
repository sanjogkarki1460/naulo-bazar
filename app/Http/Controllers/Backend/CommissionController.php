<?php

namespace App\Http\Controllers\Backend;

use App\AdminCommission;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Category;
use App\Seller;
use Illuminate\Http\Request;

class CommissionController extends BackendController
{

    public function pay_to_seller(Request $request)
    {
        $data['seller_id'] = $request->seller_id;
        $data['amount'] = $request->amount;
        $data['payment_method'] = $request->payment_option;
        $data['payment_withdraw'] = $request->payment_withdraw;
        $data['withdraw_request_id'] = $request->withdraw_request_id;
        if ($request->txn_code != null) {
            $data['txn_code'] = $request->txn_code;
        } else {
            $data['txn_code'] = null;
        }
        $request->session()->put('payment_type', 'seller_payment');
        $request->session()->put('payment_data', $data);

        if ($request->payment_option == 'paypal') {
            $paypal = new PaypalController;
            return $paypal->getCheckout();
        } elseif ($request->payment_option == 'cash') {
            return $this->seller_payment_done($request->session()->get('payment_data'), null);
        } elseif ($request->payment_option == 'bank_payment') {
            return $this->seller_payment_done($request->session()->get('payment_data'), null);
        }
    }

    //redirects to this method after successfull seller payment
    public function seller_payment_done($payment_data, $payment_details)
    {
        $seller = Seller::findOrFail($payment_data['seller_id']);
        $seller->admin_to_pay = $seller->admin_to_pay - $payment_data['amount'];
        $seller->save();

        $payment = new Payment;
        $payment->seller_id = $seller->id;
        $payment->amount = $payment_data['amount'];
        $payment->payment_method = $payment_data['payment_method'];
        $payment->txn_code = $payment_data['txn_code'];
        $payment->payment_details = $payment_details;
        $payment->save();

        if ($payment_data['payment_withdraw'] == 'withdraw_request') {
            $seller_withdraw_request = SellerWithdrawRequest::findOrFail($payment_data['withdraw_request_id']);
            $seller_withdraw_request->status = '1';
            $seller_withdraw_request->viewed = '1';
            $seller_withdraw_request->save();
        }

        Session::forget('payment_data');
        Session::forget('payment_type');

        if ($payment_data['payment_withdraw'] == 'withdraw_request') {
            flash(__('Payment completed'))->success();
            return redirect()->route('withdraw_requests_all');
        } else {
            flash(__('Payment completed'))->success();
            return redirect()->route('sellers.index');
        }
    }
//    public function store(Request $request)
//    {
//
//        if (AdminCommission::where('category_id', '=', $request->category_id)->count() > 0) {
//            // user found
//            return redirect()->back()->with('error','Commission for Category Already Exist');
//         }
//         $request->validate([
//            'category_id'=>'required',
//            'admin_commisson'=>'required'
//
//        ]);
//        foreach($request->category_id as $category_id)
//        {
//            AdminCommission::create([
//                'category_id'=>$category_id,
//                'admin_commisson'=>$request->admin_commisson
//            ]);
//        }
//
//        return redirect()->back()->with('status','Admin Commission Inserted');
//    }
//
//    public function edit(Request $request,$id)
//    {
//        $update = Category::findOrFail($id)->adminCommission()->update([
//            'admin_commisson'=>$request->admin_commission
//        ]);
//        if(!$update)
//        {
//            AdminCommission::create([
//                'category_id'=>$id,
//                'admin_commisson'=>$request->admin_commission
//            ]);
//        }
//        return redirect()->back()->with('status','Admin Commission Updated');
//    }

}
