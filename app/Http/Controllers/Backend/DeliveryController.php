<?php

namespace App\Http\Controllers\Backend;

use App\AdminCommission;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\DeliveryAddress;
use Illuminate\Http\Request;

class DeliveryController extends BackendController
{
    //

    public function index()
    {
        $id = 0;
        $deliveries = DeliveryAddress::orderByDesc('id')->get();
        return view($this->_mainpages . 'delivery.index', compact('id', 'deliveries'));
    }

    public function store(Request $request)
    {
        if ($request->charge < 1) {
            return redirect()->route('delivery.list')->with('error', 'Default is 1, cannot add 0');
        }
        $request->validate([
            'title' => 'unique:delivery_addresses',
            'charge' => 'required',

        ]);
        DeliveryAddress::create([
            'title' => $request->title,
            'charge' => $request->charge
        ]);
        return redirect()->back()->with('status', 'Delivery Address Inserted');
    }

    public function edit($id)
    {
        $delivery = DeliveryAddress::findOrFail($id);
        return view($this->_mainpages . 'delivery.index', compact('id', 'delivery'));

    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'unique:delivery_addresses,title,' . $id
        ]);
        $update = DeliveryAddress::where('id', $id)->update([
            'title' => $request->title,
            'charge' => $request->charge
        ]);
        if ($update) {
            return redirect()->route('delivery.list')->with('status', 'Updated Successfully');
        } else {
            return redirect()->route('delivery.list')->with('error', 'Something Went Wrong');
        }
    }

    public function delete($id)
    {
        DeliveryAddress::findOrFail($id)->delete();
        return redirect()->route('delivery.list')->with('status', 'Delete Successfully');
    }
}
