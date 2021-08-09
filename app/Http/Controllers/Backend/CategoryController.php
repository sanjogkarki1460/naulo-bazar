<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Admin;
use App\Category;
use App\HomeCategory;
use App\Product;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\RequestCategory;
use App\Notifications\CategoryRequest;
use App\User;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;

class CategoryController extends BackendController
{
    public function index(Request $request)
    {
        $sort_search = null;
        $categories = Category::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $categories = $categories->where('name', 'like', '%' . $sort_search . '%');
        }
        $categories = $categories->paginate(15);
        return view($this->_mainpages . 'categories.index', compact('categories', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->_mainpages . 'categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        if ($request->slug != null) {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        } else {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)) . '-' . Str::random(5);
        }
        if ($request->commision_rate != null) {
            $category->commision_rate = $request->commision_rate;
        }

        $data = openJSONFile('en');
        $data[$category->name] = $category->name;
        saveJSONFile('en', $data);

        if ($request->hasFile('banner')) {
            $orginalImage = $request->file('banner');
            $img = Image::make($orginalImage);
            $thumbnailPath = public_path().'/uploads/categories/banner/thumbnail/';
            $orginalPath = public_path().'/uploads/categories/banner/orginal/';
            if(!file_exists($thumbnailPath))
            {
                File::makeDirectory($thumbnailPath,0777);
               
            }
            if(!file_exists($orginalPath))
            {
                File::makeDirectory($orginalPath,0777);
            }
            $img->save($orginalPath.time().$orginalImage->getClientOriginalName());
            $img->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save($thumbnailPath.time().$orginalImage->getClientOriginalName()); 
            $category->banner = 'uploads/categories/banner/thumbnail/'.time().$orginalImage->getClientOriginalName();
            //$category->banner = $request->file('banner')->store('uploads/categories/banner');
        }
        if ($request->hasFile('icon')) {
           
            $orginalImage = $request->file('icon');
            $img = Image::make($orginalImage);
            $thumbnailPath = public_path().'/uploads/categories/icon/thumbnail/';
            $orginalPath = public_path().'/uploads/categories/icon/orginal/';
            if(!file_exists($thumbnailPath))
            {
                File::makeDirectory($thumbnailPath,0777);
            }
            if(!file_exists($orginalPath))
            {
                File::makeDirectory($orginalPath,0777);
            }
            $img->save($orginalPath.time().$orginalImage->getClientOriginalName());
            $img->resize(50,50);
            $img->save($thumbnailPath.time().$orginalImage->getClientOriginalName()); 
            $category->icon = 'uploads/categories/icon/thumbnail/'.time().$orginalImage->getClientOriginalName();
            //$category->icon = $request->file('icon')->store('uploads/categories/icon');
        }

        $category->digital = $request->digital;
        if ($category->save()) {
            return redirect()->route('categories.index')->with('status', 'Category added successfully!');
        } else {
            return back()->with(
                'error', 'Something went wrong'
            );
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
        $category = Category::findOrFail(decrypt($id));
        return view($this->_mainpages . 'categories.edit', compact('category'));
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
        $category = Category::findOrFail($id);


        $category->name = $request->name;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        if ($request->slug != null) {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        } else {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)) . '-' . str_random(5);
        }

        if ($request->hasFile('banner')) {
            $category->banner = $request->file('banner')->store('uploads/categories/banner');
        }
        if ($request->hasFile('icon')) {
            $category->icon = $request->file('icon')->store('uploads/categories/icon');
        }
        if ($request->commision_rate != null) {
            $category->commision_rate = $request->commision_rate;
        }

        $category->digital = $request->digital;
        if ($category->save()) {

            return redirect()->route('categories.index')->with('status', 'Category added successfully');
        } else {

            return back()->with('error', 'Something went wrong');
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
        $category = Category::findOrFail($id);
        foreach ($category->subcategories as $key => $subcategory) {
            foreach ($subcategory->subsubcategories as $key => $subsubcategory) {
                $subsubcategory->delete();
            }
            $subcategory->delete();
        }

        Product::where('category_id', $category->id)->delete();
        HomeCategory::where('category_id', $category->id)->delete();

        if (Category::destroy($id)) {


            if ($category->banner != null) {
                //($category->banner);
            }
            if ($category->icon != null) {
                //unlink($category->icon);
            }

            return redirect()->route('categories.index')->with('status', 'Category deleted successfully');
        } else {

            return back()->with('error', 'Something Went Wrong');
        }
    }

    public function updateFeatured(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->featured = $request->status;
        if ($category->save()) {
            return 1;
        }
        return 0;
    }


}

