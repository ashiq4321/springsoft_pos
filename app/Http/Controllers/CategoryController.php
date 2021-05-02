<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;
use Image;

class CategoryController extends Controller
{
    public function index()
    {
    	$get_categories = Category::orderBy('id','asc')->paginate(10);
    	return view('admin.category.index',compact('get_categories'));
    }

    public function categorypost(Request $request)
    {
    	$request->validate([
    		'category_name' => 'required|unique:categories',
            'category_image' => 'required',
    		'status' => 'required',
    	],[
    		'category_name.required' => 'Category Must Be Unique',
    	]);
    	$add_image_id = Category::insertGetId([
    		'category_name' => $request->category_name,
    		'status' => $request->status,
    		'created_at' => Carbon::now(),
    	]);
        $uploaded_item_photo = $request->file('category_image');
        $new_item_photo_name = $add_image_id.'.'.$uploaded_item_photo->extension();
        $new_item_photo_location = base_path('public/uploads/category/'.$new_item_photo_name);
        Image::make($uploaded_item_photo)->resize(243,134)->save($new_item_photo_location);

        Category::find($add_image_id)->update([
          'category_image' => $new_item_photo_name,
        ]);
    	return back()->with('category_success','Category Add Successfully');
    }

    public function active_category($category_id)
    {
    	$category = Category::find($category_id);
        
        if ($category->status == 0) {
            Category::find($category_id)->update([
                'status' => 1,
            ]);
        } else {
            Category::find($category_id)->update([
                'status' => 0,
            ]);
        }
        
        return back();
	}
	public function edit_category($category_id)
	{
		$get_category = Category::find($category_id);
		return view('admin.category.edit',compact('get_category'));
	}
	public function edit_categorypost(Request $request)
	{
		$request->validate([
			'category_name' => 'required',
			'status' => 'required',
		],[
			'category_name.required' => 'Category Required',
		]);
		// Category::find($request->id)->update([
		// 	'category_name' => $request->category_name,
		// 	'status' => $request->status,
		// 	'created_at' => Carbon::now(),
		// ]);
        $get_image = Category::find($request->id);
        $request->all();
        if ($request->hasFile('category_image')) {
          if ($get_image->category_image != 'photo.jpg') {
            $delete_location = base_path('public/uploads/category/'.$get_image->category_image);
            unlink($delete_location);
          }
        $uploaded_item_photo = $request->file('category_image');
        $new_item_photo_name = $get_image->id.'.'.$uploaded_item_photo->extension();
        $new_item_photo_location = base_path('public/uploads/applogo/'.$new_item_photo_name);
        Image::make($uploaded_item_photo)->resize(243,134)->save($new_item_photo_location);
        $get_image->category_image = $new_item_photo_name;
        }
        $get_image->category_name = $request->category_name;
        $get_image->status = $request->status;
        $get_image->created_at = Carbon::now();
        $get_image->save();
		return back()->with('success','Category Update Successfully');
	}
	public function delete_category($category_id)
	{
		Category::find($category_id)->delete();
		return back()->with('delete','Category Delete Successfully');
	}
}
