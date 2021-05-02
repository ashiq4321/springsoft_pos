<?php

namespace App\Http\Controllers\Admin;

use App\Biller;
use App\Http\Controllers\Controller;
use App\supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BillerController extends Controller
{
    public function __invoke()
    {
        // dd('invoked');  
        return view('admin/billers/index');
    }

    public function index()
    {
        $data = Biller::all();

        return response()->json([
            'data' => $data,
            'index' => 0
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'company_name' => 'required',
            'vat_number' => 'required',
            'phone_number' => 'required',
            'email' => 'required|unique:billers',
            'photo' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'country' => 'required',

        ]);

        $img = $request->file('photo');
        $photo_uname = md5(time() . rand()) . '.' . $img->getClientOriginalExtension();
        $img->move(public_path('uploads/billers'), $photo_uname);

        $biller = Biller::create([
            'name'          => $request->name,
            'company_name'  => $request->company_name,
            'vat_number'    => $request->vat_number,
            'phone_number'  => $request->phone_number,
            'email'         => $request->email,
            'image'         => $photo_uname,
            'address'       => $request->address,
            'city'          => $request->city,
            'state'         => $request->state,
            'postal_code'   => $request->postal_code,
            'country'       => $request->country,
        ]);

        return response()->json('success');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['biller'] = Biller::find($id);

        return view('admin/billers/edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'company_name' => 'required',
            'vat_number' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
        ]);

        $edit_data = Biller::find($id);

        if ($request->hasFile('imageEdit')) {
            $edit_img = $request->file('imageEdit');
            $edit_photo_uname = md5(time() . rand()) . '.' . $edit_img->getClientOriginalExtension();
            $edit_img->move(public_path('uploads/billers'), $edit_photo_uname);

            $edit_data->image = $edit_photo_uname;
        }

        $edit_data->name = $request->name;
        $edit_data->company_name = $request->company_name;
        $edit_data->vat_number = $request->vat_number;
        $edit_data->phone_number = $request->phone_number;
        $edit_data->email = $request->email;


        $edit_data->address = $request->address;
        $edit_data->city = $request->city;
        $edit_data->state = $request->state;
        $edit_data->postal_code = $request->postal_code;
        $edit_data->country = $request->country;

        $edit_data->update();

        $data = Biller::all();

        return response()->json([
            'data' => $data,
            'index' => 0
        ]);
    }

    public function destroy($id)
    {
        Biller::find($id)->delete();
        return response()->json('success');
    }
}