<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Attribute;
use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use MehediIitdu\CoreComponentRepository\CoreComponentRepository;

class AttributeController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  CoreComponentRepository::instantiateShopRepository();
        $attributes = Attribute::all();
        return view($this->_mainpages.'attribute.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->_mainpages.'attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribute = new Attribute;
        $attribute->name = $request->name;
        if ($attribute->save()) {
            return redirect()->route('attributes.index')->with('status','Attribute has been inserted successfully');
        } else {
           
            return back()->with('error','Something went wrong');
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
        $attribute = Attribute::findOrFail(decrypt($id));
        return view($this->_mainpages.'attribute.edit', compact('attribute'));
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
        $attribute = Attribute::findOrFail($id);
        $attribute->name = $request->name;
        if ($attribute->save()) {
           
            return redirect()->route('attributes.index')->with('status','Attribute has been-updated successfully');
        } else {
          
            return back()->with('error','Something went wrong');
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
        $attribute = Attribute::findOrFail($id);
        if (Attribute::destroy($id)) {
          
            return redirect()->route('attributes.index')->with('status','Attribute has been deleted successfully');
        } else {
          
            return back()->with(
                'error','Something went wrong'
            );
        }
    }
}

