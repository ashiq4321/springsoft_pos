<?php

namespace App\Http\Controllers\warehouse;

use App\Http\Controllers\Controller;
use App\warehouse\WarehouseModel;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
  public function index()
  {
    return view('warehouse.warehouse');
  }

  // Fetch records
  public function getWarehouses()
  {
    $warehouses = WarehouseModel::all();
    return response()->json(
      [
        'success' => true,
        'warehouses' => $warehouses

      ]
    );
  }

  // Find a warehouse
  public function findWarehouse(Request $request, $find_id)
  {
    $warehouse = WarehouseModel::find($find_id);
    return response()->json(
      [
        'success' => true,
        'warehouse' => $warehouse

      ]
    );
  }

  // Find a warehouse
  public function updateWarehouse(Request $request, $update_id)
  {

    $validated = $request->validate([
        'name' => 'required',
        'phone' => 'required|regex:/(01)[0-9]{9}/|max:13',
        'email' => 'required|email',
        'address' => 'required',
        'status' => 'required',
    ]);

    $warehouse = WarehouseModel::find($update_id);
    $warehouse->name = $request->name;
    $warehouse->phone = $request->phone;
    $warehouse->email = $request->email;
    $warehouse->address = $request->address;
    $warehouse->is_active = $request->status;
    $warehouse->save();

    return response()->json(
      [
        'success' => true,

      ]
    );
  }

  // Insert record
  public function addWarehouse(Request $request)
  {

    $validated = $request->validate([
        'name' => 'required|unique:warehouses',
        'phone' => 'required|regex:/(01)[0-9]{9}/|max:13',
        'email' => 'required|email|unique:warehouses',
        'address' => 'required',
        'status' => 'required',
    ]);

    $name = $request->input('name');
    $phone = $request->input('phone');
    $email = $request->input('email');
    $address = $request->input('address');
    $is_active = $request->status;

    WarehouseModel::create([
      'name' => $name,
      'phone' => $phone,
      'email' => $email,
      'address' => $address,
      'is_active' => $is_active,
    ]);
    $warehouses['data'] = WarehouseModel::all();
    return response()->json(
      [
        'success' => true,
        'get_categories' => $warehouses

      ]
    );
  }

  // delete record
  public function deleteWarehouse(Request $request, $delete_id)
  {
    WarehouseModel::destroy($delete_id);
    return response()->json(
      [
        'success' => true

      ]
    );
  }
}