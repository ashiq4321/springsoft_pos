<?php

namespace App\Http\Controllers;

use App\Category;
use DB;
//use App\Brand;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin/brand/productBrand', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $all_brand = DB::table('brands')
            ->join('categories', 'brands.category_id', '=', 'categories.id')
            ->select('brands.*', 'categories.category_name')
            ->get();


        //$all_asset = AssetType::latest()->first();
        //return $all_asset;
        //        $all_brand = \App\Brand::all();
        //echo $all_expense;
        //return $all_expense;
        return response()->json([
            'data' => $all_brand,
        ]);
    }

    public function addProductCategory(Request $request)
    {


        $edit_img = $request->file('image');
        $edit_photo_uname = md5(time() . rand()) . '.' . $edit_img->getClientOriginalExtension();
        $edit_img->move(public_path('uploads/product/category'), $edit_photo_uname);

        //$data = $edit_img;


        // $request->validate([
        //     'name' => 'required',
        //     'company_name' => 'required',
        //     'vat_number' => 'required',
        //     'phone' => 'required',
        //     'email' => 'required',
        //     'image' => 'required',
        //     'address' => 'required',
        //     'city' => 'required',
        //     'state' => 'required',
        //     'postal_code' => 'required',
        //     'country' => 'required',

        // ]);

        \App\Brand::create([


            'name' => $request->name,
            'category_id' => $request->category_id,
            'is_active' => $request->status,
            'image' => $edit_photo_uname
            //             'category_name' => $request->category_name,
            //            'status' => $request->status,
            //            'category_image' => $edit_photo_uname

        ]);

        return response()->json('success');
        // return $data;
    }




    public function editProductCategory($id)
    {
        $data = \App\Brand::find($id);
        return [
            'date'   => $data->date,
            'id' => $data->id,
            'category_name' => $data->name,
            'is_active' => $data->is_active,
            'category_image' => $data->image,
            'category_id' => $data->category_id,

        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteProductCategory($id)
    {
        $data = \App\Brand::find($id);
        $data->delete();
        return response()->json('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //    public function show($id)
    //    {
    //        //
    //    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProductCategory(Request $request, $id)
    {


        if ($request->hasFile('imageEdit')) {
            $edit_img = $request->file('imageEdit');
            $edit_photo_uname = md5(time() . rand()) . '.' . $edit_img->getClientOriginalExtension();
            $edit_img->move(public_path('uploads/product/category'), $edit_photo_uname);
        } else {
            $photo = \App\Brand::find($id)->first();
            $edit_photo_uname = $photo->image;
        }

        $edit_data = \App\Brand::find($id);
        $edit_data->name = $request->brand_nameEdit;
        $edit_data->is_active = $request->statusEdit;
        $edit_data->category_id = $request->category_id;
        $edit_data->image = $edit_photo_uname;


        $edit_data->update();
        return response()->json('Updated');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}