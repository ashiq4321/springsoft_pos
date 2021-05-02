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
                                    .btn1{   
                                    border:none;
                                    border-radius: 3px;
                                    color: white;
                                    padding: 8px 7px;
                                    text-align: center;
                                    text-decoration: none;
                                    display: inline-block;
                                    font-size: 16px;
                                    margin-right: 5px;
                                    }

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
        <div class="table-responsive">
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                <thead>
                <tr>
                <th scope="col">Reference</th>
                <th scope="col">Seller</th>
                <th scope="col">Address</th>
                <th scope="col">Delivered by</th>
                <th scope="col">Recived b</th>
                <th scope="col">File</th>
                <th scope="col">Note</th>
                <th scope="col">status</th>
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

<!-- Edit Delivery Modal -->
<div id="edit_delivery_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Delivery</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="loadForm"></div>

            </div>
        </div>
    </div>
</div>

<!-- delete Delivery Alert -->
<div id="delete_delivery_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Delivery</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="mess"></div>
                <form id="ss" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <input type="hidden" name="deliveryID">
                      <h4>Are You Sure? </h4>
                  </div>

                    <div  class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input id="deleteDelivery" class="btn btn-info btn-block " type="submit" value="Delete">
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
@endpush



@push('custom-scripts')
<script src="{{ asset('backend/js/delivery.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush