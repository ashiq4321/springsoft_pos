
@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')


<div class="row">

  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h1 class="card-title" style="font-size: 1.5rem !important">Product List</h1>
        
        <div class="card-header" style="width:100%; padding: 15px 0px !important" >
          <a class="btn btn-sm btn-info"  href="{{route('admin.addProduct')}}">Add New Product</a>
      </div>
 
        <div class="table-responsive">
          <table id="dataTableExample" class="dataTables_wrapper dt-bootstrap4 no-footer" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Code</th>
                <th>Brand</th>
                <th>Category</th>   
                <th>Quantity</th>  
                <th>Price</th>   
                <th>Action</th>   
            </tr>
            </thead>
            <tbody>
               
                  @foreach ($all_product as $product)
                  <tr>
                    <td> <img src="/uploads/product/image/{{$product->image}}" class="rounded-circle" width="65px" height="65px"></img></td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->barcode_symbology}}</td>
                    <td>{{$product->brands->name}}</td>
                    <td>{{$product->categories->category_name}}</td>
                    <td>{{$product->qty}}</td>
                    <td>{{$product->price}}</td>
                    <td>
                      <a href="{{route('admin.editProduct',[$product->id]) }}" id="{{$product->id}}"> <i data-feather="edit"></i></a> 
                      <a href="{{route('admin.deleteProduct',[$product->id]) }}" id="{{$product->id}}"> <i data-feather="delete"></i></a> 
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




<!-- delete Expense -->
<div id="delete_expense_modal" class="modal fade">
  <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Delete Expense</h4>
              <button class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
              <div class="mess"></div>
              <form id="ss" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">

                      <input type="hidden" name="expenseID">
                      <h4>Are You Sure? </h4>                   
                  </div>
                  <div  class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input id="deleteExpense" class="btn btn-info btn-block " type="submit" value="Delete">
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input class="btn btn-info btn-block " value="Cancel" data-dismiss="modal">
                    </div>
                    </div>
                  </div>

                  
              </form>
          </div>
      </div>
  </div>
</div>




































@endsection

@push('plugin-scripts')
  
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('backend/js/expense.js') }}"></script>
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush