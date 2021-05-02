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

  


  

{{-- -------------------script--------------------- --}}

<script>

// ------------------------getdata----------
                      $(document).ready(function() {
                     $('#table').DataTable({
                      "ajax": {
                       "url": "/delivary/data",
                       "dataSrc": ""
                     },
                      columns: [
                      { "data": "ref" },
                      { "data": "sale_id" },
                      { "data": "address" },
                      { "data": "deli_by" },
                      { "data": "rec_by" },
                      { "data": "file" },
                      { "data": "note" },
                      { "data": "status" },
                      {
                      "data": null,
                      render: function(data, type, row) {
                      return [`
                      <a onclick='editData("${row.id}")' data-toggle='modal' data-target='#myModal' data-id="${row.id}" >
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
@endpush



@push('custom-scripts')
            <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush