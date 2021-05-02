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
{{-- -----------------DATATABLE BUTTON STYLE--------------- --}}

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
{{-- ----------------------styleend----------------------- --}}

<div class="col-md-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">
<div class="card-header" style="width:100%; padding: 15px 0px !important" >
<button type="button" onclick="cleardata()" class="btn btn-sm btn-info" data-toggle="modal" data-target="#gModal">
Add Gift Card</button> 
</div>
<div class="table-responsive">
<table class="table table-bordered" id="tabledata" width="100%" cellspacing="0">
<thead>
<tr>
<th scope="col">Card No</th>
<th scope="col">Customer</th>
<th scope="col">Amount</th>
<th scope="col">Expense</th>
<th scope="col">Available Balance</th>
<th scope="col">Created By</th>
<th scope="col">Expired Date</th>
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

<!-- Modal -->
<div class="modal fade bd-example-modal-md" id="gModal">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add Gift card</h5>
<h5 class="modal-title" id="ModalLabel">Update Gift card</h5>
<button type="button"  class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<div class="modal-body">   
<p class="font-italic"><small>The field labels marked with * are required input fields.</small></p><br>
<div class="form-group">
<label>Card No *</label>                  
<div class="input-group">
<input required="required" class="form-control" style="font-size:15px;" id="card" name="card" type="text">
<div class="input-group-append">
<button onclick="getElementById('card').value=Math.floor(Math.random()*100000000)" type="button"class="btn btn-primary"></i> Generate</button>
</div>
</div>
<span class="text-danger" id="rError"></span>  
</div>

<div class="form-group">
<label>Amount *</label>
<input type="number" id="amount" name="amount" step="any" required class="form-control">
<span class="text-danger" id="aError"></span>                    
</div>
<div class="form-group">
<label>User List</label>&nbsp;
<input type="checkbox" id="user" name="user" value="1">
</div>
<div class="form-group user_list">
<label>User *</label>
<select name="user_id" id="user_id" class="form-control" required data-live-search="true" data-live-search-style="begins">
    <option selected disabled value="">Select User...</option>
    @foreach($user as $row)
    <option value="{{ $row->id }}">{{$row->name}}</option>
    @endforeach
</select>
</div>
<div class="form-group customer_list">
<label>Customer *</label>
<select name="customer_id"  id="customer_id" class="form-control" required data-live-search="true" data-live-search-style="begins">
    <option selected disabled value="">Select Customer...</option>
    @foreach($customer as $row)
    <option value="{{ $row->id }}">{{$row->name}}</option>
    @endforeach

</select>
</div>
<div class="form-group">
<label>Expired Date</label>
<input type="date" id="expireddate" name="expireddate" class="form-control">
<span class="text-danger" id="eError"></span>                    
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




{{-- -------------------script--------------------- --}}

<script>
$('#exampleModalLabel').show();
$('#ModalLabel').hide();
$('#butup').hide();
$('#butsave').show();

function hideModal() {
$("#gModal").removeClass("in");
$(".modal-backdrop").remove();
$("#gModal").hide();
}
function cleardata(){
$('#exampleModalLabel').show();
$('#ModalLabel').hide();
$('#butup').hide();
$('#butsave').show();
clear();
}
function clear(){
$('#rError').text('');
$('#aError').text('');
$('#eError').text('');

$('#card').val('');
$('#amount').val('');
$('#user').val('');
$('#user_id').val('');
$('#customer_id').val('');
$('#expireddate').val('');
       
}

