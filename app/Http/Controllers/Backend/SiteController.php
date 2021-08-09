<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Setting;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteController extends BackendController
{
    public function index()
    {
        $generalsetting = Setting::first();
        return view($this->_mainpages . 'setting.setting')->with('setting', $generalsetting);
    }

    public function update(Request $request)
    {
        try {
            $generalsetting= Setting::first();
            if(!$generalsetting)
            {
                $generalsetting = new Setting();
            }
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $filename = time() . '.' . $logo->getClientOriginalExtension();
                $oldlogo = $generalsetting->logo;
                $validatedData = $request->validate([
                    'logo' => 'image|mimes:jpeg,png,jpg|max:1000',
                ]);

                Storage::putFileAs('public/setting/logo', new File($logo), $filename);

                $generalsetting->logo = $filename;

//                resize_crop_images(319, 65, $logo, "citizen/" . $filename);
                if ($oldlogo != null) {
                    //deleting exiting logo
                    Storage::delete('public/setting/logo/' . $oldlogo);
                    Storage::delete('public/setting/logo/thumb_' . $oldlogo);
                }
            }
            if ($request->hasFile('favicon')) {
                $logo = $request->file('favicon');
                $filename = time() . '.' . $logo->getClientOriginalExtension();
                $oldfavicon = $generalsetting->favicon;
                $validatedData = $request->validate([
                    'favicon' => 'image|mimes:jpeg,png,jpg|max:1000',
                ]);

                Storage::putFileAs('public/setting/favicon', new File($logo), $filename);

                $generalsetting->favicon = $filename;

//                resize_crop_images(200, 200, $logo, "public/setting/favicon/thumb_" . $filename);
                if ($oldfavicon != null) {
                    //deleting exiting favicon
                    Storage::delete('public/setting/favicon/' . $oldfavicon);
                    Storage::delete('public/setting/favicon/thumb_' . $oldfavicon);

                }
            }

            $generalsetting->site_name = $request->name;
            $generalsetting->address = $request->address;
            $generalsetting->phone = $request->phone;
            $generalsetting->email = $request->email;
            $generalsetting->description = $request->description;
            $generalsetting->facebook = $request->facebook;
            $generalsetting->instagram = $request->instagram;
            $generalsetting->twitter = $request->twitter;
            $generalsetting->youtube = $request->youtube;
            $generalsetting->google_plus = $request->google_plus;



        if($generalsetting->save()){
            $businessSettingsController = new BusinessSettingsController;
            $businessSettingsController->overWriteEnvFile('APP_NAME',$request->name);

            return redirect(route('sites.index'))->with('status', 'Setting Update Successfully.');
        }

     } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }

}
