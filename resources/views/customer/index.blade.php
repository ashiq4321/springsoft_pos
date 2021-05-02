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
<div class="row">

<div class="col-md-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">
<div class="card-header" style="width:100%; padding: 15px 0px !important" >
<button type="button" class="btn btn-sm btn-info" onclick="cleardata()" data-toggle="modal" data-target="#myModal">
Add Customer</button>   
</div>

<div class="table-responsive">
<table class="table table-bordered" id="table_data" width="100%" cellspacing="0">
<thead>
<tr>
<th scope="col">Name</th>
<th scope="col">Company Name</th>
<th scope="col">Email</th>
<th scope="col">Phone</th>
<th scope="col">Tax No.</th>
<th scope="col">Address</th>
{{-- <th scope="col">City</th>
<th scope="col">State</th>
<th scope="col">Postal code</th>
<th scope="col">Country</th> --}}
<th scope="col">Action</th>
</tr>
</thead>
<tbody>

</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
{{-- ------------------datatable button style------------ --}}
<style>
.buttons-print {
background-color: #007bff;
color: white;
margin-right: 4px;
border: none;
}
.buttons-csv {
background-color: #ffce40;
color: white;
margin-right: 4px;
border: none;  
}
.buttons-pdf {
background-color: #ff7588;
color: white;
margin-right: 4px;
border: none;
}
.buttons-colvis {
background-color:  #7c5cc4;
color: white;
margin-right: 4px;
border: none;
}
.dropdown-menu a.active {
background: #7c5cc4 !important;
}
</style>
{{-- ---------------------end----------------- --}}
<!-- Modal -->
<div class="modal fade" id="myModal" >
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add New Customer</h5>
<h5 class="modal-title" id="ModalLabel">Update Customer</h5>
<button type="button"  class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<div class="modal-body">   
<div class="container-fluid">
<div class="row">

<div class="col-md-12">
<div class="card">
<div class="card-body">
<p class="font-italic"><small>The field labels marked with * are required input fields.</small></p><br>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Customer Name *</label>
<input type="text" class=" form-control" id="name" name="name" placeholder="Customer Name" value="{{old('name')}}">
<span class="text-danger" id="nError"></span>
</div>
</div>
<div class="col-md-6">

<div class="form-group">
<label>Company Name</label>
<input type="text" class=" form-control" id="companyname" name="companyname" placeholder="Company Name" value="{{old('companyname')}}">
</div>
</div>
<div class="col-md-6">

<div class="form-group">
<label>Phone *</label>
<input type="number" class=" form-control" id="phone" name="phone" placeholder="Phone" value="{{old('phone')}}">
<span class="text-danger" id="pError"></span>
</div> 
</div>
<div class="col-md-6">

<div class="form-group">
<label>Tax No</label>
<input type="number" class=" form-control" id="tax_no" name="tax_no" placeholder="Tax Number" value="{{old('tax_no')}}">
<span class="text-danger" id="tuError"></span>

</div> 
</div>
<div class="col-md-6">


<div class="form-group">
<label>Email</label>
<input type="text" class=" form-control" id="mail" name="mail"   placeholder="email@example.com"  value="{{old('mail')}}">
<span class="text-danger" id="mError"></span>

</div> 
</div>
<div class="col-md-6">

<div class="form-group">
<label>Address *</label>
<input type="text" class=" form-control" id="address" name="address" placeholder="Address" value="{{old('address')}}">
<span class="text-danger" id="aError"></span>
</div> 
</div>
<div class="col-md-6">

<div class="form-group">
<label>City *</label>
<input type="text" class=" form-control" id="city" name="city" placeholder="City" value="{{old('city')}}">
<span class="text-danger" id="ciError"></span>
</div>
</div>
<div class="col-md-6">

<div class="form-group">
<label>State *</label>
<input type="text" class=" form-control" id="state" name="state" placeholder="State" value="{{old('state')}}">
<span class="text-danger" id="sError"></span>
</div>
</div>
<div class="col-md-6">

