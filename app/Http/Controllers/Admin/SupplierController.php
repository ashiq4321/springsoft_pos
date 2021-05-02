<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function supplierListTable()
    {

        //$all_asset = AssetType::latest()->first();
        //return $all_asset;
        $all_supplier = Supplier::all();
        //echo $all_expense;
        //return $all_expense;
        return response()->json([
            'data' => $all_supplier,
            'index' => 0
        ]);
    }
    public function addSupplierList(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'company_name' => 'required',
            'vat_number' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:suppliers',
            'image' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'country' => 'required',

        ]);

        $edit_img = $request->file('photo');
        $edit_photo_uname = md5(time() . rand()) . '.' . $edit_img->getClientOriginalExtension();
        $edit_img->move(public_path('uploads/supplier'), $edit_photo_uname);

        //$data = $edit_img;

        Supplier::create([

            'name' => $request->name,
            'company_name' => $request->company_name,
            'vat_number' => $request->vat,
            'phone' => $request->phone,
            'email' => $request->email,
            'image' => $edit_photo_uname,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,

        ]);

        return response()->json('success');
        // return $data;
    }

    public function deleteSupplierList($id)
    {
        $data = Supplier::find($id);
        $data->delete();
        return response()->json('success');
    }
    //
    public function editSupplierList($id)
    {
        $data = Supplier::find($id);
        return [
            'name' => $data->name,
            'company_name' => $data->company_name,
            'vat_number' => $data->vat_number,
            'phone' => $data->phone,
            'email' => $data->email,
            'image' => $data->image,
            'address' => $data->address,
            'city' => $data->city,
            'state' => $data->state,
            'postal_code' => $data->postal_code,
            'country' => $data->country,
        ];
    }

    //updateSupplierList
    public function updateSupplierList(Request $request, $id)
    {


        $request->validate([
            'nameEdit' => 'required',
            'company_nameEdit' => 'required',
            'vatEdit' => 'required',
            'phoneEdit' => 'required',
            'emailEdit' => 'required|email',
            'addressEdit' => 'required',
            'cityEdit' => 'required',
            'stateEdit' => 'required',
            'postal_codeEdit' => 'required',
            'countryEdit' => 'required',
        ]);

        $edit_data = Supplier::find($id);

        if ($request->hasFile('imageEdit')) {
            $edit_img = $request->file('imageEdit');
            $edit_photo_uname = md5(time() . rand()) . '.' . $edit_img->getClientOriginalExtension();
            $edit_img->move(public_path('uploads/supplier'), $edit_photo_uname);

            $edit_data->image = $edit_photo_uname;
        }

        $edit_data->name = $request->nameEdit;
        $edit_data->company_name = $request->company_nameEdit;
        $edit_data->vat_number = $request->vatEdit;
        $edit_data->phone = $request->phoneEdit;
        $edit_data->email = $request->emailEdit;
        
        $edit_data->address = $request->addressEdit;
        $edit_data->city = $request->cityEdit;
        $edit_data->state = $request->stateEdit;
        $edit_data->postal_code = $request->postal_codeEdit;
        $edit_data->country = $request->countryEdit;

        $edit_data->update();
        return response()->json('Updated');
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
        //
    }
}