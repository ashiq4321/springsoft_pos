
@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />


 <style>
     
.select2-selection{
    width: 27em;
    margin:2px;
}
.form-group label {
    font-size: 0.875rem;
    line-height: 1.4rem;
    vertical-align: top;
    margin-bottom: .5rem;
    margin: 8px;
}
 </style>


@endpush

@section('content')


<div class="row">

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title" style="font-size: 1.5rem !important">Product Brand</h1>

                <div class="card-header" style="width:100%; padding: 15px 0px !important" >
                    <a class="btn btn-sm btn-info" data-toggle="modal" href="#add_productCategory_modal">Stock Count</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="productCategory" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Reference_no</th>
                                <th>Brand Name</th> 
                                <th>Status</th>
                                <th>Category Name</th>
<!--                                <th>Action</th>   -->
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
 
<!--<div class="form-group">
    <label>Select which </label>
    <select id="framework" name="framework[]" multiple class="form-control" >
        <option value="Codeigniter">Codeigniter</option>
        <option value="CakePHP">CakePHP</option>
        <option value="Laravel">Laravel</option>
        <option value="YII">YII</option>
        <option value="Zend">Zend</option>
        <option value="Symfony">Symfony</option>
        <option value="Phalcon">Phalcon</option>
        <option value="Slim">Slim</option>
    </select>
</div>-->
<!--<div class="form-group">
    <label>Select which Framework you have knowledge</label>
    <select id="name" name="framework[]" multiple class="form-control" >
        <option value="Codeigniter">Codeigniter</option>
        <option value="CakePHP">CakePHP</option>
        <option value="Laravel">Laravel</option>
        <option value="YII">YII</option>
        <option value="Zend">Zend</option>
        <option value="Symfony">Symfony</option>
        <option value="Phalcon">Phalcon</option>
        <option value="Slim">Slim</option>
    </select>
</div>-->

<div id="add_productCategory_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-md  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Product Brand</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="mess"></div>
                <form method="POST" enctype="multipart/form-data" id="addProductCategoryFrom">
                    @csrf
                    <div class="form-row">
                        <input type="hidden" name="user_id"/>
                        <input type="hidden" name="reference_no"/>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Select Warehouse</label>
                            
                            <select name="warehouse_id" id="status" class="form-control">
                                <option value="--select Warehouse--">--Select--</option>
                                @foreach($warehouse as $warehouse)
                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Select Type</label>
                            <select name="type" id="status" class="type form-control">
                                <option >--Select--</option>
                                <option value="1">Full</option>
                                <option value="0">Partial</option>
                            </select>
                        </div>
                        <div id="cat" class="form-group col-md-6">

                            <label>Select Category </label>
                            <select id="category" name="category_id[]" multiple class="form-control" >
                               @foreach($categories as $categories)
                                <option value="{{$categories->category_name}}">{{$categories->category_name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div id="br" class="form-group col-md-6">

                            <label>Select Brand </label>
                            <select id="brand" name="brand_id[]" multiple class="form-control" >
                                @foreach($brand as $brand)
                                <option value="{{$brand->name}}">{{$brand->name}}</option>
                                @endforeach
                            </select>

                        </div>
                       
                    </div>
                  

                   <div class="form-group">       
              <input type="submit" value="Submit" class="btn btn-primary">
            </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $("#category").select2();
</script>
<script type="text/javascript">
    $("#brand").select2();
</script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <script type="text/javascript">
   $('#name').multiselect({
  nonSelectedText: 'Select Framework',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px'
 });
 </script>
 
 <script>
$(document).ready(function(){

    $("select.type").change(function(){
        var selectedType = $(this).children("option:selected").val();
        alert("You have selected the country - " + selectedType);
        if(selectedType =='1'){
           
        }
    });
});
</script>
 <script>
          
     
     
     
     
     
     
$('#addProductCategoryFrom').on('submit', function(event) { 
    event.preventDefault();
    console.log("BBBBBBBBBBBBBBBBB")
     var formData = new FormData(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
              $.ajax({
                url: '/admin/stock_count',
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    swal("Inserted!", "Data has been Successfully Insert!", "success");
                    $('#add_productCategory_modal form :input').val("");
                    $('#add_productCategory_modal').modal('hide');
                    //$(this).removeData('#add_supplier_modal');
                    tableLoadProductCategoryList.ajax.reload();
                   

                    //alert(data.id);
                },
                error: function(data) {
                    console.log(data);
                    swal("Warning!", "All The Field is required!", "warning");
                   
                }
            })
    });
</script>
@endsection

@push('plugin-scripts')

<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>

@endpush

@push('custom-scripts')

<script src="{{ asset('assets/js/data-table.js') }}"></script>
<script>
var tableLoadProductCategoryList = $('#productCategory').DataTable({
            ajax: '/admin/stock_countList',
            columns: [{
                    "data": null,
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
//                {
//                    "data": null,
//                    render: function(data, type, row) {
//                        return [`<img src="/uploads/product/category/${row.image}" ' + "${row.image}" + 'alt="Admin" class="rounded-circle" width="65px" height="65px"></img>`];
//                    }
//                },
                {
                    "data": "reference_no"
                },
                {
                    "data": "brand_id"
                },
                {
                    "data": "type",
                    render: function(data, type, row) {
                        return data == '1' ? '<span class="badge badge-info">Full</span>' : '<span class="badge  badge-danger">Partial</span>';
                    }
                },
                {
                    "data": "category_id"
                },
//                {
//                    "data": null,
//                    render: function(data, type, row) {
//                        return [`<a id="editProductCategoryModal"  data-id="${row.id}" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit" style="margin-right: 10px"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a> 
//                    
//                    <a data-id="${row.id}" id="deleteProductCategoryModal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg></a>`];
//                    }
//                }
            ]
        });
</script>
@endpush