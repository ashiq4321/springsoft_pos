<?php

namespace App\Http\Controllers\purchase;

//use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\purchase\PurchaseModel;
use App\warehouse\WarehouseModel;
use App\product\ProductModel;
use Illuminate\Http\Request;
use App\Purchase;
use App\Product;
use App\Product_Purchase;
use App\Product_warehouse;
use App\supplier;
use App\Payment;
use App\Payment_with_credit_card;
use App\Payment_with_cheque;
use App\Payment_with_gift_card;

use DB;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
  public function index()
  {
    return view('admin.purchase.index');
  }
  public function addPurchase()
  {
    return view('admin.purchase.addPurchase', ['warehouses' => WarehouseModel::all(), 'supplier' =>  \App\supplier::all()]);
  }

  public function store(Request $req)
  {

    // return $req->status;
    $validated = $req->validate([
      // 'reference_no'    => 'required',
      // 'user_id'         => 'required',
      'warehouse_id'    => 'required',
      'item'            => 'required',
      'total_qty'       => 'required',
      'total_discount'  => 'required',
      'total_tax'       => 'required',
      'total_cost'      => 'required',
      'grand_total'     => 'required',
      // 'paid_amount'     => 'required',
      'status'          => 'required',
      // 'payment_status'  => 'required',
    ]);

    if ($req->status == 1) // 1 is Partial
    {
      $validated = $req->validate([
        'received'    => 'required',
      ]);
    }

    if ($req->hasFile('document')) {
      $edit_img = $req->file('document');
      $edit_photo_uname = md5(time() . rand()) . '.' . $edit_img->getClientOriginalExtension();
      $edit_img->move(public_path('uploads/product/purchase'), $edit_photo_uname);
    } else {
      $edit_photo_uname = null;
    }

    $purchase = Purchase::create([
      'reference_no'    => 1, // Why fixed?
      'user_id'         => Auth::user()->id,
      'warehouse_id'    => $req->warehouse_id,
      'supplier_id'     => $req->supplier_id, // optional
      'item'            => $req->item,
      'total_qty'       => $req->total_qty,
      'total_discount'  => $req->total_discount,
      'total_tax'       => $req->total_tax,
      'total_cost'      => $req->total_cost,

      'order_tax_rate'  => $req->order_tax_rate, // optional
      'order_tax'       => $req->order_tax, // optional
      'order_discount'  => $req->order_discount, // optional
      'shipping_cost'   => $req->shipping_cost, // optional

      'grand_total'     => $req->grand_total,
      'paid_amount'     => 0,
      'status'          => $req->status,
      'payment_status'  => '0', // 0 is Due

      'document'        => $edit_photo_uname, // optional
      'note'            => $req->note, // optional

    ]);

    if ($purchase) {
      foreach ($req->p_id as $key => $product_id) {

        // Update Product
        $product = Product::find($product_id);


        if ($req->status == 1) // 1 is Partial
        {
          $received = $req->received[$key];
          $product->update([
            'qty' => $product->qty + $req->received[$key],
          ]);
        } else {
          $received = $req->qty[$key];
          $product->update([
            'qty' => $product->qty + $req->qty[$key],
          ]);
        }

        $product_parchase = Product_Purchase::create([
          'purchase_id'       => $purchase->id,
          'product_id'        => $product->id,
          'purchase_unit_id'  => $product->unit_id,
          'qty'               => $req->qty[$key],
          'received'          => $received,
          'net_unit_cost'     => $req->net_u_c[$key],
          'discount'          => $req->dus[$key],
          'tax_rate'          => $req->order_tax_rate,
          'tax'               => $req->tx[$key],
          'total'             => $req->sub_total[$key],
        ]);

        if ($req->status == 1) {
          // Codes from Aumlan - Start -
          $warehouse_product_check =  Product_warehouse::where('product_id', '=', $product->id)->where('warehouse_id', '=', $req->warehouse_id)->first();
          if ($warehouse_product_check) {
            if ($product->id == $warehouse_product_check->product_id && $req->warehouse_id == $warehouse_product_check->warehouse_id) {

              $new_quantity = $warehouse_product_check->qty + $received;
              $warehouse_product_check->qty = $new_quantity;
              $warehouse_product_check->update();
            }
          } else {
            $data = new \App\product_warehouse();
            $data->warehouse_id = $req->warehouse_id;
            $data->product_id = $product->id;
            $data->qty = $received;
            $data->save();
          }
          // Codes from Aumlan - End -
        } else {
          // Codes from Aumlan - Start -
          $warehouse_product_check =  Product_warehouse::where('product_id', '=', $product->id)->where('warehouse_id', '=', $req->warehouse_id)->first();
          if ($warehouse_product_check) {
            if ($product->id == $warehouse_product_check->product_id && $req->warehouse_id == $warehouse_product_check->warehouse_id) {

              $new_quantity = $warehouse_product_check->qty + $req->qty[$key];
              $warehouse_product_check->qty = $new_quantity;
              $warehouse_product_check->update();
            }
          } else {
            $data = new \App\product_warehouse();
            $data->warehouse_id = $req->warehouse_id;
            $data->product_id = $product->id;
            $data->qty = $req->qty[$key];
            $data->save();
          }
          // Codes from Aumlan - End -
        }
      }
    }

    return response()->json('Success');
  }

  // Fetch product
  public function searchProducts(Request $request)
  {

    $data = null;
    $output = '';
    $query = $request->get('query');
    if ($query != '') {
      $data = DB::table('products')
        ->where('name', 'like', '%' . $query . '%')
        ->orWhere('barcode_symbology', 'like', '%' . $query . '%')
        ->orderBy('id', 'desc')
        ->get();
    } else {
      $data = null;
    }
    echo json_encode($data);
  }


  // Find a product
  public function findProduct(Request $request, $find_id)
  {
    $warehouse =  \App\Product::find($find_id);
    //   $warehouse =   ProductModel::find($find_id);
    //    $warehouse =   DB::table('products')->where('id', $find_id)->get();
    //
    return response()->json($warehouse);
    //   echo 'HGGHBGG';
  }

  public function Search(Request $request)
  {

    $search = $request->search;

    if ($search == '') {
      $product = ProductModel::orderby('name', 'asc')->select('id', 'barcode_symbology', 'name')->limit(5)->get();
    } else {
      $product = ProductModel::orderby('name', 'asc')->select('id', 'barcode_symbology', 'name')
        ->where('barcode_symbology', 'like', '%' . $search . '%')
        ->OrWhere('name', 'like', '%' . $search . '%')
        ->limit(5)->get();
    }
    $response = array();
    foreach ($product as $pro) {
      $response[] = array("value" => $pro->id, "label" => $pro->barcode_symbology . ' (' . $pro->name . ')');
    }
    return response()->json($response);
    // echo $response;
  }
  public function Find(Request $request, $id)
  {
    $data = ProductModel::find($id);
    //        return response()->json($data);
    echo $data->name;
  }


  // Find a warehouse
  /* public function updateWarehouse(Request $request, $update_id)
  {
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
  } */

  // Insert record
  /* public function addWarehouse(Request $request)
  {
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
  } */

  // delete record
  /*  public function deleteWarehouse(Request $request, $delete_id)
  {
    WarehouseModel::destroy($delete_id);
    return response()->json(
      [
        'success' => true

      ]
    );
  } */

  public function purchaseList()
  {
    $all_purchase = Purchase::all();

    return view('admin/purchase/purchaseList', compact('all_purchase'));
    //return view('admin/product/productList', compact('all_category'));
  }


  public function editPurchase($id)
  {
    $data = Purchase::find($id);
    $all_warehouse = WarehouseModel::all();
    $all_supplier = Supplier::all();

    $product_purchase = Product_Purchase::where('purchase_id', $id)->get();
    $count_product = $product_purchase->count();
    $all_product = Product::all();

    return view('admin/purchase/editPurchase', compact('data', 'all_warehouse', 'all_supplier', 'product_purchase', 'count_product', 'all_product'));
  }



  public function updatePurchase(Request $request, $id)
  {

    $edit_data = Purchase::find($id);

    if ($request->hasFile('document')) {
      $img = $request->file('document');
      $photo_uname = md5(time() . rand()) . '.' . $img->getClientOriginalExtension();
      $img->move(public_path('uploads/product/image'), $photo_uname);
    } else {
      $photo_uname = '';
    }




    $sale = Purchase::findorFail($id)->update([
      'reference_no'    => 1, // Why fixed?
      'user_id'         => Auth::user()->id,
      'warehouse_id'    => $request->warehouse_id,
      'supplier_id'     => $request->supplier_id, // optional
      'item'            => $request->item,
      'total_qty'       => $request->total_qty,
      'total_discount'  => $request->total_discount,
      'total_tax'       => $request->total_tax,
      'total_cost'      => $request->total_cost,

      'order_tax_rate'  => $request->order_tax_rate, // optional
      'order_tax'       => $request->order_tax, // optional
      'order_discount'  => $request->order_discount, // optional
      'shipping_cost'   => $request->shipping_cost, // optional

      'grand_total'     => $request->grand_total,
      'paid_amount'     => 0,
      'status'          => $request->status,
      'payment_status'  => '0', // 0 is Due

      'document'        => $photo_uname, // optional
      'note'            => $request->note, // optional
    ]);
    if ($sale) {


      foreach ($request->p_id as $key => $p_id) {
        $received = $request->qty[$key];
        $product_sale_check =  Product_purchase::where('product_id', '=', $p_id)->where('purchase_id', '=', $id)->first();

        if ($product_sale_check) {
          $old = $product_sale_check->qty;
          $new_quantity = $request->qty[$key];

          $product_sale_check->net_unit_cost = $request->net_u_c[$key];
          $product_sale_check->discount = $request->dus[$key];
          $product_sale_check->tax_rate = $request->order_tax_rate;
          $product_sale_check->tax = $request->tx[$key];
          //$product_sale_check->total = $request->sub_total[$key];

          $product_sale_check->qty = $new_quantity;
          $product_sale_check->update();
          if ($old < $new_quantity) {
            $tem = $new_quantity - $old;
            $product_warehouse = Product_warehouse::where('product_id', $p_id)
              ->where('warehouse_id', $request->warehouse_id)
              ->first();
            $product_warehouse->qty = $product_warehouse->qty +  $tem;
            $product_warehouse->save();
            $product = Product::find($p_id);
            $product->qty = $product->qty +  $tem;
            $product->save();
          }
          if ($old > $new_quantity) {
            $tem1 = $old - $new_quantity;
            $product_warehouse = Product_warehouse::where('product_id', $p_id)
              ->where('warehouse_id', $request->warehouse_id)
              ->first();
            $product_warehouse->qty = $product_warehouse->qty - $tem1;
            $product_warehouse->save();
            $product = Product::find($p_id);
            $product->qty = $product->qty -  $tem1;
            $product->save();
          }
        } else {
          $data = new Product_purchase();
          $data->purchase_id = $id;
          $data->product_id = $p_id;

          $data->qty = $request->qty[$key];
          $data->net_unit_price = $request->net_u_c[$key];
          $data->discount = $request->dus[$key];
          $data->tax_rate = $request->order_tax_rate;
          $data->tax = $request->tx[$key];
          $data->total = $request->sub_total[$key];

          $product_warehouse = Product_warehouse::where('product_id', $p_id)
            ->where('warehouse_id', $request->warehouse_id)
            ->first();
          $product_warehouse->qty = $product_warehouse->qty -  $data->qty;
          $product_warehouse->save();

          $product = Product::find($p_id);
          $product->qty = $product->qty -  $data->qty;
          $product->save();

          $data->save();
        }























        // if ($request->status == 1) // 1 is Partial
        // {
        //   $received = $request->received[$key];
        //   $product_sale_check =  Product_purchase::where('product_id', '=', $p_id)->first();
        //   $old = $product_sale_check->qty;
        //   if ($product_sale_check) {
        //     $new_quantity = $received;
        //     $product_sale_check->qty = $new_quantity;
        //     $product_sale_check->update();
        //     if ($old < $new_quantity) {
        //       $tem = $new_quantity - $old;
        //       $product_warehouse = Product_warehouse::where('product_id', $p_id)
        //         ->where('warehouse_id', $request->warehouse_id)
        //         ->first();
        //       $product_warehouse->qty = $product_warehouse->qty +  $tem;
        //       $product_warehouse->save();
        //       $product = Product::find($p_id);
        //       $product->qty = $product->qty +  $tem;
        //       $product->save();
        //     }
        //     if ($old > $new_quantity) {
        //       $tem1 = $old - $new_quantity;
        //       $product_warehouse = Product_warehouse::where('product_id', $p_id)
        //         ->where('warehouse_id', $request->warehouse_id)
        //         ->first();
        //       $product_warehouse->qty = $product_warehouse->qty - $tem1;
        //       $product_warehouse->save();
        //       $product = Product::find($p_id);
        //       $product->qty = $product->qty -  $tem1;
        //       $product->save();
        //     }
        //   } else {
        //     $data = new Product_purchase();
        //     $data->purchase_id = $id;
        //     $data->product_id = $p_id;

        //     $data->qty = $received;
        //     $data->net_unit_price = $request->net_u_c[$key];
        //     $data->discount = $request->dus[$key];
        //     $data->tax_rate = $request->order_tax_rate;
        //     $data->tax = $request->tx[$key];
        //     $data->total = $request->sub_total[$key];

        //     $product_warehouse = Product_warehouse::where('product_id', $p_id)
        //       ->where('warehouse_id', $request->warehouse_id)
        //       ->first();
        //     $product_warehouse->qty = $product_warehouse->qty -  $data->qty;
        //     $product_warehouse->save();

        //     $product = Product::find($p_id);
        //     $product->qty = $product->qty -  $data->qty;
        //     $product->save();

        //     $data->save();
        //   }
        // } else {
        //   $received = $request->qty[$key];
        //   $product_sale_check =  Product_purchase::where('product_id', '=', $p_id)->first();
        //   $old = $product_sale_check->qty;
        //   if ($product_sale_check) {
        //     $new_quantity = $request->qty[$key];
        //     $product_sale_check->qty = $new_quantity;
        //     $product_sale_check->update();
        //     if ($old < $new_quantity) {
        //       $tem = $new_quantity - $old;
        //       $product_warehouse = Product_warehouse::where('product_id', $p_id)
        //         ->where('warehouse_id', $request->warehouse_id)
        //         ->first();
        //       $product_warehouse->qty = $product_warehouse->qty +  $tem;
        //       $product_warehouse->save();
        //       $product = Product::find($p_id);
        //       $product->qty = $product->qty +  $tem;
        //       $product->save();
        //     }
        //     if ($old > $new_quantity) {
        //       $tem1 = $old - $new_quantity;
        //       $product_warehouse = Product_warehouse::where('product_id', $p_id)
        //         ->where('warehouse_id', $request->warehouse_id)
        //         ->first();
        //       $product_warehouse->qty = $product_warehouse->qty - $tem1;
        //       $product_warehouse->save();
        //       $product = Product::find($p_id);
        //       $product->qty = $product->qty -  $tem1;
        //       $product->save();
        //     }
        //   } else {
        //     $data = new Product_purchase();
        //     $data->purchase_id = $id;
        //     $data->product_id = $p_id;

        //     $data->qty = $request->qty[$key];
        //     $data->net_unit_price = $request->net_u_c[$key];
        //     $data->discount = $request->dus[$key];
        //     $data->tax_rate = $request->order_tax_rate;
        //     $data->tax = $request->tx[$key];
        //     $data->total = $request->sub_total[$key];

        //     $product_warehouse = Product_warehouse::where('product_id', $p_id)
        //       ->where('warehouse_id', $request->warehouse_id)
        //       ->first();
        //     $product_warehouse->qty = $product_warehouse->qty -  $data->qty;
        //     $product_warehouse->save();

        //     $product = Product::find($p_id);
        //     $product->qty = $product->qty -  $data->qty;
        //     $product->save();

        //     $data->save();
        //   }
        // }

      }
    }




    // 'purchase_id'       => $purchase->id,
    // 'product_id'        => $product->id,
    // 'purchase_unit_id'  => $product->unit_id,
    // 'qty'               => $req->qty[$key],
    // 'received'          => $received,
    // 'net_unit_cost'     => $req->net_u_c[$key],
    // 'discount'          => $req->dus[$key],
    // 'tax_rate'          => $req->order_tax_rate,
    // 'tax'               => $req->tx[$key],
    // 'total'             => $req->sub_total[$key],
    // foreach ($request->p_id as $key => $p_id) {
    //   $    = Product_purchase::where('product_id', '=', $p_id)->where('warehouse_id', '=', $request->warehouse_id)->first();
    //   $warehouse_product_check =  Product_warehouse::where('product_id', '=', $p_id)->where('warehouse_id', '=', $request->warehouse_id)->first();
    //   if ($warehouse_product_check) {
    //     if ($p_id == $warehouse_product_check->product_id && $request->warehouse_id == $warehouse_product_check->warehouse_id) {

    //       if ($warehouse_product_check->qty) {
    //         $new_quantity = $warehouse_product_check->qty + $request->qty[$key];
    //         $warehouse_product_check->qty = $new_quantity;
    //         $warehouse_product_check->update();
    //       } else {
    //         $new_quantity = $warehouse_product_check->qty - $request->qty[$key];
    //         $warehouse_product_check->qty = $new_quantity;
    //         $warehouse_product_check->update();
    //       }
    //     }
    //   } else {
    //     $data = new \App\product_warehouse();
    //     $data->warehouse_id = $request->warehouse_id;
    //     $data->product_id = $p_id;
    //     $data->qty = $request->qty[$key];
    //     $data->save();
    //   }
    // }



















    //$all_purchase = Purchase::all();

    //return view('admin/purchase/editPurchase', compact('all_purchase'));
  }
  public function add_payment_modal($id)
  {
    $data['purchase'] = Purchase::find($id);

    return view('admin.purchase.payment.add_payment', $data);
  }
  public function add_payment(Request $request, $id)
  {
    return $id;
    $purchase = Purchase::find($id);

    if ($purchase->paid_amount  > $purchase->grand_total - 1) {
      return 'Payment is already done!';
    }
    // return $request->all();

    if ($purchase->grand_total == $purchase->paid_amount + $request->paying_amount) {
      $payment_status = 1; // 1 is Paid
    } else {
      $payment_status = 0; // 0 is Due
    }

    $purchase->update([
      'paid_amount' => $purchase->paid_amount + $request->paying_amount,
      'payment_status' => $payment_status,
    ]);

    $payment = Payment::create([
      'payment_reference' => mt_rand(),
      'user_id' => Auth::user()->id,
      'purchase_id' => $purchase->id,
      'customer_id' => null,
      'amount' => $purchase->grand_total,
      'change' => $request->change,
      'paying_method' => $request->paid_by,
      'payment_note' => $request->payment_note,
    ]);

    if ($payment->paying_method == 'card') {

      Payment_with_credit_card::create([
        'payment_id' => $payment->id,
        'customer_id' => Auth::user()->id,
        'customer_stripe_id' => null,
        'card_number' => $request->card_no,
        'charge_id' => null,
      ]);
    }

    if ($payment->paying_method == 'cheque') {
      Payment_with_cheque::create([
        'payment_id' => $payment->id,
        'cheque_no' => $request->cheque_no,
      ]);
    }
  }
}