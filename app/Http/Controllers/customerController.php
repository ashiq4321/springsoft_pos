<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class customerController extends Controller
{
    public function getIndex()
    {
        return view('customer.index');
    }

    public function getData()
    {

        $all = Customer::all();
        return response()->json(['data' => $all]);
    }

    public function postStore(Request $r)
    {
        $validated = $r->validate([
            'name' => 'required|unique:customers',
            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:customers|max:13',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postalcode' => 'required',
            'country' => 'required',
        ]);

        $data = Customer::insert([
            'name' => $r->name,
            'phone' => $r->phone,
            'a_tax' => $r->tax_no,
            'cus_email' => $r->mail,
            'company_name' => $r->companyname,
            'address' => $r->address,
            'city' => $r->city,
            'state' => $r->state,
            'postal_code' => $r->postalcode,
            'country' => $r->country,
        ]);
        return response()->json($data);
    }



    public function editData($id)
    {
        $data = Customer::findorFail($id);
        return response()->json($data);
    }


    public function postUpdate(Request $r, $id)
    {
        $validated = $r->validate([
            'name' => 'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/|max:13',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postalcode' => 'required',
            'country' => 'required',

        ]);
        $data = Customer::findorFail($id)->update([
            'name' => $r->name,
            'phone' => $r->phone,
            'a_tax' => $r->tax_no,
            'cus_email' => $r->mail,
            'company_name' => $r->companyname,
            'address' => $r->address,
            'city' => $r->city,
            'state' => $r->state,
            'postal_code' => $r->postalcode,
            'country' => $r->country,
        ]);
        return response()->json($data);
    }

    public function Delete($id)
    {
        Customer::where('id', $id)->delete();
        return Redirect()->back();
    }
}