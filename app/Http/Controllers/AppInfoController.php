<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppInfo;
use Image;
use Carbon\Carbon;

class AppInfoController extends Controller
{
    public function index()
    {
        $getapps = AppInfo::orderBy('id','asc')->paginate(10);
    	return view('admin.app.index',compact('getapps'));
    }
    public function appinfopost(Request $request)
    {
    	$request->validate([
    		'app_name' => 'required',
    		'status' => 'required',
    		'app_logo' => 'required',
    	]);
        $add_logo_id = AppInfo::insertGetId([
            'app_name' => $request->app_name,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);
        $uploaded_item_photo = $request->file('app_logo');
        $new_item_photo_name = $add_logo_id.'.'.$uploaded_item_photo->extension();
        $new_item_photo_location = base_path('public/uploads/applogo/'.$new_item_photo_name);
        Image::make($uploaded_item_photo)->resize(243,134)->save($new_item_photo_location);

        AppInfo::find($add_logo_id)->update([
          'app_logo' => $new_item_photo_name,
        ]);
        return back()->with('logo_success','App Info Add Successfully');
    }
    public function active_app($app_id)
    {
        $app = AppInfo::find($app_id);
        
        if ($app->status == 0) {
            AppInfo::find($app_id)->update([
                'status' => 1,
            ]);
        } else {
            AppInfo::find($app_id)->update([
                'status' => 0,
            ]);
        }
        
        return back();
    }
    public function edit_app($app_id)
    {
        $get_app = AppInfo::find($app_id);
        return view('admin.app.edit',compact('get_app'));
    }
    public function editinfopost(Request $request)
    {
        $request->validate([
            'app_name' => 'required',
            'status' => 'required',
        ]);
        $get_image = AppInfo::find($request->id);
        $request->all();
        if ($request->hasFile('app_logo')) {
          if ($get_image->app_logo != 'photo.jpg') {
            $delete_location = base_path('public/uploads/applogo/'.$get_image->app_logo);
            unlink($delete_location);
          }
        $uploaded_item_photo = $request->file('app_logo');
        $new_item_photo_name = $get_image->id.'.'.$uploaded_item_photo->extension();
        $new_item_photo_location = base_path('public/uploads/applogo/'.$new_item_photo_name);
        Image::make($uploaded_item_photo)->resize(243,134)->save($new_item_photo_location);
        $get_image->app_logo = $new_item_photo_name;
        }
        $get_image->app_name = $request->app_name;
        $get_image->status = $request->status;
        $get_image->save();
        return back()->with('edit_success','AppInfo Edit Successfully');
    }
    public function delete_app($app_id)
    {
        AppInfo::find($app_id)->delete();
        return back()->with('delete','AppInfo Delete Successfully');
    }
}
