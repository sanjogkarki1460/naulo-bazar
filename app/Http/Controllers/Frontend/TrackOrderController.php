<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Order;
use Illuminate\Http\Request;

class TrackOrderController extends FrontendController
{
    //
    public function index()
    {
        return view($this->_mainpages.'track-order.index');
    }

    public function orderStatus(Request $request)
    {
        $order = Order::find($request->order_id);
        if($order)
        {
            $status = $order->order_status($order->order_status_id)->title;
            return view($this->_mainpages.'track-order.index',compact('status'));
        }
        else
        {
            return redirect()->back()->with('error','Order Code Not found');
        }
    }

    public function orderCancel($id)
    {
        $order = Order::with('order_product')->findOrFail($id);
        $order_status = $order->order_status($order->order_status_id)->title;
        if($order_status == 'on the way' || $order_status == 'delivered')
        {
            return redirect()->back()->with('error','Order Cancel Unsuccessfull');
        }
        elseif($order_status == 'cancelled')
        {
            return redirect()->back()->with('error','Order is already Cancelled');
        }
        $order->update([
            'order_status_id' => 5
        ]);

        return redirect()->back()->with('status','Order Successfully Cancelled');

    } 
    
    public function orderRefund($id)
    {
        $order = Order::findOrFail($id);
        $order_status = $order->order_status($order->order_status_id)->title;
        if($order_status == 'on the way')
        {
            return redirect()->back()->with('error','Order Refund Unsuccessfull');
                
        }
        elseif($order_status == 'cancelled')
        {
            return redirect()->back()->with('error','Order is already Cancelled');
        }
        $order->update([
            'order_status_id' => 5
        ]);

        return redirect()->back()->with('status','Order Successfully Cancelled');
        return redirect()->back()->with('status','Successfully Requested for the Order Refund');
    }
}
