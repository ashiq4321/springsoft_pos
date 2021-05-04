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
<link rel="stylesheet" href="{{ asset('backend/js/custom-default.css') }}" id="custom-style">
@endpush
@section('content')
<section class="forms">
<div class="container-fluid">
<form method="POST" enctype="multipart/form-data" id="product-form">
@csrf
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header d-flex align-items-center">
<h4>Update Sale</h4>
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
<option value="{{ $row->id }}" <?php if
($row->id == $data[0]->Customer_id) {
echo 'selected';
} ?>>{{ $row->name }}</option>
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
<option value="{{ $row->id }}" <?php if
($row->id == $data[0]->warehouse_id) {
echo 'selected';
} ?>>{{ $row->name }}</option>
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
<option value="{{ $row->id }}" <?php if
($row->id == $data[0]->biller_id) {
echo 'selected';
} ?>>{{ $row->name }}</option>
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
<input id="qty"  value="{{$data[0]->qty}}" type="hidden" type="text">
</div>
</div>
<div class="row mt-5">
<div class="col-md-12">
<h5>Order Table *</h5>
<div class="table-responsive mt-3">
<table id="myTable"    class="table table-hover order-list">
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
@foreach ($data as $row)

<tr>
<td>{{ $row->name }}</td>
<td>{{ $row->barcode_symbology }}</td>
<td><input type="number"  class="qty" name="qty[]"
value="{{ $row->pqty }}" step="any" /></td>
<td><input type="number" class="no-border unit_rate"
name="unit_price[]" value="{{ $row->price }}"
step="any" readonly /></td>
<td><input type="number" class="no-border discount"
name="discount[]"
value="{{ $row->discount }}" step="any"
readonly /></td>
<td><input type="number" class="no-border tax"
name="tax[]" value="{{ $row->tax }}"
step="any" readonly /></td>
<td><input type="number" class="no-border sub-total"
name="subtotal[]" value="{{ $row->total }}"
step="any" readonly /></td>
<td><button type="button" onclick="Delete({{$row->product_id}})"
class="delete btn btn-sm btn-danger">X</button>
</td>

<td><input type="hidden" class="no-border tax"
name="tax_rate[]" value="{{ $row->tax_id }}"
step="any" readonly /></td>

<input type="hidden" class="product-id"
name="product_id[]" 
value="{{ $row->product_id }}" />

</tr>
@endforeach


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
<option value="">No Tax</option>
<option {{ $row->order_tax_rate == '10' ? 'selected' : '' }}
value="10">vat@10</option>
<option {{ $row->order_tax_rate == '15' ? 'selected' : '' }}
value="15">vat@15</option>
<option {{ $row->order_tax_rate == '20' ? 'selected' : '' }}
value="20">vat@20</option>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>
<strong>Order Discount</strong>
</label>
<input type="number" name="order_discount" class="form-control"
value="{{ $row->order_discount }}" step="any" />

</div>

</div>
<div class="col-md-4">
<div class="form-group">
<label>
<strong>Shipping Cost</strong>
</label>
<input type="number" name="shipping_cost" class="form-control"
value="{{ $row->shipping_cost }}" step="any" />

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
<option {{ $row->sale_status == '1' ? 'selected' : '' }}
value="1">Complete</option>
<option {{ $row->sale_status == '2' ? 'selected' : '' }}
value="2">Pending</option>
<select>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Payment Status *</label>
<select name="payment_status" id="p_status" class="form-control">
<option {{ $row->payment_status == '0' ? 'selected' : '' }}
value="0">Draft</option>
<option {{ $row->payment_status == '1' ? 'selected' : '' }}
value="1">Paid</option>
<option {{ $row->payment_status == '2' ? 'selected' : '' }}
value="2">Due</option>
<option {{ $row->payment_status == '3' ? 'selected' : '' }}
value="3">Partial</option>
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
<option {{ $row->payment_method == '1' ? 'selected' : '' }}
value="1">cash</option>
<option {{ $row->payment_method == '2' ? 'selected' : '' }}
value="2">GiftCard</option>
<option {{ $row->payment_method == '3' ? 'selected' : '' }}
value="3">Credit card</option>
<option {{ $row->payment_method == '4' ? 'selected' : '' }}
value="4">cheque</option>
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
<input type="number" id="change" name="change" readonly value="0.0"
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
<textarea rows="3" class="form-control"
name="payment_note">{{ $row->payment_note }}</textarea>
</div>
</div>
</div>
<div class="row mt-2">
<div class="col-md-6">
<div class="form-group">
<label>Sale Note</label>
<textarea rows="5" class="form-control"
name="sale_note">{{ $row->sale_note }}</textarea>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Staff Note</label>
<textarea rows="5" class="form-control"
name="staff_note">{{ $row->staff_note }}</textarea>
</div>
</div>
</div>
<div class="form-group">
<input type="submit" value="Update" class="btn btn-sm btn-primary" id="submit">
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

</style>


</div>


