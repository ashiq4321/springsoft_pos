<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\warehouse\WarehouseModel;
use App\Product;
use App\Category;
use App\Customer;
use App\Brand;
use App\Biller;
use App\Sale;
use App\Product_sale;
use App\Product_warehouse;
use App\Payment;
use App\Payment_with_credit_card;
use App\Giftcard;
use App\Payment_with_gift_card;
use App\Draft;
use App\Coupon;


class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_product = Product::all();
        $all_categories = Category::all();
        $all_brands = Brand::all();
        $all_billers = Biller::all();
        $all_warehouses = WarehouseModel::all();
        $all_customers = Customer::all();
        $drafts = Draft::all()->sortByDesc("updated_at");
        $sales = Sale::where('sale_status', '1')->get();

        foreach ($sales as $sale) {
            $customer = Customer::Find($sale->Customer_id);
            $sale->cutomer_name = $customer->name;
        }
        return view('admin/pos/index', compact('all_product'), ['all_categories' => $all_categories, 'all_brands' => $all_brands, 'all_billers' => $all_billers, 'all_warehouses' => $all_warehouses, 'all_customers' => $all_customers, 'drafts' => $drafts, 'sales' => $sales]);
    }


    public function productFilter(Request $request)
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

    //productSearch
    public function productSearch(Request $request)
    {
        $product = Product::find($request->data);
        return response()->json($product);
    }

    public function productCategory(Request $request, $category_id)
    {
        $product = Product::where('category_id', $category_id)->get();
        return response()->json($product);
    }
    public function productBrand(Request $request, $brand_id)
    {
        $product = Product::where('brand_id', $brand_id)->get();
        return response()->json($product);
    }
    public function productFeatured(Request $request)
    {
        $product = Product::where('featured', '1')->get();
        return response()->json($product);
    }

    public function productCeheck(Request $request)
    {
        $product_warehouse = Product_warehouse::where('product_id', $request->product_id)
            ->where('warehouse_id', $request->warehouse_id)
            ->first();
        /* if($product_warehouse==null){
            
        } */
        return response()->json($product_warehouse);
    }
    public function getCoupon()
    {
        $coupon = Coupon::all();
        return response()->json($coupon);
    }
    //getProduct

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addCustomer(Request $r)
    {
        Customer::create([
            'name' => $r->name,
            'company_name' => $r->company_name,
            'phone' => $r->phone_number,
            'cus_email' => $r->email,
            'a_tax' => $r->a_tax,
            'address' => $r->address,
            'city' => $r->city,
            'state' => $r->state,
            'postal_code' => $r->postal_code,
            'country' => $r->country,
        ]);
        return redirect()->route('admin.pos');
    }

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
        /* dd($request); */
        if ($request->draft == 1) {
            $sale_status = 0;
        } else
            $sale_status = 1;

        $invoice = [];
        $sale = Sale::create([
            'reference_no' => mt_rand(0, 9),
            'user_id' => Auth::user()->id,
            'Customer_id' => $request->customer_id,
            'warehouse_id' => $request->warehouse_id,
            'biller_id' => $request->biller_id,
            'item' => $request->item,
            'total_qty' => $request->total_qty,
            'total_discount' => $request->total_discount,
            'total_tax' => $request->total_tax,
            'total_price' => $request->total_price,
            'grand_total' => $request->grand_total,
            'order_tax_rate' => $request->order_tax_rate_select,
            'order_tax' => $request->order_tax,
            'order_discount' => $request->order_discount,
            'cupon_id' => '1',
            'cupon_discount' => $request->coupon_discount,
            'shipping_cost' => $request->shipping_cost,
            'sale_status' => $sale_status,
            'payment_status' => 1,
            'document' => 'null', //what is that?
            'paid_amount' => $request->paid_amount,
            'sale_note' => $request->sale_note,
            'staff_note' => $request->staff_note,
        ]);

        $purchased = [];
        foreach ($request->product_id as $product_id) {
            $each = array("name" => '', "qty" => '', "unit_cost" => '', "total" => '');
            $product = Product::find($product_id);
            $index = array_search($product_id, $request->product_id);
            $purchase_qty = $request->qty[$index];
            $stored_qty = $product->qty;

            Product_sale::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'qty' => $purchase_qty,
                'net_unit_price' => $purchase_qty * $product->price,
                'discount' => 20, //$request->discount[$index], 
                'tax_rate' => 15, //$request->tax_rate[$index],
                'tax' => 60, //$request->tax[$index],
                'total' => 500 //$request->subtotal[$index]
            ]);
            $product->qty = $stored_qty - $purchase_qty;
            $product->save();
            
            $product_warehouse = Product_warehouse::where('product_id', $product->id)
                ->where('warehouse_id', $request->warehouse_id)
                ->first();
            $product_warehouse->qty = $product_warehouse->qty - $purchase_qty;
            $product_warehouse->save();

            $each['name'] = $product->name;
            $each['qty'] = $purchase_qty;
            $each['unit_cost'] = $product->price;
            $each['total'] = $purchase_qty * $product->price;

            array_push($purchased, $each);
        }
        $customer = Customer::find($request->customer_id);

        if ($request->draft == 1) {
            Draft::create([
                'sale_id' => $sale->id, //?
                'reference' => mt_rand(0000, 9999),
                'customer_name' => $customer->name,
                'grand_total' => $request->grand_total
            ]);
            return redirect()->route('admin.pos');
        }

        if ($request->coupon_id) {
            $coupon = Coupon::Find($request->coupon_id);
            $coupon->used = $coupon->used + 1;
            $coupon->save();
        }



        $payment = Payment::create([
            'payment_reference' => mt_rand(0, 9), //?
            'user_id' => Auth::user()->id,
            'purchase_id' => mt_rand(0, 9), //?
            'sale_id' => $sale->id,
            'customer_id' => Auth::user()->id, //?, 
            'amount' => $sale->grand_total, //is it grand?
            'change' => $request->change,
            'paying_method' => $request->paid_by,
            'payment_note' => $request->payment_note
        ]);
        if ($payment->paying_method == 'card') {

            Payment_with_credit_card::create([
                'payment_id' => $payment->id, //is it card id?
                'customer_id' => $request->customer_id,
                'customer_stripe_id' => 'null', //?
                'card_number' => $request->credit_card_id,
                'charge_id' => 'null' //?
            ]);
        }

        if ($payment->paying_method == 'gift card') {
            Payment_with_gift_card::create([
                'payment_id' => $payment->id, //is it card id?
                'gift_card_id' => $request->gift_card_id,
            ]);

            $giftcard = Giftcard::Find($request->gift_card_id);
            $giftcard->expense = $giftcard->expense + $request->paid_amount;
            $giftcard->save();
        }

        $due = 0;
        if ($request->grand_total > $request->paid_amount) {
            $due = $request->grand_total - $request->paid_amount;
        }
        if ($request->grand_total > $request->paid_amount) {
            $due = $request->grand_total - $request->paid_amount;
        }
        $invoice = [
            'customer_name' => $customer->name,
            'customer_address' => $customer->address,
            'invoice_id' => mt_rand(00000, 99999), ///should be random
            'date' => date("Y/m/d"),
            'purchased' => $purchased,
            'sub_total' => $request->total_price,
            'order_tax_rate' => $request->order_tax_rate,
            'order_tax' => $request->order_tax,
            'discount' => $request->order_discount,
            'coupon_discount' => $request->coupon_discount,
            'shipping_cost' => $request->shipping_cost,
            'grand_total' => $request->grand_total,
            'paid_amount' => $request->paying_amount,
            'balance_due' => $due,
            'change' => $request->change,
        ];
        /* dd($invoice); */
        return view('admin.pos.invoice', ['invoice' => $invoice]);
    }

    public function getGiftCard(Request $request)
    {
        $giftcard = Giftcard::where('customer_id', $request->customer_id)
            ->get();
        return response()->json($giftcard);
    }


    public function deleteDraft(Request $request)
    {
        $draft = Draft::Find($request->draft_id);
        $product_sales = Product_sale::where('sale_id', $draft->sale_id)->get();
        Product_sale::where('sale_id', $draft->sale_id)->delete();
        Sale::destroy($draft->sale_id);
        $draft->delete();
        return redirect()->route('admin.pos');
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