<div class="form-group">
<label>Postal Code *</label>
<input type="text" class=" form-control" id="postalcode" name="postalcode" placeholder="Postal code" value="{{old('postalcode')}}">
<span class="text-danger" id="poError"></span>                    
</div>
</div>
<div class="col-md-6">

<div class="form-group">
<label>Country *</label>
<input type="text" class=" form-control" id="country" name="country" placeholder="Country" value="{{old('country')}}">
<span class="text-danger" id="cuError"></span>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<input type="hidden" id="id">
<button type="submit" class="btn btn-sm btn-info" onclick="addData()" id="butsave">Submit</button>
<button type="submit" class="btn btn-sm btn-info"  onclick="updateData()" id="butup">Update</button>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

{{-- -------------------script--------------------- --}}
<script>
$('#exampleModalLabel').show();
$('#ModalLabel').hide();
$('#butup').hide();
$('#butsave').show();

function hideModal() {
$("#myModal").removeClass("in");
$(".modal-backdrop").remove();
$("#myModal").hide();
}

function cleardata(){
$('#exampleModalLabel').show();
$('#ModalLabel').hide();
$('#butup').hide();
$('#butsave').show();
clear();
}

// ------------------------getdata----------
$(document).ready(function() {
var dataLoad= $('#table_data').DataTable({
ajax: '/customer/data',
columns: [
{ "data": "name" },
{ "data": "company_name" },
{ "data": "cus_email" },
{ "data": "phone" },
{ "data": "a_tax" },
{ "data": "address" },
// { "data": "city" },
// { "data": "state" },
// { "data": "postal_code" },
// { "data": "country" },

{
"data": null,
render: function(data, type, row) {
return [`<a onclick='editData("${row.id}")'  data-toggle='modal' data-target='#myModal' data-id="${row.id}" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit" style="margin-right: 10px"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a> 

<a onclick='Delete("${row.id}")' id="deleteExpenseModal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg></a>`];
}
}
],
buttons: [ 'pdf','csv','print','colvis' ],
dom: 
"<'row'<'col-md-4'l><'col-md-6'B><'col-md-2'f>>" +
"<'row'<'col-md-12'tr>>" +
"<'row'<'col-md-5'i><'col-md-7'p>>",
lengthMenu:[
[5,10,25,50,100,-1],
[5,10,25,50,100]
]
} );

// table.buttons().container()
// .appendTo( '#table_wrapper .col-md-5:eq(0)' );

});

// ----------cleardata---------
function clear(){
$('#nError').text('');
$('#mError').text('');
$('#cError').text('');
$('#pError').text('');
$('#tError').text('');
$('#aError').text('');
$('#ciError').text('');
$('#sError').text('');
$('#poError').text('');
$('#cuError').text('');

$('#name').val('');
$('#companyname').val('');
$('#mail').val('');
$('#phone').val('');
$('#tax_no').val('');
$('#address').val('');
$('#city').val('');
$('#state').val('');
$('#postalcode').val('');
$('#country').val('');            
}

// ------------------------------Insert------------------

function addData(){

$('#nError').text('');
$('#mError').text('');
$('#cError').text('');
$('#pError').text('');
$('#tError').text('');
$('#aError').text('');
$('#tError').text('');
$('#sError').text('');
$('#poError').text('');
$('#cuError').text('');


var name=  $('#name').val();
var companyname= $('#companyname').val();
var mail= $('#mail').val();
var phone= $('#phone').val();
var tax_no= $('#tax_no').val();
var address= $('#address').val();
var city= $('#city').val();
var state= $('#state').val();
var postalcode= $('#postalcode').val();
var country= $('#country').val();
$.ajax({
type:"post",
datatype:"json",
data:{name:name,mail:mail,companyname:companyname,phone:phone,tax_no:tax_no,
address:address,city:city,state:state,postalcode:postalcode,country:country
},
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
url:'/customer/store',
success:function(data){
console.log("data inserted");
clear();
hideModal();
$('#table_data').dataTable( ).api().ajax.reload();
swal("Inserted!", "Data has been Successfully Insert!", "success")
},

error:function(error){
$('#nError').text(error.responseJSON.errors.name);
$('#pError').text(error.responseJSON.errors.phone);
$('#mError').text(error.responseJSON.errors.mail);
$('#tError').text(error.responseJSON.errors.tax_no);
$('#aError').text(error.responseJSON.errors.address);
$('#ciError').text(error.responseJSON.errors.city);
$('#sError').text(error.responseJSON.errors.state);
$('#poError').text(error.responseJSON.errors.postalcode);
$('#cuError').text(error.responseJSON.errors.country);
}

})

}
// ------------------------------Insertend------------------


