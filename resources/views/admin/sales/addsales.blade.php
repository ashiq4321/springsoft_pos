@extends('layout.master')
@section('title')
    POS || Inventory
@endsection
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css
                    ">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css
                    ">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css
                    ">

@endpush
@section('content')
    <section class="forms">
        <div class="container-fluid">
            <form action="{{ route('payment') }}" method="POST">

                {{-- @if (Session::get('success'))
    <div class="alert alert-success">
       {{ Session::get('success') }}
    </div>
  @endif

  @if (Session::get('fail'))
    <div class="alert alert-danger">
       {{ Session::get('fail') }}
    </div>
  @endif --}}
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4>Add Sale</h4>
                            </div>
                            <div class="card-body">
                                <p class="font-italic text-muted"><small>The field labels marked with * are required input
                                        fields.</small></p>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Customer *</label>
                                                    <select required name="customer_id" id="customer_id"
                                                        class="selectpicker form-control" data-live-search="true"
                                                        data-live-search-style="begins">
                                                        <option selected disabled>Select Customer</option>
                                                        @foreach ($customer as $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger">@error('customer_id'){{ $message }}
                                                        @enderror</span>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Warehouse *</label>
                                                    <select required name="warehouse_id" id="warehouse_id"
                                                        class="selectpicker form-control" data-live-search="true"
                                                        data-live-search-style="begins">
                                                        <option selected disabled>Select Warehouse</option>
                                                        @foreach ($warehouse as $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger">@error('warehouse_id'){{ $message }}
                                                        @enderror</span>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Biller *</label>
                                                    <select required name="biller_id" id="biller_id"
                                                        class="selectpicker form-control" data-live-search="true"
                                                        data-live-search-style="begins" title="Select Biller...">
                                                        <option selected disabled>Select Biller</option>
                                                        @foreach ($biller as $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                        @endforeach
                                                    </select>
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
                                                        placeholder="Please type product code or name and select..." />
                                                </div>
                                                <input id="result" type="hidden" type="text">
                                                <input id="war" type="hidden" type="text">


                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <h5>Order Table *</h5>
                                                <div class="table-responsive-md mt-3">
                                                    <table id="myTable" class="table table-hover order-list">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Code</th>
                                                                <th>Quantity</th>
                                                                <th>Net Unit Price</th>
                                                                <th>Discount</th>
                                                                <th>Tax</th>
                                                                <th>SubTotal</th>
                                                                <th><i data-feather="trash"></i></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="each_product">

                                                        </tbody>



                                                        <tfoot class="tfoot active">
                                                            <th colspan="2">Total</th>
                                                            <th id="total-qty">0</th>
                                                            <th></th>
                                                            <th id="total-discount">0.00</th>
                                                            <th id="total-tax">0.00</th>
                                                            <th id="total">0.00</th>
                                                            <th><i data-feather="trash"></i></th>
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
                                                    <input type="hidden" name="total_cost" />
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
                                                        <option value="0">No Tax</option>
                                                        <option value="10">vat@10</option>
                                                        <option value="15">vat@15</option>
                                                        <option value="20">vat 20</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>
                                                        <strong>Order Discount</strong>
                                                    </label>
                                                    <input type="number" name="order_discount" class="form-control"
                                                        step="any" />

                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>
                                                        <strong>Shipping Cost</strong>
                                                    </label>
                                                    <input type="number" name="shipping_cost" class="form-control"
                                                        step="any" />

                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
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
                                                    <label required>Sale Status *</label>
                                                    <select name="sale_status" class="form-control">
                                                        <option value="1"> Completed</option>
                                                        <option value="2">Pending</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Payment Status *</label>
                                                    <select name="payment_status" class="form-control">
                                                        <option value="0">Draft</option>
                                                        <option value="1">Paid</option>
                                                        <option value="2">Due</option>
                                                        <option value="3">Partial</option>
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
                                                        <input type="number" id="change" name="change" readonly value=""
                                                            class="ml-2 no-border">
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
                                                        <select onclick="giftCard()" id="gift_card_id" name="gift_card_id"
                                                            class=" form-control" data-live-search="true"
                                                            data-live-search-style="begins">
                                                            <option selected disabled>Select Card</option>
                                                            {{-- @foreach ($giftcard as $row)
@if ($row->expired_date >= date('Y-m-d'))
<option value="{{ $row->id }}">{{round ($row->amount - $row->expense)}}</option>
@endif
@endforeach --}}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" id="cheque">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Cheque Number *</label>
                                                        <input type="text" id="cheque" name="cheque_no"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" id="card">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Card Number *</label>
                                                        <input type="text" id="card" name="card_no" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Payment Note</label>
                                                    <textarea rows="3" class="form-control" name="payment_note"></textarea>
                                              
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Sale Note</label>
                                                    <textarea rows="5" class="form-control" name="sale_note"></textarea>
                                                    <span class="text-danger">@error('sale_note'){{ $message }}  @enderror</span>

                                                </div>
                                                
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Staff Note</label>
                                                    <textarea rows="5" class="form-control" name="staff_note"></textarea>
                                                    <span class="text-danger">@error('staff_note'){{ $message }}  @enderror</span>

                                                </div>
                                            </div>
                                        </div>
            </form>
            <div class="form-group">
                <input type="submit" value="Submit" class="btn btn-sm btn-primary" id="submit-button">
            </div>

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
                    <span class="pull-right" id="subtotal">0.00</span>
                </td>
                <td><strong>Order Tax</strong>
                    <span class="pull-right" id="order_tax">0.00</span>
                </td>
                <td><strong>Order Discount</strong>
                    <span class="pull-right" id="order_discount">0.00</span>
                </td>
                <td><strong>Shipping Cost</strong>
                    <span class="pull-right" id="shipping_cost">0.00</span>
                </td>
                <td><strong>Grand Total</strong>
                    <span class="pull-right" id="grand_total">0.00</span>
                    <input type="hidden" id="da">
                </td>
            </table>
            <style>
                .no-border {
                    border: 0;
                    box-shadow: none;
                    width: 150%;
                }

                .ui-menu-item {
                    background-color: #727cf5;

                    color: aliceblue;
                    margin-right: 412px;
                }

            </style>


        </div>


        <script>
            var gift_card_amount = [];
            var gift_card_expense = [];

            $('#productcodeSearch').on('input', function() {
                var customer_id = $('#customer_id').val();
                var warehouse_id = $('#warehouse_id').val();
                temp_data = $('#productcodeSearch').val();
                if (!customer_id) {
                    $('#productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                    alert('Please select Customer!');
                } else if (!warehouse_id) {
                    $('#productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                    alert('Please select Warehouse!');
                }

            });


            function search() {
                $("#productcodeSearch").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "/search",
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


            var selected_product = new Array
            $(document).bind('click keyup', '#productcodeSearch', function() {

                if (!selected_product.includes($('#result').val())) {
                    selected_product.push($('#result').val());
                    var product_id = $('#result').val();
                    find_in_warehouse(product_id);
                    $.ajax({
                        url: '/find/' + $('#result').val(),
                        method: 'GET',
                        success: function(data) {
                            console.log(data);
                            var discount = 10.00;
                            var tax = 32.00;
                            var row = ""
                            row = row + "<tr>"
                            row = row + "<td>" + data.product['name'] + "</td>"
                            row = row + "<td >" + data.product['barcode_symbology'] + "</td>"
                            row = row +
                                "<td><input type='number' min='1' value='1'   name='qty[]' class='qty'></td>"
                            row = row +
                                "<td><input  readonly type='number'class='unit_rate no-border' value='" +
                                data.product['price'] + "'/></td>"
                            row = row +
                                "<td><input  readonly type='number'class='discount no-border' value='" +
                                discount + "'/></td>"
                            row = row +
                                "<td><input  readonly type='number'class='tax no-border' value='" +
                                tax + "'/></td>"
                            row = row +
                                "<td><input  readonly type='number' name='subtotal[]' class='sub-total  no-border' value='" +
                                (1 * data.product['price'] + tax - discount) +
                                "'/></td>" //{qty}*{unit_rate}+{tax}-{disc}
                            row = row + "<td><button class='delete btn btn-sm btn-danger' data-id='" +
                                data.product['id'] + "'>X</button></td>"
                            row = row + "<td><input  type='hidden' name='product_name[]'   value='" +
                                data.product['name'] + "'/></td>"
                            row = row + "<td><input  type='hidden' name='product_id[]'   value='" +
                                data.product['id'] + "'/></td>"
                            row = row + "<td><input  type='hidden' name='tax_rate[]'   value='" + data
                                .product[
                                    'tax_id'] + "'/></td>"
                            row = row + "<td><input  type='hidden' name='discount[]'value='" +
                                discount + "'/></td>"
                            row = row + "<td><input  type='hidden' name='tax[]'value='" + tax +
                                "'/></td>"
                            row = row + "</tr>"

                            if ($('#war').val()) {
                                $('#each_product').append(row);
                                calculateTotal();
                                $('#productcodeSearch').val('');
                                $('#result').val('');
                                $('#war').val('');

                            } else {
                                selected_product.pop(selected_product.length)
                                $('#productcodeSearch').val('');
                                $('#result').val('');
                                $('#war').val('');
                                calculateTotal();

                            }

                        }

                    })

                }
            });







            //Delete product

            $(document).on("click", ".delete", function() {
                var remove_id = $(this).data('id');
                removeElement(selected_product, remove_id.toString());
                var el = this;
                $(el).closest("tr").remove();
                calculateTotal();
            });

            function removeElement(array, elem) {
                var index = array.indexOf(elem);
                if (index > -1) {
                    array.splice(index, 1);
                }
            }


            $(document).bind('click keyup', '#each_product', function() {

                $('tr').each(function() {
                    var unit_rate = parseInt($(this).find('.unit_rate').val())
                    var discount = parseInt($(this).find('.discount').val())
                    var tax = parseInt($(this).find('.tax').val())
                    var qty = parseInt($(this).find('.qty').val())
                    parseInt($(this).find('.sub-total').val(qty * unit_rate + tax - discount));
                    parseInt($(this).find('.total').val(qty * unit_rate + tax - discount));

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
                $("#total-qty").text(total_qty);
                $('input[name="total_qty"]').val(total_qty);

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
                $('input[name="total_cost"]').val(total.toFixed(2));

                calculateGrandTotal();
            }





            function calculateGrandTotal() {

                var item = $('table.order-list tbody tr:last').index();

                var total_qty = parseFloat($('#total-qty').text());
                var subtotal = parseFloat($('#total').text());
                var order_tax = parseFloat($('select[name="order_tax_rate"]').val());
                var order_discount = parseFloat($('input[name="order_discount"]').val());
                var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());
                var Recieve_amount = parseFloat($('input[name="paying_amount"]').val());


                if (!order_discount)
                    order_discount = 0.00;
                if (!shipping_cost)
                    shipping_cost = 0.00;
                if (!shipping_cost)
                    shipping_cost = 0.00;

                item = ++item + '(' + total_qty + ')';
                order_tax = (subtotal - order_discount) * (order_tax / 100);
                var grand_total = (subtotal + order_tax + shipping_cost) - order_discount;

                var change_amount = (Recieve_amount - grand_total);

                $('#item').text(item);
                $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);
                $('#subtotal').text(subtotal.toFixed(2));
                $('#order_tax').text(order_tax.toFixed(2));
                $('#order_discount').text(order_discount);
                $('#shipping_cost').text(shipping_cost.toFixed(2));
                $('#grand_total').text(grand_total.toFixed(2));
                $('input[name="grand_total"]').val(grand_total.toFixed(2));
                $('input[name="order_tax"]').val(order_tax.toFixed(2));
                $('input[name="change"]').val(change_amount.toFixed(2));

            }
            $("#payment").hide();
            $("#card").hide();
            $("#gift-card").hide();
            $("#cheque").hide();

            $('select[name="payment_status"]').on("change", function() {
                var payment_status = $(this).val();
                if (payment_status == 3) {
                    $("#payment").show();
                    $('input[name="paid_amount"]').val($('input[name="grand_total"]').val() / 2);

                } else if (payment_status == 2) {
                    $('input[name="paying_amount"]').val('');
                    $('input[name="paid_amount"]').val(0.0);
                } else if (payment_status == 1) {
                    $("#payment").show();
                    $('input[name="paid_amount"]').val($('input[name="grand_total"]').val());
                    $('input[name="paying_amount"]').val($('input[name="grand_total"]').val());



                } else {
                    $("#paid-amount").prop('required', false);
                    $('input[name="paid_amount"]').val('');
                    $("#payment").hide();
                }
            });


            $('select[name="paid_by_id"]').on("change", function() {
                var id = $(this).val();
                $(".payment-form").off("submit");
                $('input[name="cheque_no"]').attr('required', false);
                $('select[name="gift_card_id"]').attr('required', false);
                if (id == 2) {
                    $("#gift-card").show();
                    $("#card").hide();
                    $("#cheque").hide();
                    $('select[name="gift_card_id"]').attr('required', true);
                    $('input[name="paying_amount"]').val($('input[name="grand_total"]').val());


                } else if (id == 3) {
                    $("#card").show();
                    $("#gift-card").hide();
                    $("#cheque").hide();
                } else if (id == 4) {
                    $("#cheque").show();
                    $("#gift-card").hide();
                    $("#card").hide();
                    $('input[name="cheque_no"]').attr('required', true);
                } else {
                    $("#gift-card").hide();
                    $("#card").hide();
                    $("#cheque").hide();

                }
            });


            // $(document).ready(function(){
            //           $(".alert").delay(3000).slideUp(300);
            //     });


            function find_in_warehouse(product_id) {
                var biller_id = $("#biller_id").val();
                var warehouse_id = $("#warehouse_id").val();
                var customer_id = $("#customer_id").val();
                if (!customer_id)
                    console.log('Please select Customer !');
                else if (!warehouse_id)
                    console.log('Please select Warehouse!');
                else if (!biller_id)
                    console.log('Please select Biller !');
                else {
                    $.ajax({
                        url: '/pos/product_ceheck',
                        type: "GET",
                        datatype: "json",
                        data: {
                            product_id: product_id,
                            warehouse_id: warehouse_id
                        },
                        success: function(data) {
                            console.log(data);
                            $('#war').val(data.warehouse_id);
                            $('#qty').val(data.qty);



                            if (data['id'] == undefined) {
                                alert('Product is not avaialable in the selected warehouse');
                            }

                        },
                        error: function(error) {
                            alert('error');
                            console.log(error);
                        }
                    });
                }
            }




            function giftCard() {
                var customer_id = $("#customer_id").val();
                $.ajax({
                    url: "/pos/get_gift_card",
                    type: "GET",
                    datatype: "json",
                    data: {
                        customer_id: customer_id,
                    },
                    success: function(data) {
                        $.each(data, function(index) {
                            gift_card_amount[data[index]['id']] = data[index]['amount'];
                            gift_card_expense[data[index]['id']] = data[index]['expense'];
                            $('select[name="gift_card_id"]').append('<option value="' + data[index][
                                'id'
                            ] + '">' + data[index]['card'] + '</option>');

                        });
                    }
                });
            }

            $('select[name="gift_card_id"]').on("change", function() {
                var balance = gift_card_amount[$(this).val()] - gift_card_expense[$(this).val()];
                $('input[name="gift_card_id"]').val($(this).val());
                if ($('input[name="paid_amount"]').val() > balance) {
                    alert('Amount exceeds card balance! Gift Card balance: ' + balance);
                }

            });

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
