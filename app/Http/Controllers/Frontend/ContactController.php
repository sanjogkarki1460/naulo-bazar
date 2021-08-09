<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends FrontendController
{
    //
    public function contact()
    {
        return view($this->_mainpages.'contact.index');
    }

    public function create(Request $request)
    {
        $request->validate([    
            'name' =>'required',
            'email' => 'required',
            'message' => 'required'
        ]);
        $contact = Contact::create($request->except(['_token','_method']));
        if($contact)
        {
            return redirect()->back()->with('status','Successfully Send');
        }
        return redirect()->back()->with('error','Not Send');
    }
}