<script>
var gift_card_amount = [];
var gift_card_expense = [];
var selected_product = new Array

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
var product_id = $('#result').val();
find_in_warehouse(product_id);

return false;
}

});

}


$(document).bind('click keyup', '#productcodeSearch', function() {
if (!selected_product.includes($('#result').val())) {    
selected_product.push($('#result').val());

$.ajax({
url: '/find/' + $('#result').val(),
method: 'GET',
success: function(data) {
var flag = 1;
$(".product-id").each(function() {
if ($(this).val() == data.product['id']) {
swal("Warning!", "Dupplicate Product Not Allowed!",
"warning");
flag = 0;
}
});
console.log(data);
var discount = 0.00;
var tax = (data.product['price'] * (data.product['tax_id'] / 100));var newRow = $("<tr>");
var cols = '';
cols += '<td>' + data.product['name'] + '</td>';
cols += '<td>' + data.product['barcode_symbology'] + '</td>';
cols +=
'<td><input type="number" class=" qty" name="qty[]" value="1" step="any"/></td>';
cols +=
'<td><input type="number" class="  no-border unit_rate" name="unit_price[]" value="' +
data.product['price'] + '" step="any" readonly/></td>';
cols +=
'<td><input type="number" class=" no-border  discount " name="discount[]" value="' +
discount + '" step="any" readonly/></td>';
cols +=
'<td><input type="number" class=" no-border  tax" name="tax[]" value="' +
tax + '" step="any" readonly/></td>';
cols +=
'<td><input type="number" class=" no-border  sub-total" name="subtotal[]" value="' +
(1 * data.product['price'] + tax - discount) +
'" step="any" readonly/></td>';
cols +=
'<td><button type="button" class="delete btn btn-sm btn-danger">X</button></td>';
cols += '<td><input  type="hidden" name="tax_rate[]" value="' + data
.product[
'tax_id'] + '"/></td>';
cols += '<td><input  type="hidden" name="product_id[]" value="' + data
.product[
'id'] + '"/></td>';
cols += '<td><input  type="hidden" name="unit_price[]" value="' + data
.product[
'price'] + '"/></td>';
cols += '<td><input  type="hidden" name="tax[]" value="' + data.product[
'tax'] +
'"/></td>';
cols += '<td><input  type="hidden" name="discount[]" value="' + data
.product[
'discount'] + '"/></td>';
cols += '<td><input  type="hidden" name="tax_id[]" value="' + data.product[
'tax_id'] + '"/></td>';
cols += '<td><input  type="hidden" name="subtotal[]" value="' + (1 * data
.product[
'price'] + tax - discount) + '"/></td>';

if ($('#war').val() && $('.product-id').val() != data.product['id']) {
    
newRow.append(cols);
$("table.order-list tbody").append(newRow);
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


$("table.order-list tbody").on("click", ".delete", function(event) {
$(this).closest("tr").remove();
selected_product.pop(selected_product.length)

calculateTotal();
});



$(document).bind('click keyup', '#each_product', function() {
$('tr').each(function() {
var unit_rate = parseInt($(this).find('.unit_rate').val())
var discount = parseInt($(this).find('.discount').val())
var tax = parseInt($(this).find('.tax').val())
var qty = parseInt($(this).find('.qty').val())
parseInt($(this).find('.sub-total').val(qty * unit_rate + tax - discount));
parseInt($(this).find('.total').val(qty * unit_rate + tax - discount));

if($('#qty').val() < qty){
        alert('No More Product left in this selected warehouse');
        $('.qty').val(0);
    }

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
var paid_amount = parseFloat($('input[name="pid_amount"]').val());


if (!order_discount)
order_discount = 0.00;
if (!shipping_cost)
shipping_cost = 0.00;
if (!shipping_cost)
shipping_cost = 0.00;

item = ++item + '(' + total_qty + ')';
order_tax = (subtotal - order_discount) * (order_tax / 100);
var grand_total = (subtotal + order_tax + shipping_cost) - order_discount;

var change_amount = (Recieve_amount - paid_amount);

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


// function Delete(id){
// swal({
// title: "Are you sure Want to remove this product?",
// text: "Once Delete, This will be Permanently Delete!",
// icon: "warning",
// buttons: true,
// dangerMode: true,
// })
// .then((willDelete) => {
// if (willDelete) {           
// $.ajax({
// type:"get",
// datatype:"json",
// url:"/productsale/delete/"+id,
// success:function(response){
//     $('#myTable').ajax.reload();

// }
// })  
// swal("Deleted!", "Data has been Successfully Deleted!", "success");
// }
// else {
// swal("Safe Data!");
// }
// });
// }

$('#submit').on("click", function(e) {
e.preventDefault();
var formData = new FormData(document.getElementById("product-form"));
var id = {{ $row->id }};
$.ajax({
type: 'POST',
url: '/updatesale/' + id,
data: formData,
contentType: false,
cache: false,
processData: false,
success: function(response) {
console.log(response);
swal("Updated!", "Data has been Successfully Updated!", "success");
location.href = '/sales';

}

});


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