// ------------------------getdata----------
$(document).ready(function() {
var dataLoad= $('#tabledata').DataTable({
ajax: '/giftcard/data',
columns: [
{ "data": "card" },
{ "data":"cname" },
{ "data": "amount" },
{ "data": "expense" ,
render: function ( data, type, row ) {
        return Math.round(data);
    }
 },
{"data": null,
    render: function ( data, type, row ) {
        return Math.round( ( row.amount - row.expense ));
    }
},
{ "data": "uname" },
{ "data": "expired_date",
render: function ( data, type, row ) {
              if (data >= moment().format()) {
                return '<span class="badge badge-pill  badge-success">'+"Active"+'-'+data+'</span>';
              } else {
                return '<span class="badge badge-pill  badge-danger">'+"Expired"+'-'+data+'</span>';
              }
            }       
},


{
"data": null,
render: function(data, type, row) {
return [`
<a onclick='editData("${row.id}")' data-toggle='modal' data-target='#gModal' data-id="${row.id}" >
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
class="feather feather-edit" style="margin-right: 10px">
<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path
d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a> 


<a onclick='Delete("${row.id}")' id="deleteExpenseModal"><svg xmlns="http://www.w3.org/2000/svg"
width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 
8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" 
y1="9" x2="18" y2="15"></line></svg></a>`];
}
}
],
columnDefs: [{
targets:6, render:function(data){
return moment(data).format('DD-MM-YY');
}     
}],
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
table.buttons().container()
.appendTo( '#table_wrapper .col-md-5:eq(0)' );
} );


//userlist hide checkbox
$(".user_list").hide();
$( "#user" ).on("change", function() {
        if ($(this).is(':checked')) {
            $(".user_list").show();
            $(".customer_list").hide();
            $("select[name='user_id']").prop('required',true);
            $("select[name='customer_id']").prop('required',false);
        } 
        else {
            $(".user_list").hide();
            $(".customer_list").show();
            $("select[name='user_id']").prop('required',false);
            $("select[name='customer_id']").prop('required',true);
        }
    });
//userlist hide 
  

// ----------cleardata---------

// ------------------------------Insert------------------
function addData(){
$('#rError').text('');
$('#aError').text('');
$('#eError').text('');


var card=  $('#card').val();
var amount= $('#amount').val();
var customer_id= $('#customer_id').val();
var user_id= $('#user_id').val();
var expireddate= $('#expireddate').val();

$.ajax({
type:"post",
datatype:"json",
data:{card:card,amount:amount,customer_id:customer_id,user_id:user_id,expireddate:expireddate
},
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
url:'/gift/store',
success:function(data){
console.log("data inserted");
clear();
hideModal();
$('#tabledata').dataTable( ).api().ajax.reload();
swal("Inserted!", "Data has been Successfully Insert!", "success")
},
error:function(error){
$('#rError').text(error.responseJSON.errors.card);
$('#aError').text(error.responseJSON.errors.amount);
$('#eError').text(error.responseJSON.errors.expireddate);
}
})

}


//  ----------------------------edit data-----------------------------
function editData(id){
$('#rError').text('');
$('#aError').text('');
$('#eError').text('');


$('#exampleModalLabel').hide();
$('#ModalLabel').show();
$('#butup').show();
$('#butsave').hide();

$.ajax({
type:"GET",
datatype:"json",
url:"/giftcard/edit/"+id,
success:function(data){
$('#id').val(data.id);
$('#card').val(data.card);
$('#amount').val(data.amount);
$('#customer_id').val(data.customer_id);
$('#user_id').val(data.user_id);
$('#expireddate').val(data.expired_date);

}
})
}
//  ----------------------------editEnd-----------------------------


// -------------------------------updatedata-----------------

function updateData(){
$('#rError').text('');
$('#aError').text('');
$('#eError').text('');

var id=  $('#id').val();
var card=  $('#card').val();
var amount= $('#amount').val();
var customer_id= $('#customer_id').val();
var user_id= $('#user_id').val();
var expireddate= $('#expireddate').val();

$.ajax({
type:"post",
datatype:"json",
data:{card:card,amount:amount,customer_id:customer_id,user_id:user_id,expireddate:expireddate
},
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
url:"/gift/update/"+id,
success:function(data){
$('#exampleModalLabel').show();
$('#ModalLabel').hide();
$('#butup').hide();
$('#butsave').show();
clear();
hideModal();
$('#tabledata').dataTable( ).api().ajax.reload();
swal("Updated!", "Data has been Successfully Updated!", "success");

},
error:function(error){
$('#rError').text(error.responseJSON.errors.card);
$('#aError').text(error.responseJSON.errors.amount);
$('#eError').text(error.responseJSON.errors.expireddate);
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
url:"/gift/delete/"+id,
success:function(response){
$('#tabledata').dataTable( ).api().ajax.reload();

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
<script  src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush