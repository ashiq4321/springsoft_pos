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

                    <div class="card-header" style="width:100%; padding: 15px 0px !important">
                        <a class="btn btn-sm btn-info" href="{{ route('purchase.add') }}">Add New Purchase</a>
                    </div>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="dataTables_wrapper dt-bootstrap4 no-footer" width="100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Date</th>

                                    <th>Supplier</th>
                                    <th>Status</th>
                                    <th>Grand Total</th>
                                    <th>Paid Amount</th>
                                    <th>Due</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_purchase as $purchase)
                                    <tr>
                                        <td>{{ $purchase->updated_at }}</td>

                                        <td>{{ $purchase->supplier->name }}</td>
                                        <td>
                                            @if ($purchase->status == 0)
                                                <span class="badge bg-primary text-white">Recieved</span>
                                            @elseif($purchase->status == 1)
                                                <span class="badge bg-danger text-white">Partial</span>
                                            @elseif($purchase->status == 2)
                                                <span class="badge bg-danger text-white">Pending</span>
                                            @elseif($purchase->status == 3)
                                                <span class="badge bg-danger text-white">Ordered</span>
                                            @endif
                                        </td>


                                        <td>{{ $purchase->grand_total }}</td>
                                        <td>{{ $purchase->paid_amount }}</td>
                                        <td>{{ $purchase->grand_total - $purchase->paid_amount }}</td>


                                        <td>
                                            @if ($purchase->payment_status == 0)
                                                <span class="badge bg-primary text-white">Due</span>
                                            @elseif($purchase->payment_status == 1)
                                                <span class="badge bg-danger text-white">Paid</span>
                                            @endif

                                        </td>
                                        <td>
                                            <a href="JavaScript:void(0)" id="add_payment_modal" data-id="{{ $purchase->id }}"
                                                id="{{ $purchase->id }}" class="btn btn-info px-2 py-0"> $</a>
                                            <a href="{{ route('admin.editPurchase', [$purchase->id]) }}"
                                                id="{{ $purchase->id }}"> <i data-feather="edit"></i></a>
                                            <a href="{{ route('admin.deletePurchase', [$purchase->id]) }}"
                                                id="{{ $purchase->id }}"> <i data-feather="delete"></i></a>
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


<!-- Add Payment -->
    <div id="payment_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Payment</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="loadForm"></div>

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




































@endsection

@push('plugin-scripts')

    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('backend/js/expense.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script>
        $('body').on('click', '#add_payment_modal', function(){
            $('#payment_modal').modal('show');
            let purchaseID = $(this).attr('data-id');

            let route = '/purchase/add-payment-modal/' + purchaseID;

            $.ajax({
                url: route,
                // dataType: 'html',
                success: function(data) {
                    $('.modal-body').find('.loadForm').html(data);
                    // console.log(data);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
        
        $('body').on('change', '#paid_by', function(){
            let paid_by = $('#paid_by');

            let card_input = $('#card_input');
            let cheque_input = $('#cheque_input');

            if(paid_by.val() == 'cash'){
                card_input.css("display", "none");
                cheque_input.css("display", "none");
            }
            if(paid_by.val() == 'card'){
                card_input.css("display", "block");
                cheque_input.css("display", "none");
            }
            if(paid_by.val() == 'cheque'){
                card_input.css("display", "none");
                cheque_input.css("display", "block");
            }
        });

    </script>
@endpush
