@extends('layout.master')
@section('title')
Essential-infotech- pos
@endsection
@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />

<link rel="stylesheet" href="backend/js/custom-default.css" type="text/css" id="custom-style">
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  {{-- <link rel="stylesheet" href="/public/vendor/bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/public/vendor/bootstrap-toggle/css/bootstrap-toggle.min.css" type="text/css">
    <link rel="stylesheet" href="/public/vendor/bootstrap/css/bootstrap-datepicker.min.css" type="text/css">
    <link rel="stylesheet" href="/public/vendor/jquery-timepicker/jquery.timepicker.min.css" type="text/css">
    <link rel="stylesheet" href="/public/vendor/bootstrap/css/awesome-bootstrap-checkbox.css" type="text/css">
    <link rel="stylesheet" href="/public/vendor/bootstrap/css/bootstrap-select.min.css" type="text/css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="/public/vendor/font-awesome/css/font-awesome.min.css" type="text/css">
    <!-- Drip icon font-->
    <link rel="stylesheet" href="/public/vendor/dripicons/webfont.css" type="text/css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="/public/css/grasp_mobile_progress_circle-1.0.0.min.css" type="text/css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="/public/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css" type="text/css">
    <!-- virtual keybord stylesheet-->
    <link rel="stylesheet" href="/public/vendor/keyboard/css/keyboard.css" type="text/css">
    <!-- date range stylesheet-->
    <link rel="stylesheet" href="/public/vendor/daterange/css/daterangepicker.min.css" type="text/css">
    <!-- table sorter stylesheet-->
    <link rel="stylesheet" type="text/css" href="/public/vendor/datatable/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/style.default.css" id="theme-stylesheet" type="text/css">
    <link rel="stylesheet" href="/public/css/dropzone.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <script type="text/javascript" src="/public/vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/public/vendor/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/public/vendor/jquery/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="/public/vendor/jquery/jquery.timepicker.min.js"></script>
    <script type="text/javascript" src="/public/vendor/popper.js/umd/popper.min.js">
    </script>
    <script type="text/javascript" src="/public/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/public/vendor/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
    <script type="text/javascript" src="/public/vendor/bootstrap/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="/public/vendor/keyboard/js/jquery.keyboard.js"></script>  
    <script type="text/javascript" src="/public/vendor/keyboard/js/jquery.keyboard.extension-autocomplete.js"></script>
    <script type="text/javascript" src="/public/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script type="text/javascript" src="/public/vendor/jquery.cookie/jquery.cookie.js">
    </script>
    <script type="text/javascript" src="/public/vendor/chart.js/Chart.min.js"></script>
    <script type="text/javascript" src="/public/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/public/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="/public/js/charts-custom.js"></script>
    <script type="text/javascript" src="/public/js/front.js"></script>
    <script type="text/javascript" src="/public/vendor/daterange/js/moment.min.js"></script>
    <script type="text/javascript" src="/public/vendor/daterange/js/knockout-3.4.2.js"></script>
    <script type="text/javascript" src="/public/vendor/daterange/js/daterangepicker.min.js"></script>
    <script type="text/javascript" src="/public/vendor/tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="/public/js/dropzone.js"></script>
    
    <!-- table sorter js-->
    <script type="text/javascript" src="/public/vendor/datatable/pdfmake.min.js"></script>
    <script type="text/javascript" src="/public/vendor/datatable/vfs_fonts.js"></script>
    <script type="text/javascript" src="/public/vendor/datatable/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/public/vendor/datatable/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/public/vendor/datatable/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="/public/vendor/datatable/buttons.bootstrap4.min.js">"></script>
    <script type="text/javascript" src="/public/vendor/datatable/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="/public/vendor/datatable/buttons.html5.min.js"></script>
    <script type="text/javascript" src="/public/vendor/datatable/buttons.print.min.js"></script>

    <script type="text/javascript" src="/public/vendor/datatable/sum().js"></script>
    <script type="text/javascript" src="/public/vendor/datatable/dataTables.checkboxes.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>  --}}
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="/public/css/custom-default.css" type="text/css" id="custom-style">
  
@endpush

@section('content')
<section class="forms pos-section">
    <div class="container-fluid">
        <div class="row">
            <audio id="mysoundclip1" preload="auto">
                <source src="https://crm.essential-infotech.com/public/beep/beep-timber.mp3"></source>
            </audio>
            <audio id="mysoundclip2" preload="auto">
                <source src="https://crm.essential-infotech.com/public/beep/beep-07.mp3"></source>
            </audio>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" style="padding-bottom: 0">
                        <form method="POST" action="https://crm.essential-infotech.com/sales" accept-charset="UTF-8" class="payment-form" enctype="multipart/form-data"><input name="_token" type="hidden" value="gIRlvZ4aAsBKfM7t7xEqFN1c59aXtTLerOI8jmQY">
                                                <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                                                                        <input type="hidden" name="warehouse_id_hidden" value="2">
                                                                                        <select required id="warehouse_id" name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                                                                                <option value="1">a</option>
                                                                                                <option value="2">b</option>
                                                                                                <option value="3">c</option>
                                                                                                <option value="4">d</option>
                                                                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                                                                        <input type="hidden" name="biller_id_hidden" value="1">
                                                                                        <select required id="biller_id" name="biller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Biller...">
                                                                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                                                                        <input type="hidden" name="customer_id_hidden" value="11">
                                                                                        <div class="input-group pos">
                                                                                                <select required name="customer_id" id="customer_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select customer..." style="width: 100px">
                                                                                                                                                                                                        <option value="1">saalman chowdhury (1610230)</option>
                                                                                                                                                        <option value="2">Morshedul (+8801869443362)</option>
                                                                                                </select>
                                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#addCustomer"><i class="dripicons-plus"></i></button>
                                                                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="search-box form-group">
                                            <input type="text" name="product_code_name" id="lims_productcodeSearch" placeholder="Scan/Search product by name/code" class="form-control"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="table-responsive transaction-list">
                                        <table id="myTable" class="table table-hover table-striped order-list table-fixed">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-4">Product</th>
                                                    <th class="col-sm-2">Price</th>
                                                    <th class="col-sm-3">Quantity</th>
                                                    <th class="col-sm-3">SubTotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row" style="display: none;">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_qty" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_discount" value="0.00" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_tax" value="0.00"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_price" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="item" />
                                            <input type="hidden" name="order_tax" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="grand_total" />
                                            <input type="hidden" name="coupon_discount" />
                                            <input type="hidden" name="sale_status" value="1" />
                                            <input type="hidden" name="coupon_active">
                                            <input type="hidden" name="coupon_id">
                                            <input type="hidden" name="coupon_discount" />

                                            <input type="hidden" name="pos" value="1" />
                                            <input type="hidden" name="draft" value="0" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 totals" style="border-top: 2px solid #e4e6fc; padding-top: 10px;">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <span class="totals-title">Items</span><span id="item">0</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="totals-title">Total</span><span id="subtotal">0.00</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="totals-title">Discount <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#order-discount"> <i class="dripicons-document-edit"></i></button></span><span id="discount">0.00</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="totals-title">Coupon <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#coupon-modal"><i class="dripicons-document-edit"></i></button></span><span id="coupon-text">0.00</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="totals-title">Tax <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#order-tax"><i class="dripicons-document-edit"></i></button></span><span id="tax">0.00</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="totals-title">Shipping <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#shipping-cost-modal"><i class="dripicons-document-edit"></i></button></span><span id="shipping-cost">0.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="payment-amount">
                        <h2>Grand Total <span id="grand-total">0.00</span></h2>
                    </div>
                    <div class="payment-options">
                        <div class="column-5">
                            <button style="background: #0984e3" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="credit-card-btn"><i class="fa fa-credit-card"></i> Card</button>   
                        </div>
                        <div class="column-5">
                            <button style="background: #00cec9" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="cash-btn"><i class="fa fa-money"></i> Cash</button>
                        </div>
                        <div class="column-5">
                            <button style="background-color: #213170" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="paypal-btn"><i class="fa fa-paypal"></i> Paypal</button>
                        </div>
                        <div class="column-5">
                            <button style="background-color: #e28d02" type="button" class="btn btn-custom" id="draft-btn"><i class="dripicons-flag"></i> Draft</button>
                        </div>
                        <div class="column-5">
                            <button style="background-color: #fd7272" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="cheque-btn"><i class="fa fa-money"></i> Cheque</button>
                        </div>
                        <div class="column-5">
                            <button style="background-color: #5f27cd" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="gift-card-btn"><i class="fa fa-credit-card-alt"></i> GiftCard</button>
                        </div>
                        <div class="column-5">
                            <button style="background-color: #b33771" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="deposit-btn"><i class="fa fa-university"></i> Deposit</button>
                        </div>
                        <div class="column-5">
                            <button style="background-color: #d63031;" type="button" class="btn btn-custom" id="cancel-btn" onclick="return confirmCancel()"><i class="fa fa-close"></i> Cancel</button>
                        </div>
                        <div class="column-5">
                            <button style="background-color: #ffc107;" type="button" class="btn btn-custom" data-toggle="modal" data-target="#recentTransaction"><i class="dripicons-clock"></i> Recent transaction</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- payment modal -->
            <div id="add-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">Finalize Sale</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-6 mt-1">
                                            <label>Received Amount *</label>
                                            <input type="text" name="paying_amount" class="form-control numkey" required step="any">
                                        </div>
                                        <div class="col-md-6 mt-1">
                                            <label>Paying Amount *</label>
                                            <input type="text" name="paid_amount" class="form-control numkey"  step="any">
                                        </div>
                                        <div class="col-md-6 mt-1">
                                            <label>Change : </label>
                                            <p id="change" class="ml-2">0.00</p>
                                        </div>
                                        <div class="col-md-6 mt-1">
                                            <input type="hidden" name="paid_by_id">
                                            <label>Paid By</label>
                                            <select name="paid_by_id_select" class="form-control selectpicker">
                                                <option value="1">Cash</option>
                                                <option value="2">Gift Card</option>
                                                <option value="3">Credit Card</option>
                                                <option value="4">Cheque</option>
                                                <option value="5">Paypal</option>
                                                <option value="6">Deposit</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12 mt-3">
                                            <div class="card-element form-control">
                                            </div>
                                            <div class="card-errors" role="alert"></div>
                                        </div>
                                        <div class="form-group col-md-12 gift-card">
                                            <label> Gift Card *</label>
                                            <input type="hidden" name="gift_card_id">
                                            <select id="gift_card_id_select" name="gift_card_id_select" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Gift Card..."></select>
                                        </div>
                                        <div class="form-group col-md-12 cheque">
                                            <label>Cheque Number *</label>
                                            <input type="text" name="cheque_no" class="form-control">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Payment Note</label>
                                            <textarea id="payment_note" rows="2" class="form-control" name="payment_note"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-6 form-group">
                                            <label>Sale Note</label>
                                            <textarea rows="3" class="form-control" name="sale_note"></textarea>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Staff Note</label>
                                            <textarea rows="3" class="form-control" name="staff_note"></textarea>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button id="submit-btn" type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <div class="col-md-2 qc" data-initial="1">
                                    <h4><strong>Quick Cash</strong></h4>
                                    <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="10" type="button">10</button>
                                    <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="20" type="button">20</button>
                                    <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="50" type="button">50</button>
                                    <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="100" type="button">100</button>
                                    <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="500" type="button">500</button>
                                    <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="1000" type="button">1000</button>
                                    <button class="btn btn-block btn-danger qc-btn sound-btn" data-amount="0" type="button">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- order_discount modal -->
            <div id="order-discount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Order Discount</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" name="order_discount" class="form-control numkey">
                            </div>
                            <button type="button" name="order_discount_btn" class="btn btn-primary" data-dismiss="modal">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- coupon modal -->
            <div id="coupon-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Coupon Code</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" id="coupon-code" class="form-control" placeholder="Type Coupon Code...">
                            </div>
                            <button type="button" class="btn btn-primary coupon-check" data-dismiss="modal">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- order_tax modal -->
            <div id="order-tax" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Order Tax</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="order_tax_rate">
                                <select class="form-control" name="order_tax_rate_select">
                                    <option value="0">No Tax</option>
                                                                    </select>
                            </div>
                            <button type="button" name="order_tax_btn" class="btn btn-primary" data-dismiss="modal">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- shipping_cost modal -->
            <div id="shipping-cost-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Shipping Cost</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" name="shipping_cost" class="form-control numkey" step="any">
                            </div>
                            <button type="button" name="shipping_cost_btn" class="btn btn-primary" data-dismiss="modal">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            
            </form>
            <!-- product list -->
            <div class="col-md-6">
                <div class="filter-window">
                    <div class="category mt-3">
                        <div class="row ml-2 mr-2 px-2">
                            <div class="col-7">Choose category</div>
                            <div class="col-5 text-right">
                                <span class="btn btn-default btn-sm">
                                    <i class="dripicons-cross"></i>
                                </span>
                            </div>
                        </div>
                        <div class="row ml-2 mt-3">
                                                        <div class="col-md-3 category-img text-center" data-category="1">
                                                                    <img  src="https://crm.essential-infotech.com/public/images/product/zummXD2dvAtI.png" />
                                                                <p class="text-center">A</p>
                            </div>
                                                        <div class="col-md-3 category-img text-center" data-category="2">
                                                                    <img  src="https://crm.essential-infotech.com/public/images/product/zummXD2dvAtI.png" />
                                                                <p class="text-center">b</p>
                            </div>
                                                        <div class="col-md-3 category-img text-center" data-category="3">
                                                                    <img  src="https://crm.essential-infotech.com/public/images/product/zummXD2dvAtI.png" />
                                                                <p class="text-center">C</p>
                            </div>
                                                        <div class="col-md-3 category-img text-center" data-category="4">
                                                                    <img  src="https://crm.essential-infotech.com/public/images/product/zummXD2dvAtI.png" />
                                                                <p class="text-center">D</p>
                            </div>
                                                        <div class="col-md-3 category-img text-center" data-category="5">
                                                                    <img  src="https://crm.essential-infotech.com/public/images/product/zummXD2dvAtI.png" />
                                                                <p class="text-center">hahaha</p>
                            </div>
                                                    </div>
                    </div>
                    <div class="brand mt-3">
                        <div class="row ml-2 mr-2 px-2">
                            <div class="col-7">Choose brand</div>
                            <div class="col-5 text-right">
                                <span class="btn btn-default btn-sm">
                                    <i class="dripicons-cross"></i>
                                </span>
                            </div>
                        </div>
                        <div class="row ml-2 mt-3">
                                                    </div>
                    </div>
                </div>
    			<div class="row">
                    <div class="col-md-4">
                        <button class="btn btn-block btn-primary" id="category-filter">Category</button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-block btn-info" id="brand-filter">Brand</button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-block btn-danger" id="featured-filter">Featured</button>
                    </div>
                    <div class="col-md-12 mt-1 table-container">
                        <table id="product-table" class="table no-shadow product-list">
                            <thead class="d-none">
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                                        </tbody>
                        </table>
                    </div>
            	</div>
            </div>
            <!-- product edit modal -->
            <div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 id="modal_header" class="modal-title"></h5>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="text" name="edit_qty" class="form-control numkey">
                                </div>
                                <div class="form-group">
                                    <label>Unit Discount</label>
                                    <input type="text" name="edit_discount" class="form-control numkey">
                                </div>
                                <div class="form-group">
                                    <label>Unit Price</label>
                                    <input type="text" name="edit_unit_price" class="form-control numkey" step="any">
                                </div>
                                                                    <div class="form-group">
                                        <label>Tax Rate</label>
                                        <select name="edit_tax_rate" class="form-control selectpicker">
                                                                                        <option value="0">No Tax</option>
                                                                                    </select>
                                    </div>
                                    <div id="edit_unit" class="form-group">
                                        <label>Product Unit</label>
                                        <select name="edit_unit" class="form-control selectpicker">
                                        </select>
                                    </div>
                                    <button type="button" name="update_btn" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- add customer modal -->
            <div id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                  <div class="modal-content">
                    <form method="POST" action="https://crm.essential-infotech.com/customer" accept-charset="UTF-8" enctype="multipart/form-data"><input name="_token" type="hidden" value="gIRlvZ4aAsBKfM7t7xEqFN1c59aXtTLerOI8jmQY">
                    <div class="modal-header">
                      <h5 id="exampleModalLabel" class="modal-title">Add Customer</h5>
                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                    </div>
                    <div class="modal-body">
                      <p class="italic"><small>The field labels marked with * are required input fields.</small></p>
                        <div class="form-group">
                            <label>Customer Group *</strong> </label>
                            <select required class="form-control selectpicker" name="customer_group_id">
                                                                    <option value="1">jndxbcj</option>
                                                            </select>
                        </div>
                        <div class="form-group">
                            <label>Name *</strong> </label>
                            <input type="text" name="name" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" placeholder="example@example.com" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Phone Number *</label>
                            <input type="text" name="phone_number" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Address *</label>
                            <input type="text" name="address" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>City *</label>
                            <input type="text" name="city" required class="form-control">
                        </div>
                        <div class="form-group">
                        <input type="hidden" name="pos" value="1">      
                          <input type="submit" value="Submit" class="btn btn-primary">
                        </div>
                    </div>
                    </form>
                  </div>
                </div>
            </div>
            <!-- recent transaction modal -->
            <div id="recentTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 id="exampleModalLabel" class="modal-title">Recent Transaction <div class="badge badge-primary">Latest 10</div></h5>
                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" href="#sale-latest" role="tab" data-toggle="tab">Sale</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#draft-latest" role="tab" data-toggle="tab">Draft</a>
                          </li>
                        </ul>
                        <div class="tab-content">
                          <div role="tabpanel" class="tab-pane show active" id="sale-latest">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th>Date</th>
                                      <th>Reference</th>
                                      <th>Customer</th>
                                      <th>Grand Total</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                                                      </tbody>
                                </table>
                              </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="draft-latest">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th>Date</th>
                                      <th>Reference</th>
                                      <th>Customer</th>
                                      <th>Grand Total</th>
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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
@endpush 

@push('custom-scripts')
<script src="{{ asset('backend/js/pos_template.js') }}"></script>
<script src="{{ asset('assets/js/data-table.js') }}"></script>
<script src="{{ asset('assets/js/form-validation.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
<script src="{{ asset('assets/js/inputmask.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
<script src="{{ asset('assets/js/typeahead.js') }}"></script>
<script src="{{ asset('assets/js/tags-input.js') }}"></script>
<script src="{{ asset('assets/js/dropzone.js') }}"></script>
<script src="{{ asset('assets/js/dropify.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-colorpicker.js') }}"></script>
<script src="{{ asset('assets/js/datepicker.js') }}"></script>
<script src="{{ asset('assets/js/timepicker.js') }}"></script>
@endpush
