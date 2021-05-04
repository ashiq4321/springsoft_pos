<?php

namespace App\Http\Controllers\Admin;

use App\Sale;
use App\Customer;
use App\Giftcard;
use App\User;
use App\Product;
use App\Coupon;
use App\Biller;
use App\Payment;
use App\Payment_with_credit_card;
use App\Product_sale;
use App\delivery;
use App\Payment_with_giftcard;
use App\Payment_with_cheque;
use App\Product_warehouse;
use DB;
use Auth;
use Carbon\Carbon;
use App\warehouse\WarehouseModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class salesController extends Controller
{
    //   -----------------sales--------------
    public function getIndex()
    {
        $data = DB::table('sales')
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->join('billers', 'sales.biller_id', '=', 'billers.id')
            ->select('sales.*', 'customers.name as cname', 'billers.name as bname')
            ->get();
        return view('admin.sales.salesList', compact('data'));
    }

    public function getData()
    {
        $data = DB::table('sales')
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->join('billers', 'sales.biller_id', '=', 'billers.id')
            ->select('sales.*', 'customers.name as cname', 'billers.name as bname')
            ->get();
        return response()->json(['data' => $data]);
    }

    public function addsale()
    {

        $customer = Customer::get();
        $warehouse = WarehouseModel::get();
        $biller = Biller::get();
        $giftcard = Giftcard::join('customers', 'giftcards.customer_id', '=', 'customers.id')
            ->select('giftcards.*', 'customers.name as name')
            ->get();
        return view('admin.sales.addsales', compact('customer', 'warehouse', 'giftcard', 'biller'));
    }

    public function Search(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $product = Product::orderby('name', 'asc')->select('id', 'barcode_symbology', 'name')->limit(5)->get();
        } else {
            $product = Product::orderby('name', 'asc')->select('id', 'barcode_symbology', 'name')
                ->where('barcode_symbology', 'like', '%' . $search . '%')
                ->OrWhere('name', 'like', '%' . $search . '%')
                ->limit(5)->get();
        }
        $response = array();
        foreach ($product as $pro) {
            $response[] = array("value" => $pro->id, "label" => $pro->barcode_symbology . ' (' . $pro->name . ')');
        }

        return response()->json($response);
    }




    public function Find(Request $request, $id)
    {
        $data = Product::find($id);
        return response()->json($data);
    }

    public function importsale()
    {
        return view('admin.sales.updatesale');
    }
    // ------------------saleend-------------




    // --------------------Giftfunction------------
    public function getGiftcard()
    {
        $user = User::get();
        $customer = Customer::get();
        return view('admin.sales.gift', compact('customer', 'user'));
    }

    public function giftcard()
    {
        $data = DB::table('giftcards')
            ->join('customers', 'giftcards.customer_id', '=', 'customers.id')
            ->join('users', 'giftcards.created_by', '=', 'users.id')
            ->select('giftcards.*', 'customers.name as cname', 'users.name as uname')
            ->get();
        return response()->json(['data' => $data]);
    }

    public function giftStore(Request $r)
    {
        $validated = $r->validate([
            'card' => 'required|unique:giftcards',
            'amount' => 'required',
            'expireddate' => 'required',

        ]);

        $data = Giftcard::insert([
            'card' => $r->card,
            'amount' => $r->amount,
            'customer_id' => $r->customer_id,
            'user_id' => $r->user_id,
            'expense' => 0,
            'expired_date' => $r->expireddate,
            'created_by' => Auth::user()->id,
        ]);
        return response()->json($data);
    }

    public function gifteditdata($id)
    {
        $data = Giftcard::findorFail($id);
        return response()->json($data);
    }


    public function postUpdate(Request $r, $id)
    {
        $validated = $r->validate([
            'card' => 'required',
            'amount' => 'required',
            'expireddate' => 'required',

        ]);

        $all = Giftcard::findorFail($id)->update([
            'card' => $r->card,
            'amount' => $r->amount,
            'customer_id' => $r->customer_id,
            'user_id' => $r->user_id,
            'expired_date' => $r->expireddate,
            'created_by' => Auth::user()->id,
        ]);
        return response()->json($all);
    }

    public function giftDelete($id)
    {
        Giftcard::where('id', $id)->delete();
        return Redirect()->back();
    }
    // --------------------Giftfunction End------------

    public function getDelivary()
    {
        return view('admin.sales.delivary');
    }
    public function getdelivaryData()
    {
        $data = DB::table('deliveries')->get();
        return response()->json($data);
    }
    //coupon -----------------------------
    public function getCoupon()
    {
        return view('admin.sales.coupon');
    }

    public function getcouponData()
    {
        $data = Coupon::get();
        return response()->json($data);
    }



    public function  couponStore(Request $r)
    {
        $validated = $r->validate([
            'card' => 'required',
            'amount' => 'required',
            'qty' => 'required',
            'expireddate' => 'required',

        ]);

        $data = Coupon::insert([
            'code' => $r->card,
            'type' => $r->type,
            'amount' => $r->amount,
            'minimum_amount' => $r->mamount,
            'quantity' => $r->qty,
            'expire_date' => $r->expireddate,

            //'created_by'=>Auth::user()->id,
        ]);
        return response()->json($data);
    }

    public function couponDelete($id)
    {
        Coupon::where('id', $id)->delete();
        return Redirect()->back();
    }

    public function couponeditdata($id)
    {
        $data = Coupon::findorFail($id);
        return response()->json($data);
    }


    public function dataUpdate(Request $r, $id)
    {
        $validated = $r->validate([
            'card' => 'required',
            'amount' => 'required',
            'qty' => 'required',
            'expireddate' => 'required',

        ]);

        $all = Coupon::findorFail($id)->update([
            'code' => $r->card,
            'type' => $r->type,
            'amount' => $r->amount,
            'minimum_amount' => $r->mamount,
            'quantity' => $r->qty,
            'expire_date' => $r->expireddate,
        ]);
        return response()->json($all);
    }



    public function payment(Request $request)
    {

        //dd($request);

        $validated = $request->validate([
            'customer_id' => 'required',
            'warehouse_id' => 'required',
            

        ]);



        if ($request->hasFile('document')) {
            $edit_img = $request->file('document');
            $edit_photo_uname = md5(time() . rand()) . '.' . $edit_img->getClientOriginalExtension();
            $edit_img->move(public_path('uploads/product/sale'), $edit_photo_uname);
        } else {
            $edit_photo_uname = '';
        }

        $sale = Sale::create([
            'reference_no' => mt_rand(),
            'user_id' => Auth::user()->id,
            'Customer_id' => $request->customer_id,
            'warehouse_id' => $request->warehouse_id,
            'biller_id' => $request->biller_id,
            'item' => $request->item,
            'total_qty' => $request->total_qty,
            'total_discount' => $request->total_discount,
            'total_tax' => $request->total_tax,
            'total_price' => $request->total_cost,
            'grand_total' => $request->grand_total,
            'order_tax_rate' => $request->order_tax_rate,
            'order_tax' => $request->order_tax,
            'order_discount' => $request->order_discount,
            'cupon_id' => '1',
            'cupon_discount' => $request->coupon_discount,
            'shipping_cost' => $request->shipping_cost,
            'sale_status' => $request->sale_status,
            'payment_status' => $request->payment_status,
            'document' => $request->document,
            'paid_amount' => $request->paid_amount,
            'sale_note' => $request->sale_note,
            'staff_note' => $request->staff_note,
        ]);
        $customer = Customer::find($request->customer_id);
        $user = User::find(Auth::user()->id);


        $delivery = Delivery::create([
            'ref' => mt_rand(),
            'sale_id' => $sale->reference_no,
            'address' =>  $customer->address,
            'deli_by' => $user->name,
            'rec_by' =>  $customer->name,
            'file' =>  $request->document,
            'file' =>  $request->document,
            'note' => $sale->sale_note,
            'status' => 'Picking',

        ]);

        $purchased = [];
        foreach ($request->product_id as $product_id) {
            $each = array("name" => '', "qty" => '', "unit_cost" => '', "total" => '');
            $product = Product::find($product_id);
            $index = array_search($product_id, $request->product_id);
            $purchase_qty = $request->qty[$index];
            $stored_qty = $product->qty;
            product_sale::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'qty' => $purchase_qty,
                'net_unit_price' => $product->price,
                'discount' => $request->discount[$index],
                'tax_rate' => $request->tax_rate[$index],
                'tax' => $request->tax[$index],
                'total' => $request->subtotal[$index],
            ]);
            $product->qty = $stored_qty - $purchase_qty;
            $product->save();
            $product_warehouse = Product_warehouse::where('product_id', $product->id)
                ->where('warehouse_id', $request->warehouse_id)
                ->first();
            $product_warehouse->qty = $product_warehouse->qty - $purchase_qty;
            $product_warehouse->save();
            $each['code'] = $product->barcode_symbology;
            $each['name'] = $product->name;
            $each['qty'] = $purchase_qty;
            $each['unit_cost'] = $product->price;
            $each['discount'] = $request->discount[$index];
            $each['tax'] = $request->tax[$index];
            $each['total'] = $request->subtotal[$index];

            array_push($purchased, $each);
        }

        $payment = Payment::create([
            'payment_reference' => mt_rand(), //?
            'user_id' => Auth::user()->id,
            'purchase_id' => mt_rand(), //?
            'sale_id' => $sale->id,
            'customer_id' => $request->customer_id, //?, 
            'amount' => $sale->grand_total, //is it grand?
            'change' => $request->change,
            'paying_method' => $request->paid_by_id,
            'payment_note' => $request->payment_note
        ]);


        if ($payment->paying_method == 3) {

            Payment_with_credit_card::create([
                'payment_id' => $payment->id, //is it card id?
                'customer_id' => $request->customer_id,
                // 'sale_id' => $sale->id,
                // 'card_no' => $request->card_no,
                'customer_stripe_id' => 'null', //?
                'charge_id' => 'null' //?
            ]);
        }

        if ($payment->paying_method == 2) {

            Payment_with_giftcard::create([
                'payment_id' => $payment->id, //is it card id?
                'giftcard_id' => $request->gift_card_id,
                //'sale_id' => $sale->id,
            ]);



            $gift = Giftcard::where('id', $request->gift_card_id)->increment('expense', $sale->grand_total);
        }

        if ($payment->paying_method == 4) {
            Payment_with_cheque::create([
                'payment_id' => $payment->id, //is it card id?
                'cheque_no' => $request->cheque_no,
                //'sale_id' => $sale->id,
            ]);
        }



        $due = 0;
        if ($request->grand_total > $request->paid_amount) {
            $due = $request->grand_total - $request->paid_amount;
        }
        if ($request->grand_total > $request->paid_amount) {
            $due = $request->grand_total - $request->paid_amount;
        }

        $paying_method = '';
        $pay = $request->paid_by_id;

        if ($pay == 1) {
            $paying_method = 'Cash';
        }
        if ($pay == 2) {
            $paying_method = 'Giftcard';
        }
        if ($pay == 3) {
            $paying_method = 'Card';
        }
        if ($pay == 4) {
            $paying_method = 'cheque';
        }
        $order_tax_rate = '';
        $taxrate = $request->order_tax_rate;
        if ($taxrate = 10) {
            $order_tax_rate = '10%';
        }
        if ($taxrate = 15) {
            $order_tax_rate = '15%';
        }
        if ($taxrate = 20) {
            $order_tax_rate = '20%';
        } else {
            $order_tax_rate = '0%';
        }


        $invoice = [
            $customer->name,
            $customer->address,
            date("Y-m-d"),
            mt_rand(00000, 99999),
            $request->total_cost,
            $request->order_tax,
            $request->order_discount,
            $request->shipping_cost,
            $request->grand_total,
            $due,
            $request->change,
            $customer->phone,
            $paying_method,
            $request->paying_amount,
            $order_tax_rate,
            $sale->reference_no,

        ];
        //dd($invoice);
        return view('admin.sales.invoice', compact('purchased'))->with('i', $invoice);
    }

    public function saleDelete($id)
    {
        Sale::where('id', $id)->delete();
        return Redirect()->back();
    }

    public function productCeheck(Request $request)
    {
        $data = Product_warehouse::where('product_id', $request->product_id)
            ->where('warehouse_id', $request->warehouse_id)
            ->first();
        /* if($product_warehouse==null){
            
        } */

        return response()->json($data);
    }

    public function gift(Request $request)
    {
        $date = \Carbon\Carbon::today();
        $data = Giftcard::where('customer_id', $request->customer_id)
            ->where('expired_date', '>=', $date)
            ->get();
        return response()->json($data);
    }

    ///sale Edit

    public function saleEdit($id)
    {
        $data = Product_sale::where('sale_id', '=', $id)
            ->join('products', 'product_sales.product_id', 'products.id')
            ->join('sales', 'product_sales.sale_id', 'sales.id')
            ->select('product_sales.*', 'product_sales.qty as pqty', 'products.*', 'sales.*')
            ->get();
        $customer = Customer::get();
        $warehouse = WarehouseModel::get();
        $biller = Biller::get();
        $giftcard = Giftcard::join('customers', 'giftcards.customer_id', '=', 'customers.id')
            ->select('giftcards.*', 'customers.name as name')
            ->get();

        // return response()->json($data);
        return view('admin.sales.editsale', compact('customer', 'warehouse', 'biller', 'giftcard'), ['data' => $data]);
    }


    //saleUpdate

    public function saleUpdate(Request $request, $id)
    {
        $sale = Sale::findorFail($id)->update([
            'user_id' => Auth::user()->id,
            'Customer_id' => $request->customer_id,
            'warehouse_id' => $request->warehouse_id,
            'biller_id' => $request->biller_id,
            'item' => $request->item,
            'total_qty' => $request->total_qty,
            'total_discount' => $request->total_discount,
            'total_tax' => $request->total_tax,
            'total_price' => $request->total_cost,
            'grand_total' => $request->grand_total,
            'order_tax_rate' => $request->order_tax_rate,
            'order_tax' => $request->order_tax,
            'order_discount' => $request->order_discount,
            //'cupon_id' => '1',
            'cupon_discount' => $request->coupon_discount,
            'shipping_cost' => $request->shipping_cost,
            'sale_status' => $request->sale_status,
            'payment_status' => $request->payment_status,
            'document' => 'null', //what is that?
            'paid_amount' => $request->paid_amount,
            'sale_note' => $request->sale_note,
            'staff_note' => $request->staff_note,
        ]);

        foreach ($request->product_id as $key => $p_id) {
            $product_sale_check =  Product_sale::where('product_id', '=', $p_id)->where('sale_id', '=', $id)->first();

            if ($product_sale_check) {
                $old = $product_sale_check->qty;
                $new_quantity = $request->qty[$key];
                $product_sale_check->qty = $new_quantity;
                $product_sale_check->update();
                if ($old < $new_quantity) {
                    $tem = $new_quantity - $old;
                    $product_warehouse = Product_warehouse::where('product_id', $p_id)
                        ->where('warehouse_id', $request->warehouse_id)
                        ->first();
                    $product_warehouse->qty = $product_warehouse->qty -  $tem;
                    $product_warehouse->save();
                    $product = Product::find($p_id);
                    $product->qty = $product->qty -  $tem;
                    $product->save();
                }
                if ($old > $new_quantity) {
                    $tem1 = $old - $new_quantity;
                    $product_warehouse = Product_warehouse::where('product_id', $p_id)
                        ->where('warehouse_id', $request->warehouse_id)
                        ->first();
                    $product_warehouse->qty = $product_warehouse->qty +  $tem1;
                    $product_warehouse->save();
                    $product = Product::find($p_id);
                    $product->qty = $product->qty +  $tem1;
                    $product->save();
                }
            } else {
                $data = new Product_sale();
                $data->sale_id = $id;
                $data->product_id = $p_id;
                $data->qty = $request->qty[$key];
                $data->net_unit_price = $request->unit_price[$key];
                $data->discount = $request->discount[$key];
                $data->tax_rate = $request->tax_rate[$key];
                $data->tax = $request->tax[$key];
                $data->total = $request->subtotal[$key];

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
        }
        $payment = Payment::where('sale_id', '=', $id)->update([
            'payment_reference' => mt_rand(), //?
            'user_id' => Auth::user()->id,
            'purchase_id' => mt_rand(), //?
            'customer_id' => $request->customer_id, //?, 
            'amount' => $request->grand_total, //is it grand?
            'change' => $request->change,
            'paying_method' => $request->paid_by_id,
            'payment_note' => $request->payment_note

        ]);


        //paymentgetway update
        // if($request->paid_by_id==3){
        //    Payment_with_credit_card::where('sale_id','=',$id)->update([
        //     'customer_id' => $request->customer_id,//?, 
        //     'payment_id' => $request->paid_by_id,
        //     'card_no' => $request->card_no,

        // ]);

        //    }
        //    if($request->paid_by_id==2){
        //     Payment_with_credit_card::where('sale_id','=',$id)->update([
        //         'payment_id' => $payment->id, //is it card id?
        //         'giftcard_id' => $request->gift_card_id,
        //         'sale_id' => $sale->id,

        //  ]);
        //  $gift= Giftcard::where('id',$request->gift_card_id)->increment('expense', $sale->grand_total);


        //     }
        //     if($request->paid_by_id==4){
        //         Payment_with_cheque::where('sale_id','=',$id)->update([
        //             'payment_id' => $payment->id, //is it card id?
        //             'cheque_no' => $request->cheque_no,
        //             'sale_id' => $sale->id,

        //      ]);

        //         }



    }

    //*/ Delivary by Ashraful Alam*//*

    public function getDelivery()
    { 
      
        return view('admin.sales.delivery.index');
    }
    public function getdeliveryData()
    {
        $data = DB::table('deliveries')->get();
            return response()->json($data);

    }
    public function editDeliveryData($id)
    {
        $delivery = DB::table('deliveries')->where('id', $id)->get();

        $sale_refrence = DB::table('sales')->where('id', $delivery[0]->sale_id)->value('reference_no');

        $customer = DB::table('sales')->where('sales.id', $delivery[0]->sale_id)
            ->join('customers', 'sales.Customer_id', '=', 'customers.id')
            ->value('customers.name');

        // return $delivery[0]->id;

        $data = [
            'id'                    => $delivery[0]->id,
            'delivery_reference'    => $delivery[0]->ref,
            'sale_reference'        => $sale_refrence,
            'status'                => $delivery[0]->status,
            'delevered_by'          => $delivery[0]->deli_by,
            'received_by'           => $delivery[0]->rec_by,
            'customer'              => $customer,
            'file'                  => '',
            'address'               => $delivery[0]->address,
            'note'                  => $delivery[0]->note,
        ];

        // return $data;

        return view('admin.sales.delivery.edit', $data);
    }
    public function updateDeliveryData(Request $request, $id)
    {
        // return $request->all();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = md5(time() . rand()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/deliveries'), $file_name);

            DB::table('deliveries')->where('id', $id)->update([
                'file'          => $file_name,
            ]);
        }

        DB::table('deliveries')->where('id', $id)->update([
            'status'        => $request->status,
            'deli_by'       => $request->delevered_by,
            'rec_by'        => $request->received_by,
            'note'          => $request->note,
            'address'       => $request->address,
        ]);

        // return response()->json('Updated');

        $data = DB::table('deliveries')->get();

        return response()->json([
            'data' => $data,
            'index' => 0
        ]);
    }
    public function deleteDeliveryData($id)
    {
        DB::table('deliveries')->where('id', $id)->delete();
        return response()->json('success');
    }
}