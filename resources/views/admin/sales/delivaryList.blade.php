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
    <div class="table-responsive">
        <table id="delivery-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>Delivery Reference</th>
                    <th>Sale Reference</th>
                    <th>Customer</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th class="not-exported">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr data-id="3">
                    <td>0</td>
                    <td>dr-20181106-111321</td>
                    <td>posr-20181105-091516</td>
                    <td>walk-in-customer</td>
                    <td>mohammadpur dhaka</td>
                    <td>
                        <div class="badge badge-primary">Delivering</div>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Action
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <button type="button" data-id="3" class="open-EditCategoryDialog btn btn-link"><i
                                            class="dripicons-document-edit"></i> Edit</button>
                                </li>
                                <li class="divider"></li>
                                <form method="POST" action="https://pos.springsoftitproduct.com/delivery/delete/3"
                                    accept-charset="UTF-8"><input name="_token" type="hidden"
                                        value="1St1N4z1H3qReEGTFWagm3KqtogE2M8vxjfEa0hF">
                                    <li>
                                        <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i
                                                class="dripicons-trash"></i> Delete</button>
                                    </li>
                                </form>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr data-id="2">
                    <td>1</td>
                    <td>dr-20181106-105936</td>
                    <td>posr-20181105-100258</td>
                    <td>walk-in-customer</td>
                    <td>mohammadpur dhaka</td>
                    <td>
                        <div class="badge badge-primary">Delivering</div>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Action
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <button type="button" data-id="2" class="open-EditCategoryDialog btn btn-link"><i
                                            class="dripicons-document-edit"></i> Edit</button>
                                </li>
                                <li class="divider"></li>
                                <form method="POST" action="https://pos.springsoftitproduct.com/delivery/delete/2"
                                    accept-charset="UTF-8"><input name="_token" type="hidden"
                                        value="1St1N4z1H3qReEGTFWagm3KqtogE2M8vxjfEa0hF">
                                    <li>
                                        <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i
                                                class="dripicons-trash"></i> Delete</button>
                                    </li>
                                </form>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr data-id="1">
                    <td>2</td>
                    <td>dr-20180808-044431</td>
                    <td>sr-20180808-043622</td>
                    <td>dhiman</td>
                    <td>kajir deuri chittagong bd</td>
                    <td>
                        <div class="badge badge-success">Delivered</div>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Action
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <button type="button" data-id="1" class="open-EditCategoryDialog btn btn-link"><i
                                            class="dripicons-document-edit"></i> Edit</button>
                                </li>
                                <li class="divider"></li>
                                <form method="POST" action="https://pos.springsoftitproduct.com/delivery/delete/1"
                                    accept-charset="UTF-8"><input name="_token" type="hidden"
                                        value="1St1N4z1H3qReEGTFWagm3KqtogE2M8vxjfEa0hF">
                                    <li>
                                        <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i
                                                class="dripicons-trash"></i> Delete</button>
                                    </li>
                                </form>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div id="edit-delivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
        class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">Update Delivery</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i
                                class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="https://pos.springsoftitproduct.com/delivery/update" accept-charset="UTF-8"
                        enctype="multipart/form-data"><input name="_token" type="hidden"
                            value="1St1N4z1H3qReEGTFWagm3KqtogE2M8vxjfEa0hF">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Delivery Reference</label>
                                <p id="dr"></p>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Sale Reference</label>
                                <p id="sr"></p>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Status *</label>
                                <select name="status" required class="form-control selectpicker">
                                    <option value="1">Packing</option>
                                    <option value="2">Delivering</option>
                                    <option value="3">Delivered</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-2 form-group">
                                <label>Delivered By</label>
                                <input type="text" name="delivered_by" class="form-control">
                            </div>
                            <div class="col-md-6 mt-2 form-group">
                                <label>Received By</label>
                                <input type="text" name="recieved_by" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Customer *</label>
                                <p id="customer"></p>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Attach File</label>
                                <input type="file" name="file" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address *</label>
                                <textarea rows="3" name="address" class="form-control" required></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Note</label>
                                <textarea rows="3" name="note" class="form-control"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="reference_no">
                        <input type="hidden" name="delivery_id">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
