@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')


    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title" style="font-size: 1.5rem !important">Expense Category</h1>

                    <div class="card-header" style="width:100%; padding: 15px 0px !important">
                        <a class="btn btn-sm btn-info" data-toggle="modal" href="#add_expenseCategory_modal">Add Expense
                            Category</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="expenseCategoryDT" width="100%" cellspacing="0">
                            <thead>
                                <tr>

                                    <th>Code</th>
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


    <!-- add expense list -->
    <div id="add_expenseCategory_modal" class="modal fade">
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
                        <div class="form-group" style="display: flex">
                            <div class="from-group" style="width: 30%">
                                <label for="" style="width:30%">Code</label>
                            </div>
                            <div class="from-group" style="width: 70%; display:flex;flex-direction: column">
                                <div style="display: flex">
                                    <input style="width: 80%" name="code" class="form-control" placeholder="Minimum 6 Digit"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        type="number" maxlength="6" />
                                    <button style="width: 20%" id="rendomCategoryCode" class="button table-bordered"><i
                                            data-feather="refresh-ccw"></i></button>
                                </div>
                                <div>
                                    <span class="text-danger" id="codeError"></span>
                                </div>

                            </div>

                        </div>



                        <div class="form-group" style="display: flex">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Name</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <input name="name" class="form-control" type="text" placeholder="">
                                <span class="text-danger" id="nameError"></span>
                            </div>

                        </div>

                        <div class="form-group">
                            <button id="addExpenseCategory" class="btn btn-block btn-info" type="submit"
                                value="Save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit expense list -->
    <div id="edit_expenseCategory_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Category</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="mess"></div>
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group" style="display: flex">
                            <input name="expenseCategoryID" type="hidden">
                            <div class="from-group" style="width: 30%">
                                <label for="" style="width:30%">Code</label>
                            </div>
                            <div class="from-group" style="width: 70%; display:flex;flex-direction: column">
                                <div style="display: flex">
                                    <input style="width: 80%" name="codeEdit" class="form-control"
                                        placeholder="Minimum 6 Digit"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        type="number" maxlength="6" />
                                    <button style="width: 20%" id="rendomCategoryCode" class="button table-bordered"><i
                                            data-feather="refresh-ccw"></i></button>
                                </div>
                                <div>
                                    <span class="text-danger" id="codeErrorEdit"></span>
                                </div>

                            </div>

                        </div>



                        <div class="form-group" style="display: flex">
                            <div class="form-group" style="width: 30%">
                                <label for="" style="width:44%">Name</label>
                            </div>
                            <div class="form-group" style="width: 70%">
                                <input name="nameEdit" class="form-control" type="text" placeholder="">
                                <span class="text-danger" id="nameErrorEdit"></span>
                            </div>

                        </div>


                        {{-- <div class="form-group" style="display: flex">
                            <input name="expenseCategoryID" type="hidden">
                            <label for="" style="width:50%">Code</label>
                            <input name="codeEdit" class="form-control" placeholder="Minimum 6 Digit"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                type="number" maxlength="6" />
                            <button id="rendomCategoryCode" class="button table-bordered"><i
                                    data-feather="refresh-ccw"></i></button>
                        </div>
                        <div class="form-group" style="display: flex">
                            <label for="" style="width:44%">Name</label>
                            <input name="nameEdit" class="form-control" type="text" placeholder="">
                        </div> --}}
                        <div class="form-group">
                            <input id="editExpenseCategory" class="btn btn-block btn-info" type="submit" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- delete Expense -->
    <div id="delete_expenseCategory_modal" class="modal fade">
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

                            <input type="hidden" name="expenseCategoryID">
                            <h4>Are You Sure? </h4>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input id="deleteExpenseCategory" class="btn btn-info btn-block " type="submit"
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
    <script src="{{ asset('backend/js/expense.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
