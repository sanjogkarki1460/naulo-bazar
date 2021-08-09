<?php

namespace App\Http\Controllers\Api;

use Auth;
use Cookie;
use App\User;
use App\Addon;
use App\Order;
use App\Category;
use App\Customer;
use App\AffiliateUser;
use App\Models\Product;
use App\AffiliateConfig;
use App\AffiliateOption;
use App\BusinessSetting;
use App\AffiliatePayment;
use Illuminate\Http\Request;
use App\AffiliateEarningDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Session\Session;

class AffiliateController extends Controller
{

    public function index()
    {
        $verification_form = AffiliateConfig::where('type', 'verification_form')->first()->value;
        
        return response()->json(json_decode($verification_form));
    }	
    public function affiliate_option_store(Request $request)
    {
        //dd($request->all());
        $affiliate_option = AffiliateOption::where('type', $request->type)->first();
        if ($affiliate_option == null) {
            $affiliate_option = new AffiliateOption;
        }
        $affiliate_option->type = $request->type;

        $commision_details = array();
        if ($request->type == 'user_registration_first_purchase') {
            $affiliate_option->percentage = $request->percentage;
        } elseif ($request->type == 'product_sharing') {
            $commision_details['commission'] = $request->amount;
            $commision_details['commission_type'] = $request->amount_type;
        } elseif ($request->type == 'category_wise_affiliate') {
            foreach (Category::all() as $category) {
                $data['category_id'] = $request['categories_id_' . $category->id];
                $data['commission'] = $request['commison_amounts_' . $category->id];
                $data['commission_type'] = $request['commison_types_' . $category->id];
                array_push($commision_details, $data);
            }
        } elseif ($request->type == 'max_affiliate_limit') {
            $affiliate_option->percentage = $request->percentage;
        }
        $affiliate_option->details = json_encode($commision_details);
        if ($request->has('status')) {
            $affiliate_option->status = 1;
        } else {
            $affiliate_option->status = 0;
        }
        $affiliate_option->save();
        return json_encode('updated successfully!');
    }



    public function config_store(Request $request)
    {
        $form = array();
        $select_types = ['select', 'multi_select', 'radio'];
        $j = 0;
        for ($i = 0; $i < count($request->type); $i++) {
            $item['type'] = $request->type[$i];
            $item['param'] = 'element_' . $i;
            $item['label'] = $request->label[$i];
            if (in_array($request->type[$i], $select_types)) {
                $item['options'] = json_encode($request['options_' . $request->option[$j]]);
                $j++;
            }
            array_push($form, $item);
        }
        $affiliate_config = AffiliateConfig::where('type', 'verification_form')->first();
        $affiliate_config->value = json_encode($form);
        if ($affiliate_config->save()) {
            flash("Verification form updated successfully")->success();
            return back();
        }
    }


    public function store_affiliate_user(Request $request)
    {
        try{
        if (!Auth::check()) {
            if (User::where('email', $request->email)->first() != null) {
                return response()->json(['error','email already exists']);
            }
            if ($request->password == $request->password_confirmation) {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->user_type = "customer";
                $user->password = Hash::make($request->password);
                $user->save();

                $customer = new Customer;
                $customer->user_id = $user->id;
                $customer->save();

                auth()->login($user, false);
            } else {
                return back()->with('error','Sorry!Password did not match.');
            }
        }

        $affiliate_user = Auth::user()->affiliate_user;
        if ($affiliate_user == null) {
            $affiliate_user = new AffiliateUser;
            $affiliate_user->user_id = Auth::user()->id;
        }
        $data = array();
        $i = 0;
        foreach (json_decode(AffiliateConfig::where('type', 'verification_form')->first()->value) as $key => $element) {
            $item = array();
            if ($element->type == 'text') {
                $item['type'] = 'text';
                $item['label'] = $element->label;
                $item['value'] = $request['element_' . $i];
            } elseif ($element->type == 'select' || $element->type == 'radio') {
                $item['type'] = 'select';
                $item['label'] = $element->label;
                $item['value'] = $request['element_' . $i];
            } elseif ($element->type == 'multi_select') {
                $item['type'] = 'multi_select';
                $item['label'] = $element->label;
                $item['value'] = json_encode($request['element_' . $i]);
            } elseif ($element->type == 'file') {
                $item['type'] = 'file';
                $item['label'] = $element->label;
                $item['value'] = $request['element_' . $i]->store('uploads/affiliate_verification_form');
            }
            array_push($data, $item);
            $i++;
        }
        $affiliate_user->informations = json_encode($data);
        if ($affiliate_user->save()) {
           
            return json_encode('message','Your verification request has been submitted successfully!');
        }
 

     
        return back()->with('error','Sorry Something Went Wrong.');
    }catch(\Exception $e){
        $e->getMessage();
    }
    }


    public function updateApproved(Request $request)
    {
        $affiliate_user = AffiliateUser::findOrFail($request->id);
        $affiliate_user->status = $request->status;
        if ($affiliate_user->save()) {
            return 1;
        }
        return 0;
    }

