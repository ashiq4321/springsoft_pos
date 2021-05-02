@extends('layout.master')
@section('title')
    POS || Inventory
@endsection
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css
                                                                                                                                                                                                                                                                                                                                                    ">
    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css
                                                                                                                                                                                                                                                                                                                                                    ">
    <link rel="stylesheet"
        href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css
                                                                                                                                                                                                                                                                                                                                                    ">
    <style>
        .ui-menu-item-wrapper {
            background-color: blue;

        }

        .ui-menu-item {
            list-style-type: none;
        }

    </style>
@endpush
@section('content')
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4>product Purchase</h4>
                        </div>
                        <div class="card-body">
                            <p class="font-italic text-muted"><small>The field labels marked with * are required input
                                    fields.</small></p>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" enctype="multipart/form-data" id="addProductCategoryFrom">
                                        <div class="row">

                                            <div class="col-md-6 form-group">
                                                <label>Warehouse *</label><br>
                                                <select class="selectpicker" data-live-search="true" name="warehouse_id"
                                                    id="warehouse_id" searchable="Search here..">
                                                    <option value="" disabled selected>Select Warehouse...</option>

                                                    @foreach ($all_warehouse as $warehouse)
                                                        <option value="{{ $warehouse->id }}" @if ($data->warehouse_id == $warehouse->id) {{ 'selected="selected"' }} @endif>
                                                            {{ $warehouse->name }} </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Supplier</label>
                                                <select class="mdb-select md-form" name="supplier_id" id="supplier_id"
                                                    searchable="Search here..">
                                                    <option value="" disabled selected>Select supplier...</option>
                                                    @foreach ($all_supplier as $supplier)
                                                        <option value="{{ $supplier->id }}" @if ($data->supplier_id == $supplier->id) {{ 'selected="selected"' }} @endif>
                                                            {{ $supplier->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>Purchase status</label>
                                                <select id="partial" class="mdb-select md-form" name="status"
                                                    searchable="Search here..">

                                                    <option {{ $data->status == '0' ? 'selected' : '' }} value="0">
                                                        Received</option>
                                                    <option {{ $data->status == '1' ? 'selected' : '' }} value="1">
                                                        Partial</option>
                                                    <option {{ $data->status == '2' ? 'selected' : '' }} value="2">
                                                        Pending</option>
                                                    <option {{ $data->status == '3' ? 'selected' : '' }} value="3">
                                                        Ordered</option>

                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Attach Document</label> <i class="dripicons-question"
                                                        data-toggle="tooltip"
                                                        title="Only jpg, jpeg, png, gif, pdf, csv, docx, xlsx and txt file is supported"></i>
                                                    <input type="file" name="document" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label>Select Product</label>
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-md btn-secondary rounded-0"><i
                                                            class="fa fa-barcode"></i></button>
                                                    <input class="form-control" type="text" onkeyup="search()"
                                                        name="productcodeSearch" id="productcodeSearch"
                                                        placeholder="Please type product code and select..." />
                                                </div>
                                                <input type="hidden"
                                                    class="bg-primary  text-normal text-light text-capitalize"
                                                    style="margin-left:40px; margin-right:auto;" id="show">
                                                <input id="result" type="hidden" type="text">
                                            </div>
                                        </div>




                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <h5>Order Table *</h5>
                                                <div class="table-responsive mt-3">
                                                    <table id="myTable" class="table table-hover order-list">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Code</th>
                                                                <th>Quantity</th>
                                                                @if ($data->status == 1)
                                                                    <th id="recieved"
                                                                        style="display:
                                                                                                                                                                block">
                                                                        Received
                                                                    </th>
                                                                @else
                                                                    <th id="recieved" style="display: none;">Received</th>
                                                                @endif



                                                                <th>Net Unit Cost</th>
                                                                <th>Discount</th>
                                                                <th>Tax</th>
                                                                <th>SubTotal</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id='each_product'>

                                                            @for ($i = 0; $i < $count_product; $i++)
                                                                <tr>
                                                                    <input type='hidden' min='1' name='p_id[]'
                                                                        value='{{ $product_purchase[$i]->product_id }}'
                                                                        class='r'>
                                                                    <td>{{ $product_purchase[$i]->product->name }}
                                                                    </td>
                                                                    <td>{{ $product_purchase[$i]->product->barcode_symbology }}
                                                                    </td>
                                                                    <td><input type='number' min='1' name='qty[]'
                                                                            value='{{ $product_purchase[$i]->qty }}'
                                                                            class='qty'></td>

                                                                    @if ($data->status == 1)
                                                                        <td class='receive' style="display: block"><input
                                                                                type=' number' name='received[]'
                                                                                class='receive'
                                                                                value='{{ $product_purchase[$i]->received }}' />
                                                                        </td>
                                                                    @else
                                                                        <td class='receive' style="display: none;"><input
                                                                                type=' number' name='received[]'
                                                                                class='receive'
                                                                                value='{{ $product_purchase[$i]->received }}' />
                                                                        </td>
                                                                    @endif
                                                                    <td class='receive' style='display: none'><input
                                                                            type=' number' name='received[]' class='receive'
                                                                            value='{{ $product_purchase[$i]->received }}' />
                                                                    </td>


                                                                    <td><input readonly type='number'
                                                                            class='unit_rate no-border' name='net_u_c[]'
                                                                            value='{{ $product_purchase[$i]->net_unit_cost }}' />
                                                                    </td>
                                                                    <td><input readonly type='number'
                                                                            class='discount no-border' name='dus[]'
                                                                            value='{{ $product_purchase[$i]->discount }}' />
                                                                    </td>
                                                                    <td><input readonly type='number' class='tax no-border'
                                                                            name='tx[]'
                                                                            value='{{ $product_purchase[$i]->tax }}' />
                                                                    </td>
                                                                    <td><input readonly type='number'
                                                                            class='sub-total no-border'
                                                                            value='{{ $product_purchase[$i]->total }}' />
                                                                    </td>
                                                                    <td><button type='button'
                                                                            class='btn btn-danger delete'>Delete</button>
                                                                    </td>
                                                                </tr>
                                                            @endfor

                                                        </tbody>
                                                        <tfoot class="tfoot active">
                                                            <th colspan="2">Total</th>
                                                            <th id="total-qty">0</th>
                                                            <th class="received" style="display: none;" id="r_received">0
                                                            </th>
                                                            <th></th>
                                                            <th id="total-discount">0.00</th>
                                                            <th id="total-tax">0.00</th>
                                                            <th id="total">0.00</th>
                                                            <th><i class="dripicons-trash"></i></th>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="hidden" name="total_qty" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="hidden" name="total_discount" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="hidden" name="total_tax" />
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
                                                    <input type="hidden" name="pos" value="0" />
                                                    <input type="hidden" name="coupon_active" value="0" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Order Tax</label>
                                                    <select class="form-control" name="order_tax_rate">

                                                        <option {{ $data->order_tax_rate == '0' ? 'selected' : '' }}
                                                            value="0">
                                                            NoTax</option>
                                                        <option {{ $data->order_tax_rate == '10' ? 'selected' : '' }}
                                                            value="10">
                                                            vat@10</option>
                                                        <option {{ $data->order_tax_rate == '15' ? 'selected' : '' }}
                                                            value="15">
                                                            vat@15</option>
                                                        <option {{ $data->order_tax_rate == '20' ? 'selected' : '' }}
                                                            value="20">
                                                            vat 20</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>
                                                        <strong>Order Discount</strong>
                                                    </label>
                                                    <input type="number" name="order_discount" class="form-control"
                                                        step="any" value="{{ $data->order_discount }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>
                                                        <strong>Shipping Cost</strong>
                                                    </label>
                                                    <input type="number" name="shipping_cost" class="form-control"
                                                        step="any" value="{{ $data->shipping_cost }}" />
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="row">
<div class="col-md-4">
<div class="form-group">
<label>Attach Document</label> <i class="dripicons-question"
data-toggle="tooltip"
title="Only jpg, jpeg, png, gif, pdf, csv, docx, xlsx and txt file is supported"></i>
<input type="file" name="document" class="form-control" />
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Sale Status *</label>
<select name="sale_status" class="form-control">
<option value="1">Completed</option>
<option value="2">Pending</option>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Payment Status *</label>
<select name="payment_status" class="form-control">
<option value="1">Pending</option>
<option value="2">Due</option>
<option value="3">Partial</option>
<option value="4">Paid</option>
</select>
</div>
</div>
</div>
<div id="payment">
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label>Paid By</label>
<select name="paid_by_id" class="form-control">
    <option value="1">Cash</option>
    <option value="2">Gift Card</option>
    <option value="3">Credit Card</option>
    <option value="4">Cheque</option>

</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Received Amount *</label>
<input type="number" name="paying_amount" class="form-control"
    id="paying-amount" step="any" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Paying Amount *</label>
<input type="number" name="paid_amount" class="form-control"
    id="paid-amount" step="any" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Change</label>
<p id="change" class="ml-2">0.00</p>
</div>
</div>
</div>
<div class="row mt-2">
<div class="col-md-12">
<div class="form-group">
<div class="card-element" class="form-control">
</div>
<div class="card-errors" role="alert"></div>
</div>
</div>
</div>
<div class="row" id="gift-card">
<div class="col-md-6">
<div class="form-group">
<label> Gift Card *</label>
<select id="gift_card_id" name="gift_card_id"
    class="selectpicker form-control" data-live-search="true"
    data-live-search-style="begins"
    title="Select Gift Card..."></select>
</div>
</div>
</div>
<div class="row" id="cheque">
<div class="col-md-12">
<div class="form-group">
<label>Cheque Number *</label>
<input type="text" name="cheque_no" class="form-control">
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<label>Payment Note</label>
<textarea rows="3" class="form-control" name="payment_note"></textarea>
</div>
</div>
</div> --}}
                                        <div class=" row mt-2">
                                            {{-- <div class="col-md-6">
<div class="form-group">
<label>Sale Note</label>
<textarea rows="5" class="form-control" name="sale_note"></textarea>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Staff Note</label>
<textarea rows="5" class="form-control" name="staff_note"></textarea>
</div>
</div> --}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Note</label>
                                                    <textarea rows="5" class="form-control"
                                                        name="note">{{ $data->note }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="total_cost" id="total_cost" value="">
                                        <input type="hidden" name="grand_total" id="grand_total" value="">

                                        <div class="form-group">
                                            <input type="submit" value="Submit" class="btn btn-sm btn-info"
                                                id="submit-button">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <table class="table table-bordered table-condensed totals">

                <td><strong>Items</strong>
                    <span class="pull-right" id="item">0.00</span>
                </td>
                <td><strong>Total</strong>
                    <span class="pull-right" id="subtotal">{{ $data->total_cost }}</span>
                </td>
                <td><strong>Order Tax</strong>
                    <span class="pull-right" id="order_tax">{{ $data->total_tax }}</span>
                </td>
                <td><strong>Order Discount</strong>
                    <span class="pull-right" id="order_discount">{{ $data->order_discount }}</span>
                </td>
                <td><strong>Shipping Cost</strong>
                    <span class="pull-right" id="shipping_cost">{{ $data->shipping_cost }}</span>
                </td>
                <td><strong>Grand Total</strong>
                    <span class="pull-right grand_total"> {{ $data->grand_total }}</span>
                </td>


            </table>

            <style>
                .no-border {
                    border: 0;
                    box-shadow: none;
                    width: 150%;
                }

            </style>


        </div>

        </form>






        <script>
            $('#productcodeSearch').on('input', function() {
                //    var customer_id = $('#customer_id').val();
                temp_data = $('#productcodeSearch').val();
                var warehouse = $('#warehouse_id').val();
                var supplier = $('#supplier_id').val();


                if (!warehouse) {
                    $('#productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                    swal("Warning !!!", "Please select Warehouse!", "warning");
                }
                if (!supplier) {
                    $('#productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                    swal("Warning !!!", "Please select Supplier!", "warning");
                }

            });
            calculateTotal();

            $('body').on('change', '#partial', function() {
                alert("partial");
                // $('#partial').change(function() { //on change of dropdown
                if ($(this).val() === "1") // check if dropdown value is other
                {
                    $("#received").css("display", "block");
                    $(".receive").show();
                    $("#r_received").show();

                } else {
                    $('.receive').hide();
                    $('#r_received').hide();
                    $("#received").css("display", "none");

                }
            });

            function search() {


                $("#productcodeSearch").autocomplete({

                    source: function(request, response) {
                        $.ajax({
                            url: '/search',
                            type: 'post',
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                search: request.term
                            },
                            success: function(data) {
                                response(data);
                                console.log(data);
                            }
                        });
                    },
                    select: function(event, ui) {
                        $('#productcodeSearch').val(ui.item.label); // display the selected text
                        $('#result').val(ui.item.value);
                        return false;
                    }
                });


            }

            function hello() {
                console.log("MMMMMMMMMMMMMMMMMMMMM");
            }


            var selected_product = []
            $(document).bind('click keyup', '#productcodeSearch', function() {

                if (!selected_product.includes($('#result').val())) {
                    selected_product.push($('#result').val());
                    var id;
                    $.ajax({
                        url: '/find/' + $('#result').val(),
                        method: 'GET',


                        success: function(data) {
                            var flag = 1;
                            $(".r").each(function() {
                                if ($(this).val() == data.product[
                                        'id']) {
                                    swal("Warning!", "Dupplicate Product Not Allowed!",
                                        "warning");
                                    //alert('Duplicate input is not allowed!')
                                    flag = 0;
                                }
                            });
                            if (flag) {
                                console.log(data);
                                var discount = 0.0;
                                var tax = (data.product['price'] * (data.product['tax_id'] / 100));
                                var row = ""
                                row = row + "<tr>"
                                row = row + "<td>" + data.product['name'] +
                                    " <input type='hidden' min='1' name='p_id[]' value='" + data
                                    .product[
                                        'id'] + "' class='r'></td>"
                                //          row = row + "<td>"+data.product['name']+"</td>"
                                row = row + "<td >" + data.product['barcode_symbology'] + "</td>"
                                row = row +
                                    "<td><input type='number' min='1' name='qty[]' value='1' class='qty'></td>"
                                row = row +
                                    "<td class='receive' style='display: none;'><input type='number' name='received[]' class='receive' /></td>"

                                row = row +
                                    "<td><input  readonly type='number'class='unit_rate no-border' name='net_u_c[]' value='" +
                                    data.product['price'] + "'/></td>"
                                row = row +
                                    "<td><input  readonly type='number'class='discount no-border' name='dus[]' value='" +
                                    discount + "'/></td>"
                                row = row +
                                    "<td><input  readonly type='number'class='tax no-border'name='tx[]' value='" +
                                    (1 * tax) + "'/></td>"
                                row = row +
                                    "<td><input readonly name='sub_totalPrice[]' type='number' class='sub-total no-border' /></td>" //{qty}*{unit_rate}+{tax}-{disc}
                                row = row +
                                    "<td><button type='button' class='btn btn-danger delete'>Delete</button></td>"
                                row = row + "</tr>"

                                $('#each_product').append(row);
                                $('#productcodeSearch').val('');
                                $('#result').val('');
                                calculateTotal();
                            }
                        }






                    })


                }
            });



            //Delete product
            $("table.order-list tbody").on("click", ".delete", function(event) {
                var index = $(this).closest('tr').index();
                $(this).closest("tr").remove();
                selected_product.length = index;
                selected_product.splice(selected_product.index)
                calculateTotal();
            });


            $(document).bind('click keyup', '#each_product', function() {
                $('tr').each(function() {
                    var unit_rate = parseInt($(this).find('.unit_rate').val())
                    var discount = parseInt($(this).find('.discount').val())
                    var tax = parseInt($(this).find('.tax').val())
                    var qty = parseInt($(this).find('.qty').val())
                    //$(this).find('.tax').val(tax * qty);
                    $(this).find('.sub-total').val(qty * unit_rate + tax - discount);
                });
                calculateTotal();
            });

            function calculateTotal() {
                //Sum of quantity
                var total_qty = 0;
                $(".qty").each(function() {
                    if ($(this).val() == '') {
                        total_qty += 1;
                    } else {
                        total_qty += parseFloat($(this).val());
                    }
                });
                var total_receive = 0;
                $(".receive").each(function() {
                    if ($(this).val() == '') {
                        total_receive += 0;
                    } else {
                        total_receive += parseFloat($(this).val());
                    }
                });
                $("#total-qty").text(total_qty);
                $('input[name="total_qty"]').val(total_qty);
                $("#r_received").text(total_receive);
                $('input[name="r_received"]').val(total_receive);

                //Sum of discount
                var total_discount = 0;
                $(".discount").each(function() {
                    total_discount += parseFloat($(this).val());
                });
                $("#total-discount").text(total_discount.toFixed(2));
                $('input[name="total_discount"]').val(total_discount.toFixed(2));

                //Sum of tax
                var total_tax = 0;
                $(".tax").each(function() {
                    total_tax += parseFloat($(this).val());
                });
                $("#total-tax").text(total_tax.toFixed(2));
                $('input[name="total_tax"]').val(total_tax.toFixed(2));

                //Sum of subtotal
                var total = 0;
                $(".sub-total").each(function() {
                    total += parseFloat($(this).val());
                });
                $("#total").text(total.toFixed(2));
                $("#total_cost").val(total.toFixed(2));

                calculateGrandTotal();
            }

            function calculateGrandTotal() {

                var item = $('table.order-list tbody tr:last').index();

                var total_qty = parseFloat($('#total-qty').text());
                var subtotal = parseFloat($('#total').text());
                var order_tax = parseFloat($('select[name="order_tax_rate"]').val());
                var order_discount = parseFloat($('input[name="order_discount"]').val());
                var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());
                var receive_amount = parseFloat($('input[name="paying_amount"]').val());


                if (!order_discount)
                    order_discount = 0.00;
                if (!shipping_cost)
                    shipping_cost = 0.00;
                if (!shipping_cost)
                    shipping_cost = 0.00;

                item = ++item + '(' + total_qty + ')';
                order_tax = (subtotal - order_discount) * (order_tax / 100);
                var grand_total = (subtotal + order_tax + shipping_cost) - order_discount;

                var change_amount = (receive_amount - grand_total);

                $('#item').text(item);
                $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);
                $('#subtotal').text(subtotal.toFixed(2));
                $('#order_tax').text(order_tax.toFixed(2));
                $('#order_discount').text(order_discount);
                $('#shipping_cost').text(shipping_cost.toFixed(2));

                $('#grand_total').val(grand_total.toFixed(2)); // hidden input value
                $('.grand_total').text(grand_total.toFixed(2));

                $('input[name="paid_amount"]').val(grand_total.toFixed(2));
                $('#change').text(change_amount.toFixed(2));

            }
            $("#payment").hide();
            $(".card-element").hide();
            $("#gift-card").hide();
            $("#cheque").hide();

            $('select[name="payment_status"]').on("change", function() {
                var payment_status = $(this).val();
                if (payment_status == 3 || payment_status == 4) {
                    $("#paid-amount").prop('disabled', false);
                    $("#payment").show();
                    $("#paying-amount").prop('required', true);
                    $("#paid-amount").prop('required', true);
                    if (payment_status == 4) {
                        $("#paid-amount").prop('disabled', true);
                        $('input[name="paying_amount"]').val($('input[name="grand_total"]').val());
                        $('input[name="paid_amount"]').val($('input[name="grand_total"]').val());
                    }
                } else {
                    $("#paying-amount").prop('required', false);
                    $("#paid-amount").prop('required', false);
                    $('input[name="paying_amount"]').val('');
                    $('input[name="paid_amount"]').val('');
                    $("#payment").hide();
                }
            });

            $('#addProductCategoryFrom').on('submit', function(event) {
                // alert("HGhghcghdf");
                // console.log("BBBBBBBBBBBBBBBBB");
                event.preventDefault();
                // alert("DDDDDDDDDDDDDDDDDDD");
                // console.log("BBBBBBBBBBBBBBBBB")
                var formData = new FormData(this);
                var id = {{ $data->id }};
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/update-Purchase/ ' + id,
                    method: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        console.log("datadata*****************************");
                        console.log(data);
                        console.log(data);
                        swal("Updated!", "Data has been Successfully Updated!", "success");

                        window.location.href = "/admin/purchaseList";

                        //alert(data.id);
                    },
                    error: function(data) {
                        console.log(data);
                        swal("Warning!", "All The Field is required!", "warning");

                    }
                })
            });

        </script>

        <script>
            $("#productcodeSearch").keyup(function() {

                //if ($('#warehouse_id option:selected').get().length>0) {
                //    alert('no Warehouse is selected');
                //}
            });

        </script>
        <script>
            function myFunction(id) {
                console.log(id);
                var qty = parseFloat($("#quenty" + id).val());
                console.log("Value is " + qty);
                var qty1 = parseFloat($("#quenty1" + id).val());
                console.log("Value is " + qty1);
                var qty2 = parseFloat($("#quenty2" + id).val());
                console.log("Value is " + qty2);
                var qty3 = (qty + qty2);
                var qty4 = (qty1 - qty2);
                if (qty3 > qty1) {
                    swal("Alert!!!", "You Cannot take more then " + qty4 + " Product!!!")
                    $("#quenty" + id).val('');
                }
            }

        </script>
    @endsection
    @push('plugin-scripts')
        <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
            integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    @endpush
    @push('custom-scripts')
        <script src="{{ asset('assets/js/data-table.js') }}"></script>
    @endpush