//  ----------------------------edit data-----------------------------
function editData(id){
$('#nError').text('');
$('#mError').text('');
$('#cError').text('');
$('#pError').text('');
$('#tError').text('');
$('#aError').text('');
$('#ciError').text('');
$('#sError').text('');
$('#poError').text('');
$('#cuError').text('');

$.ajax({
type:"GET",
datatype:"json",
url:"/customer/edit/"+id,
success:function(data){
$('#exampleModalLabel').hide();
$('#ModalLabel').show();
$('#butup').show();
$('#butsave').hide();


$('#id').val(data.id);
$('#name').val(data.name);
$('#mail').val(data.cus_email);
$('#companyname').val(data.company_name);
$('#phone').val(data.phone);
$('#tax_no').val(data.a_tax);
$('#address').val(data.address);
$('#city').val(data.city);
$('#state').val(data.state);
$('#postalcode').val(data.postal_code);
$('#country').val(data.country);

}
})
}
//  ----------------------------editEnd-----------------------------


// -------------------------------updatedata-----------------

function updateData(){
$('#nError').text('');
$('#mError').text('');
$('#cError').text('');
$('#pError').text('');
$('#tError').text('');
$('#aError').text('');
$('#ciError').text('');
$('#sError').text('');
$('#poError').text('');
$('#cuError').text('');

var id=  $('#id').val();
var name=  $('#name').val();
var companyname= $('#companyname').val();
var mail= $('#mail').val();
var phone= $('#phone').val();
var tax_no= $('#tax_no').val();
var address= $('#address').val();
var city= $('#city').val();
var state= $('#state').val();
var postalcode= $('#postalcode').val();
var country= $('#country').val();

$.ajax({
type:"post",
datatype:"json",
data:{
'name': name,mail:mail,companyname:companyname,phone:phone,tax_no:tax_no,
address:address,city:city,state:state,postalcode:postalcode,country:country
},
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
url:"/customer/update/"+id,
success:function(data){
$('#exampleModalLabel').show();
$('#ModalLabel').hide();
$('#butup').hide();
$('#butsave').show();
clear();
hideModal();
$('#table_data').dataTable( ).api().ajax.reload();
swal("Updated!", "Data has been Successfully Updated!", "success");

},

error:function(error){
$('#nError').text(error.responseJSON.errors.name);
$('#pError').text(error.responseJSON.errors.phone);
$('#aError').text(error.responseJSON.errors.address);
$('#ciError').text(error.responseJSON.errors.city);
$('#sError').text(error.responseJSON.errors.state);
$('#poError').text(error.responseJSON.errors.postalcode);
$('#cuError').text(error.responseJSON.errors.country);

}
})
}
// -------------------------------updatedataend-----------------


// ---------------------------------Delete--------------------
function Delete(id){
swal({
title: "Are you sure Want to delete?",
text: "Once Delete, This will be Permanently Delete!",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {
if (willDelete) {           
$.ajax({
type:"get",
datatype:"json",
url:"/customer/delete/"+id,
success:function(response){
$('#table_data').dataTable( ).api().ajax.reload();

}
})  
swal("Deleted!", "Data has been Successfully Deleted!", "success");
}
else {
swal("Safe Data!");
}
});
}
// ---------------------------------DeleteEND--------------------


</script>

@endsection
@push('plugin-scripts')

<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js
"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js
"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js
"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js
"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js
"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js
"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js
"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js
"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js
"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js
"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush