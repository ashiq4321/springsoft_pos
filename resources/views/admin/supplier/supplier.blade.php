@extends('layout.master')
@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title" style="font-size: 1.5rem !important">supplier List</h1>
                @if(Route::current()->getName() == 'admin.addSupplier')
                <div class="card-header" style="width:100%; padding: 15px 0px !important" >
                    <a class="btn btn-sm btn-info" data-toggle="modal" href="#add_supplier_modal">Add New supplier</a>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="supplierDT" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                              <th>Image</th>
                                <th>Name</th>
                                <th>Company name</th>
                                <th>VAT number</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                {{-- <th>City</th>
                                <th>State</th>
                                <th>Postal Code</th>
                                <th>Country</th> --}}
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
<!-- add supplier list -->
<div id="add_supplier_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add supplier</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="addSupplierForm">
                    @csrf
                    <div class="mess"></div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class=" form-control" id="name" name="name"  value="{{old('name')}}">
                            <span class="text-danger" id="nameError"></span>
                        </div>
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" class=" form-control" id="company_name" name="company_name"  value="{{old('company_name')}}">
                            <span class="text-danger" id="company_nameError"></span>  
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" class=" form-control" id="phone" name="phone"  value="{{old('phone')}}">
                            <span class="text-danger" id="phoneError"></span>
                        </div>
                        <div class="form-group">
                            <label>Vat Number</label>
                            <input type="number" class=" form-control" id="vat" name="vat" " value="{{old('tax')}}">
                            <span class="text-danger" id="vatError"></span>
                        </div>
                        <div class="form-group">
                            <label style="width: 30%">Email</label>
                            <input type="text" class=" form-control" id="email" name="email"   value="{{old('mail')}}">
                            <span class="text-danger" id="emailError"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class=" form-control" id="city" name="city" value="{{old('city')}}">
                            <span class="text-danger" id="cityError"></span>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class=" form-control" id="state" name="state"  value="{{old('state')}}">
                            <span class="text-danger" id="stateError"></span>
                        </div>
                        <div class="form-group">
                            <label style="width: 30%">Postal Code</label>
                            <input type="number" class=" form-control" id="postal_code" name="postal_code"  value="{{old('postalcode')}}">
                            <span class="text-danger" id="postal_codeError"></span>  
                        </div>
                        <div class="form-group">
                            <label style="width: 30%">Country</label>
                            <input type="text" class=" form-control" id="country" name="country"  value="{{old('country')}}">
                            <span class="text-danger" id="countryError"></span>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input name="photo" class="form-control" type="file">
                            <span class="text-danger" id="imageError"></span>
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label style="width: 17%">Address</label>
                        <textarea  class=" form-control" name="address" id="address" cols="5" rows="5" value="{{old('address')}}"></textarea>
                        <span class="text-danger" id="addressError"></span>
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <button id="addSupplier" class="btn btn-block btn-info" type="submit" value="Save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Supplier list -->
<div id="edit_supplier_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Supplier</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="mess"></div>
                <form method="POST" enctype="multipart/form-data" id="supplierEditForm">
                    @csrf
                    <div class="mess"></div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" name="supplierID">
                            <label style="width: 30%">Name</label>
                            <input type="text" class=" form-control" id="nameEdit" name="nameEdit"  value="{{old('name')}}">
                            <span class="text-danger" id="nameEditError"></span>
                        </div>
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" class=" form-control" id="company_nameEdit" name="company_nameEdit"  value="{{old('company_name')}}">
                            <span class="text-danger" id="company_nameEditError"></span>  
                        </div>
                        <div class="form-group">
                            <label style="width: 30%">Phone</label>
                            <input type="number" class=" form-control" id="phoneEdit" name="phoneEdit"  value="{{old('phone')}}">
                            <span class="text-danger" id="phoneEditError"></span>
                        </div>
                        <div class="form-group">
                            <label>Vat Number</label>
                            <input type="number" class=" form-control" id="vatEdit" name="vatEdit" " value="{{old('tax')}}">
                            <span class="text-danger" id="vatEditError"></span>
                        </div>
                        <div class="form-group">
                            <label style="width: 30%">Email</label>
                            <input type="text" class=" form-control" id="emailEdit" name="emailEdit"   value="{{old('mail')}}">
                            <span class="text-danger" id="emailEditError"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class=" form-control" id="cityEdit" name="cityEdit" value="{{old('city')}}">
                            <span class="text-danger" id="cityEditError"></span>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class=" form-control" id="stateEdit" name="stateEdit"  value="{{old('state')}}">
                            <span class="text-danger" id="stateEditError"></span>
                        </div>
                        <div class="form-group">
                            <label style="width: 30%">Postal Code</label>
                            <input type="text" class=" form-control" id="postal_codeEdit" name="postal_codeEdit"  value="{{old('postalcode')}}">
                            <span class="text-danger" id="postal_codeEditError"></span>  
                        </div>
                        <div class="form-group">
                            <label style="width: 30%">Country</label>
                            <input type="text" class=" form-control" id="countryEdit" name="countryEdit"  value="{{old('country')}}">
                            <span class="text-danger" id="countryEditError"></span>
                        </div>
                        <div class="form-group">
                            <label style="width: 30%">Image</label>
                            <input type="file" class=" form-control" id="imageEdit" name="imageEdit"  >
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label style="width: 17%">Address</label>
                        <textarea  class=" form-control" name="addressEdit" id="addressEdit" cols="5" rows="5" value="{{old('address')}}"></textarea>
                        <span class="text-danger" id="addressEditError"></span>
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <button id="addSupplierEdit" class="btn btn-block btn-info" type="submit" value="Save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- delete Supplier -->
<div id="delete_supplier_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete supplier</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="mess"></div>
                <form id="ss" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <input type="hidden" name="supplierID">
                      <h4>Are You Sure? </h4>
                  </div>

                    <div  class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input id="deleteSupplier" class="btn btn-info btn-block " type="submit" value="Delete">
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
<script src="{{ asset('backend/js/supplier.js') }}"></script>
<script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush