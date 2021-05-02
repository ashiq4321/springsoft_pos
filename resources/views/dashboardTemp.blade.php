@extends('layout.master')
@push('plugin-styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,500,700">
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js">
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> --}}

    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}"
        rel="stylesheet" />
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <link rel="stylesheet" href="backend/css/addProduct.css" type="text/css" id="custom-style">
    {{-- <script type="text/javascript" src="https://pos.springsoftitproduct.com/public/vendor/chart.js/Chart.min.js"></script> --}}
@endpush
@section('title')
    SpringSoft-IT Dashboard
@endsection
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="row">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="brand-text float-left mt-4">
                    <h3>Welcome <span>{{ Auth::user()->name }}</span> </h3>
                </div>
                <div class="filter-toggle btn-group">
                    <button class="btn btn-secondary date-btn" data-id="0" data-start_date="2021-04-28"
                        data-end_date="2021-04-28">Today</button>
                    <button class="btn btn-secondary date-btn" data-id="1" data-start_date="2021-04-21"
                        data-end_date="2021-04-28">Last
                        7 Days</button>
                    <button class="btn btn-secondary date-btn active" data-id="2" data-start_date="2021-04-01"
                        data-end_date="2021-04-28">This Month</button>
                    <button class="btn btn-secondary date-btn" data-id="3" data-start_date="2021-01-01"
                        data-end_date="2021-12-31">This
                        Year</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Counts Section -->
    <section class="dashboard-counts">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 form-group">
                    <div class="row">
                        <!-- Count item widget-->
                        <div class="col-sm-3">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="dripicons-graph-bar" style="color: #733686"></i></div>
                                <div class="name"><strong style="color: #733686">Revenue</strong></div>
                                <div class="count-number revenue-data">
                                    {{ $all_data[2]['revenue'] }}</div>

                            </div>
                            {{-- <input type="hidden" name="all_data[]" value="{{ $all_data }}"> --}}
                        </div>
                        <!-- Count item widget-->
                        <div class="col-sm-3">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="dripicons-return" style="color: #ff8952"></i></div>
                                <div class="name"><strong style="color: #ff8952">Sale Return</strong></div>
                                <div class="count-number return-data">{{-- {{ $all_data[2]['return'] }} --}}</div>
                            </div>
                        </div>
                        <!-- Count item widget-->
                        <div class="col-sm-3">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="dripicons-media-loop" style="color: #00c689"></i></div>
                                <div class="name"><strong style="color: #00c689">Purchase Return</strong></div>
                                <div class="count-number purchase_return-data">{{-- {{ $all_data[2]['purchase'] }} --}}</div>
                            </div>
                        </div>
                        <!-- Count item widget-->
                        <div class="col-sm-3">
                            <div class="wrapper count-title text-center">
                                <div class="icon"><i class="dripicons-trophy" style="color: #297ff9"></i></div>
                                <div class="name"><strong style="color: #297ff9">Profit</strong></div>
                                <div class="count-number profit-data">{{ $all_data[2]['profit'] }}</div>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- <div class="col-md-7 mt-4">
                    <div class="card line-chart-example">
                        <div class="card-header d-flex align-items-center">
                            <h4>Cash Flow</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="cashFlow" data-color="#733686" data-color_rgba="rgba(115, 54, 134, 0.8)"
                                data-recieved="[&quot;1212.00s&quot;,&quot;0.00&quot;,&quot;45000.00&quot;,&quot;0.00&quot;,&quot;0.00&quot;,&quot;0.00&quot;,&quot;52333.00&quot;]"
                                data-sent="[&quot;0.00&quot;,&quot;0.00&quot;,&quot;0.00&quot;,&quot;0.00&quot;,&quot;0.00&quot;,&quot;0.00&quot;,&quot;0.00&quot;]"
                                data-month="[&quot;October&quot;,&quot;November&quot;,&quot;December&quot;,&quot;January&quot;,&quot;February&quot;,&quot;March&quot;,&quot;April&quot;]"
                                data-label1="Payment Received" data-label2="Payment Sent"></canvas>
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-4 mt-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>{{ date('M') }} {{ date('Y') }}</h4>
                        </div>
                        <div class="pie-chart mb-2">
                            <canvas id="transactionChart" data-color="#733686" data-color_rgba="rgba(115, 54, 134, 0.8)"
                                data-revenue="{{ $all_data[2]['revenue'] }}"
                                data-purchase="{{ $all_data[2]['purchase'] }}"
                                data-expense="{{ $all_data[2]['expense'] }}" data-label1="Purchase" data-label2="Revenue"
                                data-label3="Expense" width="100" height="95"> </canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mt-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Recent Transaction</h4>
                            <div class="right-column">
                                <div class="badge badge-primary">Latest 5</div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#sale-latest" role="tab" data-toggle="tab">Sale</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#purchase-latest" role="tab" data-toggle="tab">Purchase</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="#quotation-latest" role="tab" data-toggle="tab">Quotation</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" href="#payment-latest" role="tab" data-toggle="tab">Payment</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="sale-latest">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Customer</th>
                                                <th>Status</th>
                                                <th>Grand Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sales as $sale)
                                                <tr>
                                                    <td>{{ $sale->updated_at }}</td>
                                                    <td>{{ $sale->customer_name }}</td>
                                                    <td>
                                                        @if ($sale->sale_status == '1')
                                                            <div><span class='badge badge-pill  badge-success'>Paid</span>
                                                            </div>
                                                        @endif
                                                        @if ($sale->sale_status == '0')
                                                            <div><span class='badge badge-warning'>draft</span></div>
                                                        @endif
                                                        @if ($sale->sale_status == '3')
                                                            <div><span class='badge badge-pill badge-info'>Partial</span>
                                                            </div>
                                                        @endif
                                                        @if ($sale->sale_status == '4')
                                                            <div><span class='badge badge-pill badge-danger'>Due</span>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>${{ $sale->grand_total }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="purchase-latest">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Supplier</th>
                                                <th>Status</th>
                                                <th>Grand Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($purchases as $purchase)
                                                <tr>
                                                    <td>{{ $purchase->updated_at }}</td>
                                                    <td>{{ $purchase->supplier_name }}</td>
                                                    <td>
                                                        @if ($purchase->status == '0')
                                                            <div><span
                                                                    class='badge badge-pill  badge-success'>Receieved</span>
                                                            </div>
                                                        @endif
                                                        @if ($purchase->status == '3')
                                                            <div><span class='badge badge-success'>ordered</span></div>
                                                        @endif
                                                        @if ($purchase->status == '1')
                                                            <div><span class='badge badge-pill badge-info'>Partial</span>
                                                            </div>
                                                        @endif
                                                        @if ($purchase->status == '2')
                                                            <div><span class='badge badge-pill badge-danger'>Pending</span>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>${{ $purchase->grand_total }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- <div role="tabpanel" class="tab-pane fade" id="quotation-latest">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Reference</th>
                                                <th>Customer</th>
                                                <th>Status</th>
                                                <th>Grand Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>23/10/2018</td>
                                                <td>qr-20181023-061249</td>
                                                <td>walk-in-customer</td>
                                                <td>
                                                    <div class="badge badge-success">Sent</div>
                                                </td>
                                                <td>453</td>
                                            </tr>
                                            <tr>
                                                <td>04/09/2018</td>
                                                <td>qr-20180904-040257</td>
                                                <td>dhiman</td>
                                                <td>
                                                    <div class="badge badge-danger">Pending</div>
                                                </td>
                                                <td>77.1</td>
                                            </tr>
                                            <tr>
                                                <td>09/08/2018</td>
                                                <td>qr-20180809-055250</td>
                                                <td>tariq</td>
                                                <td>
                                                    <div class="badge badge-success">Sent</div>
                                                </td>
                                                <td>6913</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> --}}
                            <div role="tabpanel" class="tab-pane fade" id="payment-latest">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Reference</th>
                                                <th>Amount</th>
                                                <th>Paid By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payments as $payment)
                                                <tr>
                                                    <td>{{ $payment->updated_at }}</td>
                                                    <td>{{ $payment->payment_reference }}</td>
                                                    <td>${{ $payment->amount }}</td>
                                                    <td>{{ $payment->paying_method }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid">
            <div class="row md-5">
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4>Yearly Report</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="saleChart"
                                data-sale_chart_value="[&quot;{{ $sale_byMonths[1] }}&quot;,&quot;{{ $sale_byMonths[2] }}&quot;,&quot;{{ $sale_byMonths[3] }}&quot;,&quot;{{ $sale_byMonths[4] }}&quot;,&quot;{{ $sale_byMonths[5] }}&quot;,&quot;{{ $sale_byMonths[6] }}&quot;,&quot;{{ $sale_byMonths[7] }}&quot;,&quot;{{ $sale_byMonths[8] }}&quot;,&quot;{{ $sale_byMonths[9] }}&quot;,&quot;{{ $sale_byMonths[10] }}&quot;,&quot;{{ $sale_byMonths[11] }}&quot;,&quot;{{ $sale_byMonths[12] }}&quot;]"
                                data-purchase_chart_value="[&quot;{{ $purchase_byMonths[1] }}&quot;,&quot;{{ $purchase_byMonths[2] }}&quot;,&quot;{{ $purchase_byMonths[3] }}&quot;,&quot;{{ $purchase_byMonths[4] }}&quot;,&quot;{{ $purchase_byMonths[5] }}&quot;,&quot;{{ $purchase_byMonths[6] }}&quot;,&quot;{{ $purchase_byMonths[7] }}&quot;,&quot;{{ $purchase_byMonths[8] }}&quot;,&quot;{{ $purchase_byMonths[9] }}&quot;,&quot;{{ $purchase_byMonths[10] }}&quot;,&quot;{{ $purchase_byMonths[11] }}&quot;,&quot;{{ $purchase_byMonths[12] }}&quot;]"
                                data-label1="Purchased Amount" data-label2="Sold Amount"></canvas>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-md-5">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Best Seller April</h4>
                            <div class="right-column">
                                <div class="badge badge-primary">Top 5</div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Product Details</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Mouse<br>[63920719]</td>
                                        <td>108</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>mango<br>[72782608]</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>ldms<br>[40624536]</td>
                                        <td>2</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="row md-7">
                <div class="col-md-6 mt-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Best Seller {{ date('Y') }}(Qty)</h4>
                            <div class="right-column">
                                <div class="badge badge-primary">Top 5</div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Product Details</th>
                                        <th>Barcode Symbology</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($best_sells as $sell)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $sell->product_name }}</td>
                                            <td>[{{ $sell->barcode_symbology }}]</td>
                                            <td>{{ $sell->sum_qty }}</td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Best Seller {{ date('Y') }}(Price)</h4>
                            <div class="right-column">
                                <div class="badge badge-primary">Top 5</div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Product Details</th>
                                        <th>Barcode Symbology</th>
                                        <th>Grand Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($best_sells_byprice as $sell_byprice)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $sell_byprice->product_name }}</td>
                                            <td>[{{ $sell_byprice->barcode_symbology }}]</td>
                                            <td>{{ $sell_byprice->sum_price }}</td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script type="text/javascript">
        // Show and hide color-switcher
        $(".color-switcher .switcher-button").on('click', function() {
            $(".color-switcher").toggleClass("show-color-switcher", "hide-color-switcher", 300);
        });

        // Color Skins
        $('a.color').on('click', function() {
            /*var title = $(this).attr('title');
            $('#style-colors').attr('href', 'css/skin-' + title + '.css');
            return false;*/
            $.get('setting/general_setting/change-theme/' + $(this).data('color'), function(data) {});
            var style_link = $('#custom-style').attr('href').replace(/([^-]*)$/, $(this).data('color'));
            $('#custom-style').attr('href', style_link);
        });

        $(".date-btn").on("click", function() {
            var all_data = {!! json_encode($all_data) !!}
            $(".date-btn").removeClass("active");
            $(this).addClass("active");

            $('.revenue-data').hide();
            $('.revenue-data').html(parseFloat(all_data[$(this).attr('data-id')]['revenue']).toFixed(2));
            $('.revenue-data').show(500);

            /* $('.return-data').hide();
            $('.return-data').html(parseFloat(all_data[$(this).attr('data-id')]['return']).toFixed(2));
            $('.return-data').show(500); */

            $('.profit-data').hide();
            $('.profit-data').html(parseFloat(all_data[$(this).attr('data-id')]['profit']).toFixed(2));
            $('.profit-data').show(500);

            /*  $('.purchase_return-data').hide();
             $('.purchase_return-data').html(parseFloat(all_data[$(this).attr('data-id')]['purchase']).toFixed(2));
             $('.purchase_return-data').show(500); */
        });

    </script>
    </div>


    </div>
    <script type="text/javascript">
        if ($(window).outerWidth() > 1199) {
            $('nav.side-navbar').removeClass('shrink');
        }

        function myFunction() {
            setTimeout(showPage, 150);
        }

        function showPage() {
            document.getElementById("loader").style.display = "none";
            document.getElementById("content").style.display = "block";
        }

        $("div.alert").delay(3000).slideUp(750);

        function confirmDelete() {
            if (confirm("Are you sure want to delete?")) {
                return true;
            }
            return false;
        }

        $("a#add-expense").click(function(e) {
            e.preventDefault();
            $('#expense-modal').modal();
        });

        $("a#add-account").click(function(e) {
            e.preventDefault();
            $('#account-modal').modal();
        });

        $("a#account-statement").click(function(e) {
            e.preventDefault();
            $('#account-statement-modal').modal();
        });

        $("a#profitLoss-link").click(function(e) {
            e.preventDefault();
            $("#profitLoss-report-form").submit();
        });

        $("a#report-link").click(function(e) {
            e.preventDefault();
            $("#product-report-form").submit();
        });

        $("a#purchase-report-link").click(function(e) {
            e.preventDefault();
            $("#purchase-report-form").submit();
        });

        $("a#sale-report-link").click(function(e) {
            e.preventDefault();
            $("#sale-report-form").submit();
        });

        $("a#payment-report-link").click(function(e) {
            e.preventDefault();
            $("#payment-report-form").submit();
        });

        $("a#warehouse-report-link").click(function(e) {
            e.preventDefault();
            $('#warehouse-modal').modal();
        });

        $("a#user-report-link").click(function(e) {
            e.preventDefault();
            $('#user-modal').modal();
        });

        $("a#customer-report-link").click(function(e) {
            e.preventDefault();
            $('#customer-modal').modal();
        });

        $("a#supplier-report-link").click(function(e) {
            e.preventDefault();
            $('#supplier-modal').modal();
        });

        $("a#due-report-link").click(function(e) {
            e.preventDefault();
            $("#due-report-form").submit();
        });

        $(".daterangepicker-field").daterangepicker({
            callback: function(startDate, endDate, period) {
                var start_date = startDate.format('YYYY-MM-DD');
                var end_date = endDate.format('YYYY-MM-DD');
                var title = start_date + ' To ' + end_date;
                $(this).val(title);
                $('#account-statement-modal input[name="start_date"]').val(start_date);
                $('#account-statement-modal input[name="end_date"]').val(end_date);
            }
        });

        $('.selectpicker').selectpicker({
            style: 'btn-link',
        });

    </script>





@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}">
        < /> <
        script src = "{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}" >

    </script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>



    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>













@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
    <script src="{{ asset('backend/js/charts-custom.js') }}"></script>
@endpush
