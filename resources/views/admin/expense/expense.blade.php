@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')


    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title" style="font-size: 1.5rem !important">Expense List</h1>
                    @if (Route::current()->getName() == 'admin.addExpense')
                        <div class="card-header" style="width:100%; padding: 15px 0px !important">
                            <a class="btn btn-sm btn-info" data-toggle="modal" href="#add_expense_modal">Add New Expense</a>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="leaveTypeDT" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Reference</th>
                                    <th>Warehouse</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Note</th>
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


    <!-- add expense list -->
    <div id="add_expense_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Expense</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="mess"></div>
                    <form method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Date</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <input name="date" class="form-control" type="date" placeholder="">
                                <span class="text-danger" id="dateError"></span>
                            </div>
                        </div>

                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Reference</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <select id="reference" class="form-control">
                                    <option value=" ">-select-</option>
                                    @foreach ($all_user as $user)
                                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="referenceError"></span>
                            </div>
                        </div>

                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Warehouse</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <select id="warehouse" class="form-control">
                                    <option value=" ">-select-</option>
                                    @foreach ($all_warehouse as $warehouse)
                                        <option value="{{ $warehouse->name }}">{{ $warehouse->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="warehouseError"></span>
                            </div>
                        </div>

                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Category</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <select name="category" id="category" class="form-control">
                                    <option value=" ">-select-</option>
                                    @foreach ($all_expenseCategory as $expenseCategory)
                                        <option value="{{ $expenseCategory->name }}">{{ $expenseCategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="categoryError"></span>
                            </div>
                        </div>

                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Amount</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <input name="amount" class="form-control" type="number" placeholder="">
                                <span class="text-danger" id="amountError"></span>
                            </div>
                        </div>

                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Note</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <input name="note" class="form-control" type="text" placeholder="">
                                <span class="text-danger" id="noteError"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <button id="addExpense" class="btn btn-block btn-info" type="submit" value="Save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit expense list -->
    <div id="edit_expense_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Expense</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="mess"></div>
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <input name="expenseID" type="hidden">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Date</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <input name="dateEdit" class="form-control" type="date" placeholder="">
                                <span class="text-danger" id="dateErrorEdit"></span>
                            </div>
                        </div>

                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Reference</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <select id="referenceEdit" class="form-control">
                                    <option value=" ">-select-</option>
                                    @foreach ($all_user as $user)
                                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="referenceErrorEdit"></span>
                            </div>
                        </div>

                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Warehouse</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <select id="warehouseEdit" class="form-control">
                                    <option value=" ">-select-</option>
                                    @foreach ($all_warehouse as $warehouse)
                                        <option value="{{ $warehouse->name }}">{{ $warehouse->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="warehouseErrorEdit"></span>
                            </div>
                        </div>

                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Category</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <select id="categoryEdit" class="form-control">
                                    <option value=" ">-select-</option>
                                    @foreach ($all_expenseCategory as $expenseCategory)
                                        <option value="{{ $expenseCategory->name }}">{{ $expenseCategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="categoryErrorEdit"></span>
                            </div>
                        </div>

                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Amount</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <input name="amountEdit" class="form-control" type="number" placeholder="">
                                <span class="text-danger" id="amountErrorEdit"></span>
                            </div>
                        </div>

                        <div class="form-group" style="display: flex; margin-bottom: 3px">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Note</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <input name="noteEdit" class="form-control" type="text" placeholder="">
                                <span class="text-danger" id="noteError"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <input id="editExpense" class="btn btn-block btn-info" type="submit" value="Save">
                        </div>
                    </form>
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
@endpush
