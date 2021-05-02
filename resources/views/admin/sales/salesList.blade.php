@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')


    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title" style="font-size: 1.5rem !important">Sale List</h1>

                    <div class="card-header" style="width:100%; padding: 15px 0px !important">
                        <a class="btn btn-sm btn-info" href="/sales/add">Add New Sale</a>
                    </div>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="dataTables_wrapper dt-bootstrap4 no-footer" width="100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">Reference</th>
                                    <th scope="col">Biller</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Sales Status</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Grand Total</th>
                                    <th scope="col">Paid</th>
                                    <th scope="col">Due</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $row->reference_no }}</td>
                                        <td>{{ $row->bname }}</td>
                                        <td>{{ $row->cname }}</td>
                                        <td>{{ $row->sale_status }}</td>
                                        <td>{{ $row->payment_status }}</td>
                                        <td>{{ $row->grand_total }}</td>
                                        <td>{{ $row->paid_amount }}</td>
                                        <td>{{ $row->grand_total - $row->paid_amount }}</td>
                                        <td>
                                            <a href="{{ URL::to('/sale/editdata/' . $row->id) }}"> <i
                                                    data-feather="edit"></i></a>

                                            <a href="{{ URL::to('/sale/delete/' . $row->id) }}" id="delete"> <i
                                                    data-feather="delete"></i></a>
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
                        <div class="row">
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
    <script>
        $(document).on("click", "#delete", function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            swal({
                    title: "Are you Want to delete?",
                    text: "Once Delete, This will be Permanently Delete!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = link;
                    } else {
                        swal("Safe Data!");
                    }
                });
        });

    </script>


@endsection

@push('plugin-scripts')

    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('backend/js/expense.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
