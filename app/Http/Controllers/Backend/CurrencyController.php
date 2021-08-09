<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Currency;
use Illuminate\Http\Request;

class CurrencyController extends BackendController
{

    public function changeCurrency(Request $request)
    {
        $request->session()->put('currency_code', $request->currency_code);
        $currency = Currency::where('code', $request->currency_code)->first();
        redirect()->back()->with('status', 'Currency changed to ' . $currency->name);
    }

    public function currency(Request $request)
    {
        $currencies = Currency::all();
        $active_currencies = Currency::where('status', 1)->get();
        return view($this->_mainpages . 'business_settings.currency', compact('currencies', 'active_currencies'));
    }

    // public function updateCurrency(Request $request)
    // {
    //     $currency = Currency::findOrFail($request->id);
    //     $currency->exchange_rate = $request->exchange_rate;
    //     $currency->status = $request->status;
    //     if($currency->save()){
    //         flash('Currency updated successfully')->success();
    //         return '1';
    //     }
    //     flash('Something went wrong')->error();
    //     return '0';
    // }

    public function updateYourCurrency(Request $request)
    {
        $currency = Currency::findOrFail($request->id);
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;
        $currency->code = $request->code;
        $currency->exchange_rate = $request->exchange_rate;
        $currency->status = $currency->status;
        if ($currency->save()) {

            return redirect()->route('currency.index')->with('status', 'Currency Updated Successfully !!');
        } else {

            return redirect()->route('currency.index')->with('error', 'Something Went Wrong!');
        }
    }

    public function create()
    {
        return view($this->_mainpages . 'partials.currency_create');
    }

    public function edit(Request $request)
    {
        $currency = Currency::findOrFail($request->id);
        return view($this->_mainpages . 'partials.currency_edit', compact('currency'));
    }

    public function store(Request $request)
    {
        $currency = new Currency;
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;
        $currency->code = $request->code;
        $currency->exchange_rate = $request->exchange_rate;
        $currency->status = '0';
        if ($currency->save()) {
            return redirect()->route('currency.index')->with('status', 'Currency Added Successfully!');
        } else {
            return redirect()->route('currency.index')->with('error', 'Something Went Wrong !');
        }
    }

    public function update_status(Request $request)
    {
        $currency = Currency::findOrFail($request->id);
        $currency->status = $request->status;
        if ($currency->save()) {
            return 1;
        }
        return 0;
    }
}
