<?php

namespace App\Http\Controllers\Backend;

use App\FlashDealProduct;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\FlashDeal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FlashDealController extends BackendController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $flash_deals = FlashDeal::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $flash_deals = $flash_deals->where('title', 'like', '%' . $sort_search . '%');
        }
        $flash_deals = $flash_deals->paginate(15);
        return view($this->_mainpages . 'flash_deals.index', compact('flash_deals', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->_mainpages . 'flash_deals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $flash_deal = new FlashDeal;
        $flash_deal->title = $request->title;
        $flash_deal->text_color = $request->text_color;
        $flash_deal->start_date = strtotime($request->start_date);
        $flash_deal->end_date = strtotime($request->end_date);
        $flash_deal->background_color = $request->background_color;
        $flash_deal->slug = strtolower(str_replace(' ', '-', $request->title) . '-' . str_random(5));
        if ($request->hasFile('banner')) {
            $flash_deal->banner = $request->file('banner')->store('uploads/offers/banner');
        }
        if ($flash_deal->save()) {
            foreach ($request->products as $key => $product) {
                $flash_deal_product = new FlashDealProduct;
                $flash_deal_product->flash_deal_id = $flash_deal->id;
                $flash_deal_product->product_id = $product;
                $flash_deal_product->discount = $request['discount_' . $product];
                $flash_deal_product->discount_type = $request['discount_type_' . $product];
                $flash_deal_product->save();
            }
            return redirect()->route('flash_deals.index')->with('status', 'Flash Deal has been inserted successfully');
        } else {
            return back()->with('error', 'Something Went Wrong !!');
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
        $flash_deal = FlashDeal::findOrFail(decrypt($id));
        return view($this->_mainpages.'flash_deals.edit', compact('flash_deal'));
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
        $flash_deal = FlashDeal::findOrFail($id);
        $flash_deal->title = $request->title;
        $flash_deal->text_color = $request->text_color;
        $flash_deal->start_date = strtotime($request->start_date);
        $flash_deal->end_date = strtotime($request->end_date);
        $flash_deal->background_color = $request->background_color;
        if (($flash_deal->slug == null) || ($flash_deal->title != $request->title)) {
            $flash_deal->slug = strtolower(str_replace(' ', '-', $request->title) . '-' . str_random(5));
        }
        if ($request->hasFile('banner')) {
            $flash_deal->banner = $request->file('banner')->store('uploads/offers/banner');
        }
        foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product) {
            $flash_deal_product->delete();
        }
        if ($flash_deal->save()) {
            foreach ($request->products as $key => $product) {
                $flash_deal_product = new FlashDealProduct;
                $flash_deal_product->flash_deal_id = $flash_deal->id;
                $flash_deal_product->product_id = $product;
                $flash_deal_product->discount = $request['discount_' . $product];
                $flash_deal_product->discount_type = $request['discount_type_' . $product];
                $flash_deal_product->save();
            }
            return redirect()->route('flash_deals.index')->with('status', 'Flash Deal has been updated successfully');
        } else {
            return back()->with('error', 'Something Went Wrong !!');
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
        $flash_deal = FlashDeal::findOrFail($id);
        foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product) {
            $flash_deal_product->delete();
        }
        if (FlashDeal::destroy($id)) {
            return redirect()->route('flash_deals.index')->with('status', 'FlashDeal Has Been Deleted Succesfully !!');
        } else {
            return back() - with('error', 'Something Went Wrong !!');
        }
    }

    public function update_status(Request $request)
    {
        $flash_deal = FlashDeal::findOrFail($request->id);
        $flash_deal->status = $request->status;
        if ($flash_deal->save()) {
            return 1;
        }
        return 0;
    }

    public function update_featured(Request $request)
    {
        foreach (FlashDeal::all() as $key => $flash_deal) {
            $flash_deal->featured = 0;
            $flash_deal->save();
        }
        $flash_deal = FlashDeal::findOrFail($request->id);
        $flash_deal->featured = $request->featured;
        if ($flash_deal->save()) {
            return 1;
        }
        return 0;
    }

    public function product_discount(Request $request)
    {
        $product_ids = $request->product_ids;
        return view($this->_mainpages . 'partials.flash_deal_discount', compact('product_ids'));
    }

    public function product_discount_edit(Request $request)
    {
        $product_ids = $request->product_ids;
        $flash_deal_id = $request->flash_deal_id;
        return view('partials.flash_deal_discount_edit', compact('product_ids', 'flash_deal_id'));
    }


}