    public function payment_modal(Request $request)
    {
        $affiliate_user = AffiliateUser::findOrFail($request->id);
        return view('affiliate.payment_modal', compact('affiliate_user'));
    }

    public function payment_store(Request $request)
    {
        $affiliate_payment = new AffiliatePayment;
        $affiliate_payment->affiliate_user_id = $request->affiliate_user_id;
        $affiliate_payment->amount = $request->amount;
        $affiliate_payment->payment_method = $request->payment_method;
        $affiliate_payment->save();

        $affiliate_user = AffiliateUser::findOrFail($request->affiliate_user_id);
        $affiliate_user->balance -= $request->amount;
        $affiliate_user->save();

        flash(__('Payment completed'))->success();
        return json_encode('message','Payment Completed');
    }

    public function payment_history($id)
    {
        $affiliate_user = AffiliateUser::findOrFail(decrypt($id));
        $affiliate_payments = $affiliate_user->affiliate_payments();
        return view('affiliate.payment_history', compact('affiliate_payments', 'affiliate_user'));
    }

    public function user_index()
    {
        $affiliate_user = Auth::user()->affiliate_user;
        $affiliate_payments = $affiliate_user->affiliate_payments();
        return json_encode($affiliate_payments);
    }

    public function payment_settings()
    {
        $affiliate_user = Auth::user()->affiliate_user;
        return view('affiliate.frontend.payment_settings', compact('affiliate_user'));
    }

    public function payment_settings_store(Request $request)
    {
        $affiliate_user = Auth::user()->affiliate_user;
        $affiliate_user->paypal_email = $request->paypal_email;
        $affiliate_user->bank_information = $request->bank_information;
        $affiliate_user->save();
        return json_encode('message','Affiliate payment settings has been updated successfully');
	}
    public function processAffiliatePoints(Order $order)
    {
        if (Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
            if (AffiliateOption::where('type', 'user_registration_first_purchase')->first()->status) {
                if ($order->user != null && $order->user->orders->count() == 1) {
                    if ($order->user->referred_by != null) {
                        $user = User::find($order->user->referred_by);
                        if ($user != null) {
                            $amount = (AffiliateOption::where('type', 'user_registration_first_purchase')->first()->percentage * $order->grand_total) / 100;
                            $affiliate_user = $user->affiliate_user;
                            if ($affiliate_user != null) {
                                $affiliate_user->balance += $amount;
                                $affiliate_user->save();
                            }
                        }
                    }
                }
            }
            if (AffiliateOption::where('type', 'product_sharing')->first()->status) {
                foreach ($order->orderDetails as $key => $orderDetail) {
                    $amount = 0;
                    if ($orderDetail->product_referral_code != null) {
                        $referred_by_user = User::where('referral_code', $orderDetail->product_referral_code)->first();
                        if ($referred_by_user != null) {
                            if (AffiliateOption::where('type', 'product_sharing')->first()->details != null && json_decode(AffiliateOption::where('type', 'product_sharing')->first()->details)->commission_type == 'amount') {
                                $amount = json_decode(AffiliateOption::where('type', 'product_sharing')->first()->details)->commission;
                            } elseif (AffiliateOption::where('type', 'product_sharing')->first()->details != null && json_decode(AffiliateOption::where('type', 'product_sharing')->first()->details)->commission_type == 'percent') {
                                $amount = (json_decode(AffiliateOption::where('type', 'product_sharing')->first()->details)->commission * $orderDetail->price) / 100;
                            }
                            $affiliate_user = $referred_by_user->affiliate_user;
                            if ($affiliate_user != null) {
                                $affiliate_user->balance += $amount;
                                $affiliate_user->save();
                            }
                        }
                    }
                }
            } elseif (AffiliateOption::where('type', 'category_wise_affiliate')->first()->status) {
                foreach ($order->orderDetails as $key => $orderDetail) {
                    $amount = 0;
                    if ($orderDetail->product_referral_code != null) {
                        $referred_by_user = User::where('referral_code', $orderDetail->product_referral_code)->first();
                        if ($referred_by_user != null) {
                            if (AffiliateOption::where('type', 'category_wise_affiliate')->first()->details != null) {
                                foreach (json_decode(AffiliateOption::where('type', 'category_wise_affiliate')->first()->details) as $key => $value) {
                                    if ($value->category_id == $orderDetail->product->category->id) {
                                        if ($value->commission_type == 'amount') {
                                            $amount = $value->commission;
                                        } else {
                                            $amount = ($value->commission * $orderDetail->price) / 100;
                                        }
                                    }
                                }
                            }
                            $affiliate_user = $referred_by_user->affiliate_user;
                            if ($affiliate_user != null) {
                                $affiliate_user->balance += $amount;
                                $affiliate_user->save();
                            }
                        }
                    }
                }
            }
        }
    }
}