<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends BackendController
{
    //
    public function index()
    {
            // $notifications = auth()->user()->notifications;

        return view($this->_mainpages.'notification.list');
    }
     public function delete($id)
    {
        auth()->user()->notifications()->where('id', $id)->delete();
        return redirect()->back()->with('status','Successfully Deleted');
    }
}
