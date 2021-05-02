
@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')


<div class="row">

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title" style="font-size: 1.5rem !important">Product Brand</h1>

                <div class="card-header" style="width:100%; padding: 15px 0px !important" >
                    <a class="btn btn-sm btn-info" data-toggle="modal" href="#add_productCategory_modal">Add Product Brand</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="productCategory" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Image</th>
                                <th>Brand Name</th> 
                                <th>Status</th>
                                <th>Category Name</th>
                                <th>Action</th>   
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


<!-- add product Category -->
<div id="add_productCategory_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Product Brand</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="mess"></div>
                <form method="POST" enctype="multipart/form-data" id="addProductCategoryFrom">
                    @csrf
                    <div class="form-group" style="display: flex">
                        <label for="" style="width:44%">Brand Name</label>
                        <input name="name" class="form-control" type="text" placeholder="">
                    </div>
                     <div class="form-group" style="display: flex">
                        <label for="" style="width:44%">Category Name</label>
                        <select name="category_id" id="cat_id" class="form-control">
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group" style="display: flex">
                        <label for="" style="width:44%">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="--select--">--Select--</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>

                    </div>
                   
                    <div class="form-group" style="display: flex">
                        <label style="width: 30%">Image</label>
                        <input style="width: 70%"  type="file" class=" form-control" id="image" name="image"  >
                        <span class="text-danger" id="cuError"></span>
                    </div>
                    <div class="form-group">
                        <button id="addProductCategory" class="btn btn-block btn-info" type="submit" value="Save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit product list -->
<div id="edit_productCategory_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Brand</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="mess"></div>
                <form method="POST" enctype="multipart/form-data" id="editProductCategoryFrom">
                    @csrf
                    <div class="form-group" style="display: flex">
                        <label for="" style="width:44%">Brand Name</label>
                        <input type="hidden" name="productBrandID">
                        <input name="brand_nameEdit" class="form-control" type="text" placeholder="">
                    </div>
                    <div class="form-group" style="display: flex">
                        <label for="" style="width:44%">Status</label>
                        <select name="statusEdit" id="productCategoryStatusEdit" class="form-control">
                            <option value="--select--">--Select--</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>

                    </div>
                    
                     <div class="form-group" style="display: flex">
                        <label for="" style="width:44%">Category Name</label>
                        <select name="category_id" id="categoryEdit" class="form-control">
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>

                    </div>
                    
                    <div class="form-group" style="display: flex">
                        <label style="width: 30%">Image</label>
                        <input style="width: 70%"  type="file" class=" form-control" id="imageEdit" name="imageEdit"  >
                        <span class="text-danger" id="cuError"></span>
                    </div>
                    <div class="form-group">
                        <button id="editProductCategory" class="btn btn-block btn-info" type="submit" value="Save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- delete product -->
<div id="delete_productCategory_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete product</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="mess"></div>
                <form id="ss" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">

                        <input type="hidden" name="productCategoryID">
                        <h4>Are You Sure? </h4>                   
                    </div>
                    <div  class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input id="deleteProductCategory" class="btn btn-info btn-block " type="submit" value="Delete">
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
<script src="{{ asset('backend/js/brand.js') }}"></script>
<script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush