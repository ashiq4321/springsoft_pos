<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Expense;
use App\Brand;
use App\Users;
use App\User;
use Auth;
use App\Notifications\productAlert;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Notification;
use App\product_warehouse;

class ProductController extends Controller
{
    /**
     * Send quantity Alert
     *
     * @return \Illuminate\Http\Response
     */
    // public function quantityAlert_notification()
    // {

    //     $user = User::find(Auth::user()->id);
    //     $alert_quantity = product_warehouse::where('qty', '<', 10)->get();
    //     if ($alert_quantity) {
    //         Notification::send($user, new productAlert($user));
    //     }
    //     return response()->json($user);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_category = Category::all();
        $all_brand = Brand::all();


        return view('admin/product/product', compact('all_category', 'all_brand'));
    }
    //addProduct
    public function addProduct(Request $request)
    {
        $product_list = '';
        $product_qty = '';
        $unit_price = '';
        $file_uname = '';

        //return response()->json(['success' => $edit_photo_uname]);
        if ($request->hasFile('imageProduct')) {
            $img = $request->file('imageProduct');
            $photo_uname = md5(time() . rand()) . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('uploads/product/image'), $photo_uname);
        } else {
            $photo_uname = '';
        }

        if ($request->type == 'combo') {


            $product_list = implode(",", $request->product_id);

            // $product_list = json_encode($request->product_id);
            $product_qty = implode(",", $request->product_qty);
            $unit_price = implode(",", $request->unit_price);
        } elseif ($request->type == 'digital') {



            if ($request->hasFile('fileDigital')) {
                $file = $request->file('fileDigital');
                $file_uname = md5(time() . rand()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/product/file'), $file_uname);
            } else {
                $file_uname = '';
            }
        } else {
        }


        Product::create([
            'name' => $request->name,
            'type' => $request->type,
            'barcode_symbology' => $request->code,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'purchase_unit_id' => $request->purchase_unit_id,
            'sale_unit_id' => $request->sale_unit_id,
            'price' => $request->price,
            'cost' => $request->cost,
            //'qty' => $request->qty,
            'alert_quantity' => $request->alert_quantity,
            'promotion' => $request->promotion,
            'promotion_price' => $request->promotion_price,
            'starting_date' => $request->starting_date,
            'last_date' => $request->last_date,
            'tax_id' => $request->tax_id,
            'tax_method' => $request->tax_method,
            'image' => $photo_uname,
            'file' => $file_uname,
            'is_variant' => $request->is_variant,
            'featured' => $request->featured,
            'product_list' => $product_list,
            'qty_list' => $product_qty,
            'price_list' => $unit_price,
            'product_details' => $request->product_details,
            'is_active' => 1,




        ]);

        //return $request->all();
        // $all_product = Product::all();

        // return view('admin/product/productList', compact('all_product'));
    }

    public function editProduct($id)
    {
        $data = Product::find($id);
        $all_brand = Brand::all();

        //return json_decode($data->product_list);
        //return $data->product_list;
        $all_category = Category::all();

        if ($data->type == 'standard') {
            return view('admin/product/productStandardEdit', compact('all_category', 'data', 'all_brand'));
        }
        if ($data->type == 'combo') {

            $product_list = explode(",", $data->product_list);
            $product_qty = explode(",", $data->qty_list);
            $product_price = explode(",", $data->price_list);
            $count = count($product_list);

            $product_name = Product::find($product_list);

            //return $product_name;

            return view('admin/product/productComboEdit', compact('all_category', 'data', 'product_list', 'product_qty', 'product_price', 'product_name', 'all_brand', 'count'));
        }
    }
    //
    public function updateProductStandard(Request $request, $id)
    {
        $edit_data = Product::find($id);

        $product_list = '';
        $product_qty = '';
        $unit_price = '';
        $file_uname = '';

        //return response()->json(['success' => $edit_photo_uname]);
        if ($request->hasFile('imageProduct')) {
            $img = $request->file('imageProduct');
            $photo_uname = md5(time() . rand()) . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('uploads/product/image'), $photo_uname);
        } else {
            $photo_uname = $request->doctor_old_photo;
        }



        $edit_data->name =  $request->name;
        $edit_data->type =  $request->type;
        $edit_data->barcode_symbology =  $request->code;
        $edit_data->brand_id =  $request->brand_id;
        $edit_data->category_id =  $request->category_id;
        $edit_data->unit_id =  $request->unit_id;
        $edit_data->purchase_unit_id =  $request->purchase_unit_id;
        $edit_data->sale_unit_id =  $request->sale_unit_id;
        $edit_data->price =  $request->price;
        $edit_data->cost =  $request->cost;
        //$edit_data->qty =  $request->qty;
        $edit_data->alert_quantity =  $request->alert_quantity;
        $edit_data->promotion =  $request->promotion;
        $edit_data->promotion_price =  $request->promotion_price;
        $edit_data->starting_date =  $request->starting_date;
        $edit_data->last_date =  $request->last_date;
        $edit_data->tax_id =  $request->tax_id;
        $edit_data->tax_method =  $request->tax_method;
        $edit_data->image =  $photo_uname;
        $edit_data->file =  $file_uname;
        $edit_data->is_variant =  $request->is_variant;
        $edit_data->featured =  $request->featured;
        $edit_data->product_list =  $product_list;
        $edit_data->qty_list =  $product_qty;
        $edit_data->price_list =  $unit_price;
        $edit_data->product_details =  $request->product_details;
        $edit_data->is_active =  1;

        $edit_data->update();

        return response()->json('success');
    }


    public function updateProductCombo(Request $request, $id)
    {

        $edit_data = Product::find($id);

        $product_list = '';
        $product_qty = '';
        $unit_price = '';
        $file_uname = '';

        $product_list = implode(",", $request->product_id);

        // $product_list = json_encode($request->product_id);
        $product_qty = implode(",", $request->product_qty);
        $unit_price = implode(",", $request->unit_price);


        //return response()->json(['success' => $edit_photo_uname]);
        if ($request->hasFile('imageProduct')) {
            $img = $request->file('imageProduct');
            $photo_uname = md5(time() . rand()) . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('uploads/product/image'), $photo_uname);
        } else {
            $photo_uname = $request->doctor_old_photo;
        }

        $edit_data->name =  $request->name;
        $edit_data->type =  $request->type;
        $edit_data->barcode_symbology =  $request->code;
        $edit_data->brand_id =  $request->brand_id;
        $edit_data->category_id =  $request->category_id;
        $edit_data->unit_id =  $request->unit_id;
        $edit_data->purchase_unit_id =  $request->purchase_unit_id;
        $edit_data->sale_unit_id =  $request->sale_unit_id;
        $edit_data->price =  $request->price;
        $edit_data->cost =  $request->cost;
        $edit_data->qty =  $request->qty;
        $edit_data->alert_quantity =  $request->alert_quantity;
        $edit_data->promotion =  $request->promotion;
        $edit_data->promotion_price =  $request->promotion_price;
        $edit_data->starting_date =  $request->starting_date;
        $edit_data->last_date =  $request->last_date;
        $edit_data->tax_id =  $request->tax_id;
        $edit_data->tax_method =  $request->tax_method;
        $edit_data->image =  $photo_uname;
        $edit_data->file =  $file_uname;
        $edit_data->is_variant =  $request->is_variant;
        $edit_data->featured =  $request->featured;
        $edit_data->product_list =  $product_list;
        $edit_data->qty_list =  $product_qty;
        $edit_data->price_list =  $unit_price;
        $edit_data->product_details =  $request->product_details;
        $edit_data->is_active =  1;

        $edit_data->update();

        return response()->json('success');
    }



    //deleteProduct
    public function deleteProduct($id)
    {
        $data = Product::find($id);
        $data->delete();

        Alert::success('Success', 'File Send Successfully');
        return redirect()->route('admin.addProductList');

        //return response()->json('success');
    }




    //getAllProduct
    public function getAllProduct()
    {
        $data = Product::where('type', 'standard')
            ->orWhere('type', 'digital')->get();
        $productSearch = [];

        foreach ($data as $details) {

            array_push($productSearch, $details['barcode_symbology'] . ' ' . $details['name']);
        }

        return response()->json($productSearch);
    }
    public function addProductImage(Request $request)
    {
        // $image = $request->file('file');
        // $imageName = time() . '.' . $image->extention();
        // $image->move(public_path('uploads/product/image'), $imageName);

        $edit_img = $request->file('file');
        $edit_photo_uname = md5(time() . rand()) . '.' . $edit_img->getClientOriginalExtension();
        $edit_img->move(public_path('uploads/product/image'), $edit_photo_uname);

        return response()->json(['success' => $edit_photo_uname]);
    }

    public function SearchProduct(Request $request, $id)
    {

        $search = $id;

        if ($search == '') {
            $product = Product::orderby('name', 'asc')->select('id', 'barcode_symbology', 'name')->limit(5)->get();
        } else {
            $product = Product::orderby('name', 'asc')
                ->where('barcode_symbology', $id)
                ->first();
        }

        //return json($product);
        return response()->json($product);
        //return response()->json(['data' => $all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
    }
    /**
     * 
     *
     * Product List.
     * 
     */

    //
    public function productList()
    {
        $all_product = Product::all();

        return view('admin/product/productList', compact('all_product'));
        //return view('admin/product/productList', compact('all_category'));
    }


    /**
     * 
     *
     * Product Category.
     * 
     */
    public function productCategoryListTable()
    {

        //$all_asset = AssetType::latest()->first();
        //return $all_asset;
        $all_category = Category::all();
        //echo $all_expense;
        //return $all_expense;
        return response()->json([
            'data' => $all_category,
        ]);
    }
    public function addProductCategory(Request $request)
    {

        $request->validate([
            'category_name' => 'required',
            'status' => 'required',

        ]);
        //echo "controller";
        //$data = $request->country;
        if ($request->hasFile('image')) {
            $edit_img = $request->file('image');
            $edit_photo_uname = md5(time() . rand()) . '.' . $edit_img->getClientOriginalExtension();
            $edit_img->move(public_path('uploads/product/category'), $edit_photo_uname);
        } else {
            $edit_photo_uname = '';
        }


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

        Category::create([

            'category_name' => $request->category_name,
            'status' => $request->status,
            'category_image' => $edit_photo_uname

        ]);

        return response()->json('success');
        // return $data;
    }
    //editProductCategory
    public function editProductCategory($id)
    {
        $data = Category::find($id);
        return [
            'category_name' => $data->category_name,
            'status' => $data->status,
            'category_image' => $data->category_image,
        ];
    }
    //updateProductCategory
    public function updateProductCategory(Request $request, $id)
    {
        $request->validate([
            'category_nameEdit' => 'required',
            'statusEdit' => 'required',
        ]);

        if ($request->hasFile('imageEdit')) {
            $edit_img = $request->file('imageEdit');
            $edit_photo_uname = md5(time() . rand()) . '.' . $edit_img->getClientOriginalExtension();
            $edit_img->move(public_path('uploads/product/category'), $edit_photo_uname);
        } else {
            $photo = Category::find($id)->first();
            $edit_photo_uname = $photo->category_image;
        }

        $edit_data = Category::find($id);
        $edit_data->category_name = $request->category_nameEdit;
        $edit_data->status = $request->statusEdit;
        $edit_data->category_image = $edit_photo_uname;


        $edit_data->update();
        return response()->json('Updated');
    }

    //deleteProductCategory
    public function deleteProductCategory($id)
    {
        $data = Category::find($id);
        $data->delete();
        return response()->json('success');
    }
}