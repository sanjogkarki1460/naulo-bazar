<?php

namespace App\Http\Controllers\Backend;

use App\Banner;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BackendController;

class BannerController extends BackendController
{

  
    public function index()
    {
        $banners = Banner::all();
        return view($this->_mainpages.'home_settings.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($position)
    {
        return view($this->_mainpages.'banners.create', compact('position'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        if($request->hasFile('photo')){
            $banner = new Banner;
            $image = $request->file('photo');
            $destination_path = public_path('uploads/banners');
    $imagename = time().'.'.$image->extension();

            if (!file_exists($destination_path))
            {
                mkdir($destination_path, 0777, true);
            }
       
            $thumb = Image::make($image)->resize(848, 150,function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($destination_path.'/thumb_'.$imagename);
          
            $banner->photo = 'uploads/banners/'.$thumb->basename;

            $banner->url = $request->url;
            $banner->position = $request->position;
            $banner->save();
            return redirect()->route('home_settings.index')->with('status','Banner Added Successfully!');
           
        }
        return redirect()->route('home_settings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view($this->_mainpages.'banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);
        $banner->photo = $request->previous_photo;
        if($request->hasFile('photo'))
        {
            $destination_path = public_path('uploads/banners');
            $image = $request->file('photo');
            $imagename = time().'.'.$image->extension();
        
                    if (!file_exists($destination_path))
                    {
                        mkdir($destination_path, 0777, true);
                    }
               
                    $thumb = Image::make($image)->resize(848, 150,function($constraint){
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($destination_path.'/thumb_'.$imagename);
                  
                    $banner->photo = 'uploads/banners/'.$thumb->basename;
        
            
        }
        $banner->url = $request->url;
        $banner->save();
      
        return redirect()->route('home_settings.index')->with('stauts','Banner has been updated successfully !');
    }


    public function update_status(Request $request)
    {
        $banner = Banner::find($request->id);
        $banner->published = $request->status;
        if($request->status == 1){
            if(count(Banner::where('published', 1)->where('position', $banner->position)->get()) < 4)
            {
                if($banner->save()){
                    return '1';
                }
                else {
                    return '0';
                }
            }
        }
        else{
            if($banner->save()){
                return '1';
            }
            else {
                return '0';
            }
        }

        return '0';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        if(Banner::destroy($id)){
			//
           // unlink($banner->photo);
            return redirect()->route('home_settings.index')->with('status','Banner has been deleted successfully!');
        }
        else{
            return redirect()->route('home_settings.index')->with('error','Something Went Wrong !');
        }
        return redirect()->route('home_settings.index');
    }

    
}
