@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')


    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title" style="font-size: 1.5rem !important">Product Category</h1>

                    <div class="card-header" style="width:100%; padding: 15px 0px !important">
                        <a class="btn btn-sm btn-info" data-toggle="modal" href="#add_productCategory_modal">Add Product
                            Category</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="productCategoryDT" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Image</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
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
                    <h4 class="modal-title">Add Product Category</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="mess"></div>
                    <form method="POST" enctype="multipart/form-data" id="addProductCategoryFrom">
                        @csrf

                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <div class="form-group" style="width: 30%">
                                <label for="">Category Name</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <input name="category_name" class="form-control" type="text" placeholder="">
                                <span class="text-danger" id="nameError"></span>
                            </div>
                        </div>
                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Status</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <select name="status" id="status" class="form-control">
                                    <option value=" ">--Select--</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span class="text-danger" id="statusError"></span>
                            </div>
                        </div>

                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Image</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <input type="file" class=" form-control" id="image" name="image">
                                <span class="text-danger" id=""></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <button id="addProductCategory" class="btn btn-block btn-info" type="submit"
                                value="Save">Save</button>
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
                    <h4 class="modal-title">Edit Category</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="mess"></div>
                    <form method="POST" enctype="multipart/form-data" id="editProductCategoryFrom">
                        @csrf

                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <input type="hidden" name="productCategoryID">
                            <div class="form-group" style="width: 30%">
                                <label for="">Category Name</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <input name="category_nameEdit" class="form-control" type="text" placeholder="">
                                <span class="text-danger" id="nameErrorEdit"></span>
                            </div>
                        </div>
                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Status</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <select name="statusEdit" id="status" class="form-control">
                                    <option value=" ">--Select--</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span class="text-danger" id="statusErrorEdit"></span>
                            </div>
                        </div>

                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Image</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <input type="file" class=" form-control" id="imageEdit" name="imageEdit">
                                <span class="text-danger" id=""></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <button id="editProductCategory" class="btn btn-block btn-info" type="submit"
                                value="Save">Save</button>
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input id="deleteProductCategory" class="btn btn-info btn-block " type="submit"
                                        value="Delete">
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
    <script src="{{ asset('backend/js/product.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
