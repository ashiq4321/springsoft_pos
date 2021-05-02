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
 <button type="button" onclick="cleardata()" class="btn btn-sm btn-info" data-toggle="modal" data-target="#cModal">
 Add Coupon</button> 
</div>
                <div class="table-responsive">
                <table class="table table-bordered" id="coupon" width="100%" cellspacing="0">
                <thead>
                <tr>
                <th scope="col">Coupon Code</th>
                <th scope="col">Type</th>
                <th scope="col">Amount</th>
                <th scope="col">Minimum Amount</th>
                <th scope="col">Qty</th>
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

  


<div class="modal fade bd-example-modal-md" id="cModal">
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
  <div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Add Coupon</h5>
  <h5 class="modal-title" id="ModalLabel">Update Coupon</h5>
  <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  
  <div class="modal-body">   
  <p class="font-italic"><small>The field labels marked with * are required input fields.</small></p><br>
  <div class="form-group">
  <label>Coupon Code *</label>                  
  <div class="input-group">
    <input required="required" class="form-control" style="font-size:15px;" id="card" name="card" type="text">
    <div class="input-group-append">
    <button onclick="getElementById('card').value=Math.floor(Math.random()*100000)" type="button"class="btn btn-primary"></i> Generate</button>
    </div>
  </div>
  <span class="text-danger" id="rError"></span>  
  </div>
  <div class="form-group user_list">
    <label>Type *</label>
    <select name="type" id="type" class="form-control" required data-live-search="true" data-live-search-style="begins">
      <option selected disabled value="">Select Type...</option>
      <option value="Percentage">Percentage</option>
      <option value="fixed">Fixed</option>
    </select>
  
    <span class="text-danger" id="tError"></span>                    
  
    </div>
  <div class="form-group">
  <label>Amount *</label>
  <input type="number" id="amount" name="amount" step="any" required class="form-control">
  <div class="input-group-append mt-1">
    <span class="icon-text" style="font-size: 22px;"><strong>%</strong></span>
</div>
  <span class="text-danger" id="aError"></span>                    
  </div>

  <div class="form-group  mini">
    <label>Minimun Amount *</label>
    <input type="number" id="mamount" name="mamount" step="any" required class="form-control">
    <span class="text-danger" id="mError"></span>                    
    </div>
  <div class="form-group">
    <label>Qty *</label>
    <input  id="qty" name="qty" class="form-control">
    <span class="text-danger" id="qError"></span>                    
    </div>

  <div class="form-group">
  <label>Expired Date</label>
  <input type="date" id="expireddate" name="expireddate" class="form-control ">
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
// ----------cleardata---------
$('#exampleModalLabel').show();
$('#ModalLabel').hide();
$('#butup').hide();
$('#butsave').show();
$('.mini').hide();

$("#cModal select[name='type']").on("change", function() {
      if ($(this).val() == 'fixed') {
          $("#cModal .mini").show();
          $("#cModal .icon-text").text('$');
      } 
      else {
          $("#cModal .mini").hide();
          $("#cModal .mini").prop('required',false);
          $("#cModal .icon-text").text('%');
      }
});





function hideModal() {
$("#cModal").removeClass("in");
$(".modal-backdrop").remove();
$("#cModal").hide();
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
$('#mError').text('');
$('#qError').text('');
$('#eError').text('');

$('#card').val('');
$('#amount').val('');
$('#mamount').val('');
$('#type').val('');
$('#qty').val('');
$('#expireddate').val('');
       
}
// ------------------------getdata----------
                      $(document).ready(function() {
                      var dataLoad= $('#coupon').DataTable({
                        "ajax": {
                           "url": "/coupon/data",
                            "dataSrc": ""
                                     }, 
                     columns: [
                      { "data": "code" },
                      { "data": "type" },
                      { "data": "amount" },
                      { "data": "minimum_amount" },
                      { "data": "quantity" },
                      { "data": "expire_date",
                      render: function ( data, type, row ) {
              if (data >= moment().format()) {
                return '<p class="badge badge-pill  badge-success">'+"Active"+'-'+data+'</p>';
              } else {
                return '<p class="badge badge-pill  badge-danger">'+"Expired"+'-'+data+'</p>';
              }
            }  
                    
                    },
                      {
                      "data": null,
                      render: function(data, type, row) {
                      return [`
                      <a onclick='editData("${row.id}")' data-toggle='modal' data-target='#cModal' data-id="${row.id}" >
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
targets:5, render:function(data){
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


// ------------------------------Insert------------------
function addData(){
$('#rError').text('');
$('#aError').text('');
$('#mError').text('');
$('#qError').text('');
$('#tError').text('');
$('#eError').text('');

var card=  $('#card').val();
var amount= $('#amount').val();
var mamount= $('#mamount').val();
var type= $('#type').val();
var qty= $('#qty').val();
var expireddate= $('#expireddate').val();

$.ajax({
type:"post",
datatype:"json",
data:{card:card,amount:amount,mamount:mamount,type:type,qty:qty,expireddate:expireddate
},
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
url:'/coupon/store',
success:function(data){
console.log("data inserted");
clear();
hideModal();
$('#coupon').dataTable( ).api().ajax.reload();
swal("Inserted!", "Data has been Successfully Insert!", "success")
},
error:function(error){
$('#rError').text(error.responseJSON.errors.card);
$('#aError').text(error.responseJSON.errors.amount);
$('#mError').text(error.responseJSON.errors.mamount);
$('#tError').text(error.responseJSON.errors.type);
$('#qError').text(error.responseJSON.errors.qty);
$('#eError').text(error.responseJSON.errors.expireddate);
}

})

}

//  ----------------------------edit data-----------------------------

//  ----------------------------editEnd-----------------------------
function editData(id){
$('#rError').text('');
$('#aError').text('');
$('#mError').text('');
$('#qError').text('');
$('#tError').text('');
$('#eError').text('');

$('#exampleModalLabel').hide();
$('#ModalLabel').show();
$('#butup').show();
$('#butsave').hide();

$.ajax({
type:"GET",
datatype:"json",
url:"/coupon/edit/"+id,
success:function(data){
$('#id').val(data.id);
$('#card').val(data.code);
$('#amount').val(data.amount);
$('#mamount').val(data.minimum_amount);
$('#type').val(data.type);
$('#qty').val(data.quantity);
$('#expireddate').val(data.expire_date);

}
})
}

// -------------------------------updatedata-----------------




function updateData(){

$('#rError').text('');
$('#aError').text('');
$('#mError').text('');
$('#qError').text('');
$('#tError').text('');
$('#eError').text('');

var id=  $('#id').val();
var card=  $('#card').val();
var amount= $('#amount').val();
var mamount= $('#mamount').val();
var type= $('#type').val();
var qty= $('#qty').val();
var expireddate= $('#expireddate').val();

$.ajax({
type:"post",
datatype:"json",
data:{card:card,amount:amount,mamount:mamount,type:type,qty:qty,expireddate:expireddate
},
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
url:"/coupon/update/"+id,
success:function(data){
$('#exampleModalLabel').show();
$('#ModalLabel').hide();
$('#butup').hide();
$('#butsave').show();
clear();
hideModal();
$('#coupon').dataTable( ).api().ajax.reload();
swal("Updated!", "Data has been Successfully Updated!", "success");

},
error:function(error){
$('#rError').text(error.responseJSON.errors.card);
$('#aError').text(error.responseJSON.errors.amount);
$('#mError').text(error.responseJSON.errors.mamount);
$('#tError').text(error.responseJSON.errors.type);
$('#qError').text(error.responseJSON.errors.qty);
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
url:"/coupon/delete/"+id,
success:function(response){
$('#coupon').dataTable( ).api().ajax.reload();

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