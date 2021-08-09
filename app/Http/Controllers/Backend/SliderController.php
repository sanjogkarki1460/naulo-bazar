<?php

namespace App\Http\Controllers\Backend;

use App\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\BackendController;

class SliderController extends BackendController
{
    public function index()
    {
        $sliders = Slider::all();
        return view($this->_mainpages.'home_settings.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->_mainpages . 'sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('photos')) {
            foreach ($request->photos as $key => $photo) {
                $slider = new Slider;
                $imagename = time().'.'.$photo->extension();
                $slider->link = $request->url;
              
                 $destination_path = public_path('uploads/sliders');
  
            if (!file_exists($destination_path))
            {
                mkdir($destination_path, 0777, true);
            }
       
            $thumb = Image::make($photo)->resize(1200, 400,function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($destination_path.'/thumb_'.$imagename);
            
            $slider->photo = 'uploads/sliders/'.$thumb->basename;
                $slider->save();
            }
        }
        return redirect()->route('home_settings.index')->with('status', 'Slider Added Successfully !');
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
        //
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
        $slider = Slider::find($id);
        $slider->published = $request->status;
        if ($slider->save()) {
            return '1';
        } else {
            return '0';
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
        $slider = Slider::findOrFail($id);
        if (Slider::destroy($id)) {
            //unlink($slider->photo);
            redirect()->back()->with('status', 'Slider Deleted Successfully!');
        } else {

            redirect()->back()->with('error', 'Something Went Wrong !');
        }
        return redirect()->route('home_settings.index');
    }
}
