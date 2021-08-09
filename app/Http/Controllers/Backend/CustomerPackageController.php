<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\CustomerPackage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomerPackageController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer_packages = CustomerPackage::all();
        return view($this->_mainpages . 'customer_packages.index', compact('customer_packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->_mainpages . 'customer_packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer_package = new CustomerPackage;
        $customer_package->name = $request->name;
        $customer_package->amount = $request->amount;
        $customer_package->product_upload = $request->product_upload;
        if ($request->hasFile('logo')) {
            $customer_package->logo = $request->file('logo')->store('uploads/customer_package');
        }

        if ($customer_package->save()) {
            return redirect()->route('customer_packages.index')->with('status', 'Package has been inserted successfully!');
        } else {
            return back()->with('error', 'Something Went Wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer_package = CustomerPackage::findOrFail(decrypt($id));
        return view($this->_mainpages . 'customer_packages.edit', compact('customer_package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer_package = CustomerPackage::findOrFail($id);
        $customer_package->name = $request->name;
        $customer_package->amount = $request->amount;
        $customer_package->product_upload = $request->product_upload;
        if ($request->hasFile('logo')) {
            $customer_package->logo = $request->file('logo')->store('uploads/customer_package');
        }

        if ($customer_package->save()) {
            return redirect()->route('customer_packages.index')->with('status', 'Package has been updated successfully');
        } else {
            return back()->with('error', 'Something Went Wrong !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer_package = CustomerPackage::findOrFail($id);
        if (CustomerPackage::destroy($id)) {
            if ($customer_package->logo != null) {
                //unlink($customer_package->logo);
            }
            return redirect()->route('customer_packages.index')->with('status', 'Package has been deleted successfully!');
        } else {

            return back()->with('error', 'Something Went Wrong !');
        }
    }

    public function purchase_package(Request $request)
    {
        $data['customer_package_id'] = $request->customer_package_id;
        $data['payment_method'] = $request->payment_option;

        $request->session()->put('payment_type', 'customer_package_payment');
        $request->session()->put('payment_data', $data);

        $customer_package = CustomerPackage::findOrFail(Session::get('payment_data')['customer_package_id']);

        if ($customer_package->amount == 0) {
            $user = User::findOrFail(Auth::user()->id);
            if ($user->customer_package_id != $customer_package->id) {
                return $this->purchase_payment_done(Session::get('payment_data'), null);
            } else {
                return back()->with('error', 'You can not purchase this package anymore');
            }
        }

        if ($request->payment_option == 'paypal') {
            $paypal = new PaypalController;
            return $paypal->getCheckout();
        } elseif ($request->payment_option == 'stripe') {
            $stripe = new StripePaymentController;
            return $stripe->stripe();
        } elseif ($request->payment_option == 'sslcommerz_payment') {
            $sslcommerz = new PublicSslCommerzPaymentController;
            return $sslcommerz->index($request);
        } elseif ($request->payment_option == 'instamojo') {
            $instamojo = new InstamojoController;
            return $instamojo->pay($request);
        } elseif ($request->payment_option == 'razorpay') {
            $razorpay = new RazorpayController;
            return $razorpay->payWithRazorpay($request);
        } elseif ($request->payment_option == 'paystack') {
            $paystack = new PaystackController;
            return $paystack->redirectToGateway($request);
        } else {
            return back()->with('status', 'Feature Coming Soon, Sty Tuned !');
        }
    }

    public function purchase_payment_done($payment_data, $payment)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->customer_package_id = $payment_data['customer_package_id'];
        $customer_package = CustomerPackage::findOrFail($payment_data['customer_package_id']);
        $user->remaining_uploads += $customer_package->product_upload;
        $user->save();

        return redirect()->route('dashboard')->with('status', 'Package Purchased Successfully !');
    }
}
