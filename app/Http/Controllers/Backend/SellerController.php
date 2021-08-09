<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Seller;
use App\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SellerController extends BackendController
{
    public function index(Request $request)
    {
        $sort_search = null;
        $approved = null;
        $sellers = Seller::orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $sort_search = $request->search;
            $user_ids = User::where('user_type', 'vendor')->where(function ($user) use ($sort_search) {
                $user->where('name', 'like', '%' . $sort_search . '%')->orWhere('email', 'like', '%' . $sort_search . '%');
            })->pluck('id')->toArray();
			dd($user_ids);
            $sellers = $sellers->where(function ($seller) use ($user_ids) {
                $seller->whereIn('user_id', $user_ids);
            });
        }
        if ($request->approved_status != null) {
            $approved = $request->approved_status;
            $sellers = $sellers->where('verification_status', $approved);
        }
        $sellers = $sellers->paginate(15);


        return view($this->_mainpages . 'sellers.index', compact('sellers', 'sort_search', 'approved'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->_mainpages . 'sellers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (User::where('email', $request->email)->first() != null) {
            return back()->with('error', $request->email . 'already exists !');
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = "vendor";
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            $user->attachRole($user->user_type);
            $seller = new Seller;
            $seller->user_id = $user->id;
            if ($seller->save()) {
                $shop = new Shop;
                $shop->user_id = $user->id;
                $shop->slug = 'demo-shop-' . $user->id;
                $shop->save();
                return redirect()->route('sellers.index')->with('status', 'Seller has been inserted successfully !');
            }
        }

        return back()->with('error', 'Something Went Wrong !');
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
        $seller = Seller::findOrFail(decrypt($id));
        return view($this->_mainpages . 'sellers.edit', compact('seller'));
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
        $seller = Seller::findOrFail($id);
        $user = $seller->user;
        $user->name = $request->name;
        $user->email = $request->email;
        if (strlen($request->password) > 0) {
            $user->password = Hash::make($request->password);
        }
        if ($user->save()) {
            if ($seller->save()) {
                return redirect()->route('sellers.index')->with('status', 'Seller has been updated successfully !');
            }
        }

        return back()->with('error', 'Something Went Wrong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seller = Seller::findOrFail($id);
        Shop::where('user_id', $seller->user->id)->delete();
        Product::where('user_id', $seller->user->id)->delete();
        Order::where('user_id', $seller->user->id)->delete();
        OrderDetail::where('seller_id', $seller->user->id)->delete();
        User::destroy($seller->user->id);
        if (Seller::destroy($id)) {
            return redirect()->route('sellers.index')->with('status', 'Seller has been deleted successfully !');
        } else {
            return back()->with('error', 'Something went wrong !');
        }
    }

    public function show_verification_request($id)
    {
        $seller = Seller::findOrFail($id);
        return view($this->_mainpages . 'sellers.verification', compact('seller'));
    }

    public function approve_seller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->verification_status = 1;
        if ($seller->save()) {
            return redirect()->route('sellers.index')->with('status', 'Seller has been approved successfully !');
        }
        return back()->with('error', 'Something went wrong');
    }

    public function reject_seller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->verification_status = 0;
        $seller->verification_info = null;
        if ($seller->save()) {
            return redirect()->route('sellers.index')->with('status', 'Seller verification request has been rejected successfully !');
        }

        return back()->with('error', 'Something went wrong !');
    }


    public function payment_modal(Request $request)
    {
        $seller = Seller::findOrFail($request->id);
        return view($this->_mainpages . 'sellers.payment_modal', compact('seller'));
    }

    public function profile_modal(Request $request)
    {
        $seller = Seller::findOrFail($request->id);
        return view($this->_mainpages . 'sellers.profile_modal', compact('seller'));
    }

    public function updateApproved(Request $request)
    {
        $seller = Seller::findOrFail($request->id);
        $seller->verification_status = $request->status;
        if ($seller->save()) {
            return 1;
        }
        return 0;
    }
}
