@extends('layout.master') @push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="backend/js/custom-default.css" type="text/css" id="custom-style">
@endpush
@section('content')
    <div class="row">

        <!-- product list -->
        <div class="col-md-7">
            <div class="filter-window">
                <div class="category mt-3">
                    <div class="row ml-2 mr-2 px-2">
                        <div class="col-7">Choose category</div>
                        <div class="col-5 text-right">
                            <span class="btn btn-default btn-sm">
                                <i class="dripicons-cross"></i>
                            </span>
                        </div>
                    </div>
                    <div class="row ml-2 mt-3">
                        @foreach ($all_categories as $categories)
                            <div class="col-md-3 category-img text-center" data-category={{ $categories->id }}>
                                <img src='#' />
                                <p class="text-center">{{ $categories->category_name }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="brand mt-3">
                    <div class="row ml-2 mr-2 px-2">
                        <div class="col-7">Choose brand</div>
                        <div class="col-5 text-right">
                            <span class="btn btn-default btn-sm">
                                <i class="dripicons-cross"></i>
                            </span>
                        </div>
                    </div>
                    <div class="row ml-2 mt-3">
                        @foreach ($all_brands as $brand)
                            <div class="col-md-3 brand-img text-center" data-brand={{ $brand->id }}>
                                <img src='#' />
                                <p class="text-center">{{ $brand->name }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-block btn-primary" id="category-filter">Category</button>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-block btn-info" id="brand-filter">Brand</button>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-block btn-danger" id="featured-filter">Featured</button>
                </div>
                <div class="col-md-12 mt-1 table-container">
                    <div class="card h-100">
                        <div class="card-body">
                            <table id="product-table" class="table no-shadow product-list">
                                <thead class="d-none">
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_product->chunk(5) as $chunked_product)
                                        <tr>
                                            @foreach ($chunked_product as $product)
                                                <td class="product-img sound-btn" title="{{ $product->name }}"
                                                    data-product="{{ $product->id }}">
                                                    <img src="uploads/product/image/{{ $product->image }}"
                                                        width="100%" />
                                                    <p>{{ $product->name }}</p>
                                                    <span>{{ $product->barcode_symbology }}</span>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card h-100">
                <div class="card-body" style="padding-bottom: 0">
                    <form method="POST" action="/pos" accept-charset="UTF-8" class="payment-form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" required name="warehouse_id">
                                            <select id="warehouse_id" class=" form-control" data-live-search="true"
                                                data-live-search-style="begins" title="Select warehouse...">
                                                <option disabled selected>Choose Warehouse</option>
                                                @foreach ($all_warehouses as $warehouse)
                                                    <option value={{ $warehouse->id }}>{{ $warehouse->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" name="biller_id_hidden" value="1">
                                            <select required id="biller_id" name="biller_id" class=" form-control"
                                                data-live-search="true" data-live-search-style="begins"
                                                title="Select Biller...">
                                                <option disabled selected>Choose Biller</option>
                                                @foreach ($all_billers as $biller)
                                                    <option value={{ $biller->id }}>{{ $biller->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" name="customer_id_hidden" value="11">
                                            <div class="input-group pos">
                                                <select name="customer_id" id="customer_id" class=" form-control"
                                                    data-live-search="true" data-live-search-style="begins"
                                                    title="Select customer..." style="width: 100px">
                                                    <option disabled selected>Choose Customer</option>
                                                    @foreach ($all_customers as $customer)
                                                        <option value={{ $customer->id }}>{{ $customer->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                {{-- <label >search customer</label>
                                            <input required list="customers" name="customer_id" >
                                            <datalist id="customers">
                                                @foreach ($all_customers as $customer)
                                                <option value={{$customer->id}}>({{$customer->name}})</option>
                                                @endforeach
                                            </datalist> --}}
                                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                                    data-target="#addCustomer"><i class="dripicons-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="search-box form-group">
                                            {{-- <input type="text" name="product_code_name" id="lims_productcodeSearch" placeholder="Scan/Search product by name/code" class="form-control"  /> --}}
                                            <input type="text" name="product_code_name" id="filter"
                                                placeholder="Scan/Search product by name/code" class="form-control" />
                                            <select id='searched_product'>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="table-responsive transaction-list">
                                        <table id="myTable" class="table table-hover table-striped order-list table-fixed">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-2">Product</th>
                                                    <th class="col-sm-2">Price</th>
                                                    <th class="col-sm-4">Quantity</th>
                                                    <th class="col-sm-2">SubTotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row" style="display: none;">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_qty" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_discount" value="0.00" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_tax" value="0.00" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_price" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="item" />
                                            <input type="hidden" name="order_tax" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="grand_total" />
                                            <input type="hidden" name="sale_status" value="1" />
                                            <input type="hidden" name="coupon_active">
                                            <input type="hidden" name="coupon_id">
                                            <input type="hidden" name="coupon_discount" />
                                            <input type="hidden" name="pos" value="1" />
                                            <input type="hidden" name="draft" value="0" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 totals" style="border-top: 2px solid #e4e6fc; padding-top: 10px;">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <span class="totals-title">Items</span><span id="item">0</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="totals-title" style="width: 50%">Total</span><span id="subtotal"
                                                style="width: 50%">0.00</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="totals-title" style="width: 50%">Discount </span><input
                                                style="width: 50%" type="number" name="order_discount" id="discount"
                                                value=0.00 min='0.00'>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="totals-title" style="width: 50%">Coupon </span><input
                                                style="width: 50%" type="text" name="coupon-text" id="coupon-code">
                                        </div>
                                        <div class="col-sm-4 d-flex">
                                            <span class="totals-title">Tax </span>
                                            <input type="hidden" name="order_tax_rate">
                                            <select class="form-control" name="order_tax_rate_select"
                                                id="order_tax_rate_select" style="width: 80%">
                                                <option value="0">No Tax</option>
                                                <option value="10">vat@10</option>
                                                <option value="15">vat@15</option>
                                                <option value="20">vat 20</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="totals-title" style="width: 50%">Shipping </span><input
                                                style="width: 50%" type="number" name="shipping_cost" id="shipping-cost"
                                                value=0.00 min='0.00' width="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="payment-amount">
                    <h2>Grand Total <span id="grand-total">0.00</span></h2>
                </div>
                <div class="payment-options">
                    <div class="column-5">
                        <button style="background: #0984e3" type="button" class="btn btn-custom payment-btn"
                            data-toggle="modal" data-target="#add-payment" id="credit-card-btn"><i
                                class="fa fa-credit-card"></i> Card</button>
                    </div>
                    <div class="column-5">
                        <button style="background: #00cec9" type="button" class="btn btn-custom payment-btn"
                            data-toggle="modal" id="cash-btn" data-target="#add-payment"><i class="fa fa-money"></i>
                            Cash</button>
                    </div>
                    <div class="column-5">
                        <button style="background-color: #5f27cd" type="button" class="btn btn-custom payment-btn"
                            data-toggle="modal" id="gift-card-btn" data-target="#add-payment"><i
                                class="fa fa-credit-card-alt"></i> GiftCard</button>
                    </div>
                    {{-- <div class="column-5">
                    <button style="background-color: #213170" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="paypal-btn"><i class="fa fa-paypal"></i> Paypal</button>
                    </div> --}}
                    {{-- <div class="column-5">
                        <button style="background-color: #e28d02" type="button" class="btn btn-custom" id="draft-btn"><i
                                class="dripicons-flag"></i> Draft</button>
                    </div> --}}
                    {{-- <div class="column-5">
                    <button style="background-color: #fd7272" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="cheque-btn"><i class="fa fa-money"></i> Cheque</button>
                    </div> --}}
                    {{-- <div class="column-5">
                        <button style="background-color: #b33771" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="deposit-btn"><i class="fa fa-university"></i> Deposit</button>
                    </div> --}}
                    <div class="column-5">
                        <button style="background-color: #d63031;" type="button" class="btn btn-custom" id="cancel-btn"
                            onclick="return confirmCancel()"><i class="fa fa-close"></i> Cancel</button>
                    </div>
                    <div class="column-5">
                        <button style="background-color: #ffc107;" type="button" class="btn btn-custom" data-toggle="modal"
                            data-target="#recentTransaction"><i class="dripicons-clock"></i> Recent transaction</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- payment modal -->
        <div id="add-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
            class="modal fade text-left">
            <div role="document" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">Finalize Sale</h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6 mt-1">
                                        <label>Received Amount *</label>
                                        <input type="text" id='paying_amount' name="paying_amount"
                                            class="form-control numkey" required step="any">
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <label>Paying Amount *</label>
                                        <input type="text" id='paid_amount' name="paid_amount" class="form-control numkey"
                                            step="any">
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <label>Change : </label>
                                        <p id="change" class="ml-2">0.00</p>
                                        <input type="hidden" name="change" value=''>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <label>Paid By</label>
                                        <input type="text" id='paid_by' name="paid_by" value="" readonly>
                                        {{-- <select name="paid_by_id_select" class="form-control selectpicker">
    <option value="1">Cash</option>
    <option value="2">Gift Card</option>
    <option value="3">Credit Card</option>
    <option value="4">Cheque</option>
    <option value="5">Paypal</option>
    <option value="6">Deposit</option>
    </select> --}}
                                    </div>
                                    <div class="form-group col-md-12 mt-3">
                                        <div class="card-element form-control">
                                            <label> Credit Card *</label>
                                            <input type="number" id="credit_card_id" name="credit_card_id">
                                        </div>
                                        <div class="card-errors" role="alert"></div>
                                    </div>
                                    <div class="form-group col-md-12 gift-card">
                                        <label> Gift Card *</label>
                                        <input type="hidden" name="gift_card_id">
                                        <select id="gift_card_id_select" name="gift_card_id_select">
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 cheque">
                                        <label>Cheque Number *</label>
                                        <input type="text" name="cheque_no" class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Payment Note</label>
                                        <textarea id="payment_note" rows="2" class="form-control"
                                            name="payment_note"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Sale Note</label>
                                        <textarea rows="3" class="form-control" name="sale_note"></textarea>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Staff Note</label>
                                        <textarea rows="3" class="form-control" name="staff_note"></textarea>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button id="submit-btn" type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <div class="col-md-2 qc" data-initial="1">
                                <h4><strong>Quick Cash</strong></h4>
                                <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="10"
                                    type="button">10</button>
                                <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="20"
                                    type="button">20</button>
                                <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="50"
                                    type="button">50</button>
                                <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="100"
                                    type="button">100</button>
                                <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="500"
                                    type="button">500</button>
                                <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="1000"
                                    type="button">1000</button>
                                <button class="btn btn-block btn-danger qc-btn sound-btn" data-amount="0"
                                    type="button">Clear</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- product edit modal -->
        <div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
            class="modal fade text-left">
            <div role="document" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="modal_header" class="modal-title"></h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" name="edit_qty" class="form-control numkey">
                            </div>
                            <div class="form-group">
                                <label>Unit Discount</label>
                                <input type="text" name="edit_discount" class="form-control numkey">
                            </div>
                            <div class="form-group">
                                <label>Unit Price</label>
                                <input type="text" name="edit_unit_price" class="form-control numkey" step="any">
                            </div>
                            <div class="form-group">
                                <label>Tax Rate</label>
                                <select name="edit_tax_rate" class="form-control selectpicker">
                                    <option value="0">No Tax</option>
                                    <option value="1">vat@10</option>
                                    <option value="2">vat@15</option>
                                    <option value="3">vat 20</option>
                                    <option value="4">fdg</option>
                                </select>
                            </div>
                            <div id="edit_unit" class="form-group">
                                <label>Product Unit</label>
                                <select name="edit_unit" class="form-control selectpicker">
                                </select>
                            </div>
                            <button type="button" name="update_btn" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- add customer modal -->
        <div id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
            class="modal fade text-left">
            <div role="document" class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('pos.addCustomer') }}" accept-charset="UTF-8"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">Add Customer</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                    aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                        </div>
                        <div class="modal-body">
                            <p class="italic"><small>The field labels marked with * are required input fields.</small></p>
                            {{-- <div class="form-group">
                            <label>Customer Group *</strong> </label>
                            <select required class="form-control selectpicker" name="customer_group_id">
                                <option value="1">general</option>
                                <option value="2">distributor</option>
                                <option value="3">reseller</option>
                            </select>
                        </div> --}}
                            <div class="form-group">
                                <label>Name *</strong> </label>
                                <input type="text" name="name" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>company_name</label>
                                <input type="text" name="company_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" placeholder="example@example.com" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Phone Number *</label>
                                <input type="text" name="phone_number" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>a_tax *</label>
                                <input type="text" name="a_tax" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Address *</label>
                                <input type="text" name="address" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>state *</label>
                                <input type="text" name="state" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>postal_code *</label>
                                <input type="text" name="postal_code" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>City *</label>
                                <input type="text" name="city" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>country *</label>
                                <input type="text" name="country" required class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Submit" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- recent transaction modal -->
        <div id="recentTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
            class="modal fade text-left">
            <div role="document" class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">
                            Recent Transaction
                            <div class="badge badge-primary">Latest 10</div>
                        </h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#sale-latest" role="tab" data-toggle="tab">Sale</a>
                            </li>
                            {{-- <li class="nav-item">
                            <a class="nav-link" href="#draft-latest" role="tab" data-toggle="tab">Draft</a>
                        </li> --}}
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane show active" id="sale-latest">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Reference</th>
                                                <th>Customer</th>
                                                <th>Grand Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sales as $sale)
                                                <tr>
                                                    <td>{{ $sale->created_at }}</td>
                                                    <td>{{ $sale->reference_no }}</td>
                                                    <td>{{ $sale->cutomer_name }}</td>
                                                    <td>{{ $sale->grand_total }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="draft-latest">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Reference</th>
                                                <th>Customer</th>
                                                <th>Grand Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($drafts as $draft)
                                                <tr>
                                                    <td>{{ $draft->created_at }}</td>
                                                    <td>{{ $draft->reference }}</td>
                                                    <td>{{ $draft->customer_name }}</td>
                                                    <td>{{ $draft->grand_total }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="#" class="btn btn-success btn-sm" title="Edit"><i
                                                                    class="dripicons-document-edit"></i></a>&nbsp;
                                                            <form method="POST" action="/pos/deletDraft"
                                                                accept-charset="UTF-8">
                                                                @csrf
                                                                <input type="hidden" name="draft_id"
                                                                    value='{{ $draft->id }}'>
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirmDelete()" title="Delete"><i
                                                                        class="dripicons-trash"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @endsection @push('plugin-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js">
        < script src = "{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}" >

    </script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
@endpush
@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/js/inputmask.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/js/tags-input.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-colorpicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/timepicker.js') }}"></script>
    <script src="{{ asset('backend/js/pos.js') }}"></script>
@endpush
