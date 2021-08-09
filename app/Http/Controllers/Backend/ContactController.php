<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Contact;
use Illuminate\Http\Request;

class ContactController extends BackendController
{
    //
    public function index()
    {
        $contacts = Contact::get();
        return view($this->_mainpages . 'contact.list', compact('contacts'));
    }

    public function delete($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->back()->with('status', 'Successfully Deleted');
    }
}
