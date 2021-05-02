@extends('layout.master') 
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
@endpush 
@section('content')
<body onload="myFunction()" data-new-gr-c-s-check-loaded="14.1005.0" data-gr-ext-installed="">
   <div id="loader" style="display: none;"></div>
   <div class="pos-page">
      <div style="display: block;" id="content" class="animate-bottom">
         <!-- Side Navbar -->
         <nav class="side-navbar shrink mCustomScrollbar _mCS_1">
            <div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0">
               <div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
                  <div class="side-navbar-wrapper">
                     <!-- Sidebar Header    -->
                     <!-- Sidebar Navigation Menus-->
                     <div class="main-menu">
                        <ul id="side-main-menu" class="side-menu list-unstyled">
                           <li><a href="https://www.pos.springsoftit.com"> <i class="dripicons-meter"></i><span>Dashboard</span></a></li>
                           <li>
                              <a href="#product" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-list"></i><span>Product</span><span></span></a>
                              <ul id="product" class="collapse list-unstyled ">
                                 <li id="category-menu"><a href="https://www.pos.springsoftit.com/category">Category</a></li>
                                 <li id="product-list-menu"><a href="https://www.pos.springsoftit.com/products">Product List</a></li>
                                 <li id="product-create-menu"><a href="https://www.pos.springsoftit.com/products/create">Add Product</a></li>
                                 <li id="printBarcode-menu"><a href="https://www.pos.springsoftit.com/products/print_barcode">Print Barcode</a></li>
                                 <li id="adjustment-list-menu"><a href="https://www.pos.springsoftit.com/qty_adjustment">Adjustment List</a></li>
                                 <li id="adjustment-create-menu"><a href="https://www.pos.springsoftit.com/qty_adjustment/create">Add Adjustment</a></li>
                                 <li id="stock-count-menu"><a href="https://www.pos.springsoftit.com/stock-count">Stock Count</a></li>
                              </ul>
                           </li>
                           <li>
                              <a href="#purchase" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-card"></i><span>Purchase</span></a>
                              <ul id="purchase" class="collapse list-unstyled ">
                                 <li id="purchase-list-menu"><a href="https://www.pos.springsoftit.com/purchases">Purchase List</a></li>
                                 <li id="purchase-create-menu"><a href="https://www.pos.springsoftit.com/purchases/create">Add Purchase</a></li>
                                 <li id="purchase-import-menu"><a href="https://www.pos.springsoftit.com/purchases/purchase_by_csv">Import Purchase By CSV</a></li>
                              </ul>
                           </li>
                           <li>
                              <a href="#sale" aria-expanded="true" data-toggle="collapse"> <i class="dripicons-cart"></i><span>Sale</span></a>
                              <ul id="sale" class="collapse list-unstyled show">
                                 <li id="sale-list-menu"><a href="https://www.pos.springsoftit.com/sales">Sale List</a></li>
                                 <li><a href="https://www.pos.springsoftit.com/pos">POS</a></li>
                                 <li id="sale-create-menu"><a href="https://www.pos.springsoftit.com/sales/create">Add Sale</a></li>
                                 <li id="sale-import-menu"><a href="https://www.pos.springsoftit.com/sales/sale_by_csv">Import Sale By CSV</a></li>
                                 <li id="gift-card-menu"><a href="https://www.pos.springsoftit.com/gift_cards">Gift Card List</a> </li>
                                 <li id="coupon-menu"><a href="https://www.pos.springsoftit.com/coupons">Coupon List</a> </li>
                                 <li id="delivery-menu"><a href="https://www.pos.springsoftit.com/delivery">Delivery List</a></li>
                              </ul>
                           </li>
                           <li>
                              <a href="#expense" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-wallet"></i><span>Expense</span></a>
                              <ul id="expense" class="collapse list-unstyled ">
                                 <li id="exp-cat-menu"><a href="https://www.pos.springsoftit.com/expense_categories">Expense Category</a></li>
                                 <li id="exp-list-menu"><a href="https://www.pos.springsoftit.com/expenses">Expense List</a></li>
                                 <li><a id="add-expense" href=""> Add Expense</a></li>
                              </ul>
                           </li>
                           <li>
                              <a href="#quotation" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-document"></i><span>Quotation</span><span></span></a>
                              <ul id="quotation" class="collapse list-unstyled ">
                                 <li id="quotation-list-menu"><a href="https://www.pos.springsoftit.com/quotations">Quotation List</a></li>
                                 <li id="quotation-create-menu"><a href="https://www.pos.springsoftit.com/quotations/create">Add Quotation</a></li>
                              </ul>
                           </li>
                           <li>
                              <a href="#transfer" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-export"></i><span>Transfer</span></a>
                              <ul id="transfer" class="collapse list-unstyled ">
                                 <li id="transfer-list-menu"><a href="https://www.pos.springsoftit.com/transfers">Transfer List</a></li>
                                 <li id="transfer-create-menu"><a href="https://www.pos.springsoftit.com/transfers/create">Add Transfer</a></li>
                                 <li id="transfer-import-menu"><a href="https://www.pos.springsoftit.com/transfers/transfer_by_csv">Import Transfer By CSV</a></li>
                              </ul>
                           </li>
                           <li>
                              <a href="#return" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-archive"></i><span>Return</span></a>
                              <ul id="return" class="collapse list-unstyled ">
                                 <li id="sale-return-menu"><a href="https://www.pos.springsoftit.com/return-sale">Sale</a></li>
                                 <li id="purchase-return-menu"><a href="https://www.pos.springsoftit.com/return-purchase">Purchase</a></li>
                              </ul>
                           </li>
                           <li class="">
                              <a href="#account" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-briefcase"></i><span>Accounting</span></a>
                              <ul id="account" class="collapse list-unstyled ">
                                 <li id="account-list-menu"><a href="https://www.pos.springsoftit.com/accounts">Account List</a></li>
                                 <li><a id="add-account" href="">Add Account</a></li>
                                 <li id="money-transfer-menu"><a href="https://www.pos.springsoftit.com/money-transfers">Money Transfer</a></li>
                                 <li id="balance-sheet-menu"><a href="https://www.pos.springsoftit.com/accounts/balancesheet">Balance Sheet</a></li>
                                 <li id="account-statement-menu"><a id="account-statement" href="">Account Statement</a></li>
                              </ul>
                           </li>
                           <li class="">
                              <a href="#hrm" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-user-group"></i><span>HRM</span></a>
                              <ul id="hrm" class="collapse list-unstyled ">
                                 <li id="dept-menu"><a href="https://www.pos.springsoftit.com/departments">Department</a></li>
                                 <li id="employee-menu"><a href="https://www.pos.springsoftit.com/employees">Employee</a></li>
                                 <li id="attendance-menu"><a href="https://www.pos.springsoftit.com/attendance">Attendance</a></li>
                                 <li id="payroll-menu"><a href="https://www.pos.springsoftit.com/payroll">Payroll</a></li>
                                 <li id="holiday-menu"><a href="https://www.pos.springsoftit.com/holidays">Holiday</a></li>
                              </ul>
                           </li>
                           <li>
                              <a href="#people" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-user"></i><span>People</span></a>
                              <ul id="people" class="collapse list-unstyled ">
                                 <li id="user-list-menu"><a href="https://www.pos.springsoftit.com/user">User List</a></li>
                                 <li id="user-create-menu"><a href="https://www.pos.springsoftit.com/user/create">Add User</a></li>
                                 <li id="customer-list-menu"><a href="https://www.pos.springsoftit.com/customer">Customer List</a></li>
                                 <li id="customer-create-menu"><a href="https://www.pos.springsoftit.com/customer/create">Add Customer</a></li>
                                 <li id="biller-list-menu"><a href="https://www.pos.springsoftit.com/biller">Biller List</a></li>
                                 <li id="biller-create-menu"><a href="https://www.pos.springsoftit.com/biller/create">Add Biller</a></li>
                                 <li id="supplier-list-menu"><a href="https://www.pos.springsoftit.com/supplier">Supplier List</a></li>
                                 <li id="supplier-create-menu"><a href="https://www.pos.springsoftit.com/supplier/create">Add Supplier</a></li>
                              </ul>
                           </li>
                           <li>
                              <a href="#report" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-document-remove"></i><span>Reports</span></a>
                              <ul id="report" class="collapse list-unstyled ">
                                 <li id="profit-loss-report-menu">
                                    <form method="POST" action="https://www.pos.springsoftit.com/report/profit_loss" accept-charset="UTF-8" id="profitLoss-report-form"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                       <input type="hidden" name="start_date" value="2021-04-01">
                                       <input type="hidden" name="end_date" value="2021-04-12">
                                       <a id="profitLoss-link" href="">Summary Report</a>
                                    </form>
                                 </li>
                                 <li id="best-seller-report-menu">
                                    <a href="https://www.pos.springsoftit.com/report/best_seller">Best Seller</a>
                                 </li>
                                 <li id="product-report-menu">
                                    <form method="POST" action="https://www.pos.springsoftit.com/report/product_report" accept-charset="UTF-8" id="product-report-form"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                       <input type="hidden" name="start_date" value="1988-04-18">
                                       <input type="hidden" name="end_date" value="2021-04-12">
                                       <input type="hidden" name="warehouse_id" value="0">
                                       <a id="report-link" href="">Product Report</a>
                                    </form>
                                 </li>
                                 <li id="daily-sale-report-menu">
                                    <a href="https://www.pos.springsoftit.com/report/daily_sale/2021/04">Daily Sale</a>
                                 </li>
                                 <li id="monthly-sale-report-menu">
                                    <a href="https://www.pos.springsoftit.com/report/monthly_sale/2021">Monthly Sale</a>
                                 </li>
                                 <li id="daily-purchase-report-menu">
                                    <a href="https://www.pos.springsoftit.com/report/daily_purchase/2021/04">Daily Purchase</a>
                                 </li>
                                 <li id="monthly-purchase-report-menu">
                                    <a href="https://www.pos.springsoftit.com/report/monthly_purchase/2021">Monthly Purchase</a>
                                 </li>
                                 <li id="sale-report-menu">
                                    <form method="POST" action="https://www.pos.springsoftit.com/report/sale_report" accept-charset="UTF-8" id="sale-report-form"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                       <input type="hidden" name="start_date" value="1988-04-18">
                                       <input type="hidden" name="end_date" value="2021-04-12">
                                       <input type="hidden" name="warehouse_id" value="0">
                                       <a id="sale-report-link" href="">Sale Report</a>
                                    </form>
                                 </li>
                                 <li id="payment-report-menu">
                                    <form method="POST" action="https://www.pos.springsoftit.com/report/payment_report_by_date" accept-charset="UTF-8" id="payment-report-form"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                       <input type="hidden" name="start_date" value="1988-04-18">
                                       <input type="hidden" name="end_date" value="2021-04-12">
                                       <a id="payment-report-link" href="">Payment Report</a>
                                    </form>
                                 </li>
                                 <li id="purchase-report-menu">
                                    <form method="POST" action="https://www.pos.springsoftit.com/report/purchase" accept-charset="UTF-8" id="purchase-report-form"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                       <input type="hidden" name="start_date" value="1988-04-18">
                                       <input type="hidden" name="end_date" value="2021-04-12">
                                       <input type="hidden" name="warehouse_id" value="0">
                                       <a id="purchase-report-link" href="">Purchase Report</a>
                                    </form>
                                 </li>
                                 <li id="warehouse-report-menu">
                                    <a id="warehouse-report-link" href="">Warehouse Report</a>
                                 </li>
                                 <li id="warehouse-stock-report-menu">
                                    <a href="https://www.pos.springsoftit.com/report/warehouse_stock">Warehouse Stock Chart</a>
                                 </li>
                                 <li id="qtyAlert-report-menu">
                                    <a href="https://www.pos.springsoftit.com/report/product_quantity_alert">Product Quantity Alert</a>
                                 </li>
                                 <li id="user-report-menu">
                                    <a id="user-report-link" href="">User Report</a>
                                 </li>
                                 <li id="customer-report-menu">
                                    <a id="customer-report-link" href="">Customer Report</a>
                                 </li>
                                 <li id="supplier-report-menu">
                                    <a id="supplier-report-link" href="">Supplier Report</a>
                                 </li>
                                 <li id="due-report-menu">
                                    <form method="POST" action="https://www.pos.springsoftit.com/report/due_report_by_date" accept-charset="UTF-8" id="due-report-form"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                       <input type="hidden" name="start_date" value="1988-04-18">
                                       <input type="hidden" name="end_date" value="2021-04-12">
                                       <a id="due-report-link" href="">Due Report</a>
                                    </form>
                                 </li>
                              </ul>
                           </li>
                           <li>
                              <a href="#setting" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-gear"></i><span>Settings</span></a>
                              <ul id="setting" class="collapse list-unstyled ">
                                 <li id="role-menu"><a href="https://www.pos.springsoftit.com/role">Role Permission</a></li>
                                 <li id="warehouse-menu"><a href="https://www.pos.springsoftit.com/warehouse">Warehouse</a></li>
                                 <li id="customer-group-menu"><a href="https://www.pos.springsoftit.com/customer_group">Customer Group</a></li>
                                 <li id="brand-menu"><a href="https://www.pos.springsoftit.com/brand">Brand</a></li>
                                 <li id="unit-menu"><a href="https://www.pos.springsoftit.com/unit">Unit</a></li>
                                 <li id="tax-menu"><a href="https://www.pos.springsoftit.com/tax">Tax</a></li>
                                 <li id="user-menu"><a href="https://www.pos.springsoftit.com/user/profile/1">User Profile</a></li>
                                 <li id="create-sms-menu"><a href="https://www.pos.springsoftit.com/setting/createsms">Create SMS</a></li>
                                 <li id="general-setting-menu"><a href="https://www.pos.springsoftit.com/setting/general_setting">General Setting</a></li>
                                 <li id="mail-setting-menu"><a href="https://www.pos.springsoftit.com/setting/mail_setting">Mail Setting</a></li>
                                 <li id="sms-setting-menu"><a href="https://www.pos.springsoftit.com/setting/sms_setting">SMS Setting</a></li>
                                 <li id="pos-setting-menu"><a href="https://www.pos.springsoftit.com/setting/pos_setting">POS Settings</a></li>
                                 <li id="hrm-setting-menu"><a href="https://www.pos.springsoftit.com/setting/hrm_setting"> HRM Setting</a></li>
                              </ul>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: block;">
                  <div class="mCSB_draggerContainer">
                     <div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px; display: block; height: 2px; max-height: 38.5938px;">
                        <div class="mCSB_dragger_bar" style="line-height: 30px;"></div>
                     </div>
                     <div class="mCSB_draggerRail"></div>
                  </div>
               </div>
            </div>
         </nav>
         <section class="forms pos-section">
            <div class="container-fluid">
               <div class="row">
                  <audio id="mysoundclip1" preload="auto">
                     <source src="https://www.pos.springsoftit.com/public/beep/beep-timber.mp3">
                  </audio>
                  <audio id="mysoundclip2" preload="auto">
                     <source src="https://www.pos.springsoftit.com/public/beep/beep-07.mp3">
                  </audio>
                  <div class="col-md-6">
                     <div class="card">
                        <div class="card-body" style="padding-bottom: 0">
                           <form method="POST" action="https://www.pos.springsoftit.com/sales" accept-charset="UTF-8" class="payment-form" enctype="multipart/form-data" _lpchecked="1">
                              <input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="row">
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <input type="hidden" name="warehouse_id_hidden" value="2">
                                             <div class="btn-group bootstrap-select form-control">
                                                <button type="button" class="btn dropdown-toggle btn-link" data-toggle="dropdown" role="button" data-id="warehouse_id" title="warehouse 2"><span class="filter-option pull-left">warehouse 2</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button>
                                                <div class="dropdown-menu open" role="combobox">
                                                   <div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off" role="textbox" aria-label="Search"></div>
                                                   <div class="dropdown-menu inner" role="listbox" aria-expanded="false"><a tabindex="0" class="dropdown-item" data-original-index="1"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">warehouse 1</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item selected" data-original-index="2"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="true"><span class="text">warehouse 2</span><span class="fa fa-check check-mark"></span></span></a></div>
                                                </div>
                                                <select required="" id="warehouse_id" name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse..." tabindex="-98">
                                                   <option class="bs-title-option" value="">Select warehouse...</option>
                                                   <option value="1">warehouse 1</option>
                                                   <option value="2">warehouse 2</option>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <input type="hidden" name="biller_id_hidden" value="1">
                                             <div class="btn-group bootstrap-select form-control">
                                                <button type="button" class="btn dropdown-toggle btn-link" data-toggle="dropdown" role="button" data-id="biller_id" title="yousuf (aks)"><span class="filter-option pull-left">yousuf (aks)</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button>
                                                <div class="dropdown-menu open" role="combobox">
                                                   <div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off" role="textbox" aria-label="Search"></div>
                                                   <div class="dropdown-menu inner" role="listbox" aria-expanded="false"><a tabindex="0" class="dropdown-item selected" data-original-index="1"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="true"><span class="text">yousuf (aks)</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="2"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">tariq (big tree)</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="3"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">modon (mogaTel)</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="4"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">x (x)</span><span class="fa fa-check check-mark"></span></span></a></div>
                                                </div>
                                                <select required="" id="biller_id" name="biller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Biller..." tabindex="-98">
                                                   <option class="bs-title-option" value="">Select Biller...</option>
                                                   <option value="1">yousuf (aks)</option>
                                                   <option value="2">tariq (big tree)</option>
                                                   <option value="5">modon (mogaTel)</option>
                                                   <option value="8">x (x)</option>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <input type="hidden" name="customer_id_hidden" value="11">
                                             <div class="input-group pos">
                                                <div class="btn-group bootstrap-select input-group-btn form-control">
                                                   <button type="button" class="btn dropdown-toggle btn-link" data-toggle="dropdown" role="button" data-id="customer_id" title="walk-in-customer (01923000001)"><span class="filter-option pull-left">walk-in-customer (01923000001)</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button>
                                                   <div class="dropdown-menu open" role="combobox">
                                                      <div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off" role="textbox" aria-label="Search"></div>
                                                      <div class="dropdown-menu inner" role="listbox" aria-expanded="false"><a tabindex="0" class="dropdown-item" data-original-index="1"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">moinul (+8801200000001)</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="2"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">tariq (3424)</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item selected" data-original-index="3"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="true"><span class="text">walk-in-customer (01923000001)</span><span class="fa fa-check check-mark"></span></span></a></div>
                                                   </div>
                                                   <select required="" name="customer_id" id="customer_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select customer..." style="width: 100px" tabindex="-98">
                                                      <option class="bs-title-option" value="">Select customer...</option>
                                                      <option value="2">moinul (+8801200000001)</option>
                                                      <option value="3">tariq (3424)</option>
                                                      <option value="11">walk-in-customer (01923000001)</option>
                                                   </select>
                                                </div>
                                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#addCustomer"><i class="dripicons-plus"></i></button>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-12">
                                          <div class="search-box form-group">
                                             <input type="text" name="product_code_name" id="lims_productcodeSearch" placeholder="Scan/Search product by name/code" class="form-control ui-autocomplete-input" autocomplete="off">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <div class="table-responsive transaction-list mCustomScrollbar _mCS_2">
                                          <div id="mCSB_2" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0">
                                             <div id="mCSB_2_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
                                                <table id="myTable" class="table table-hover table-striped order-list table-fixed ui-keyboard-input ui-widget-content ui-corner-all" aria-haspopup="true" role="textbox">
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
                                             <div id="mCSB_2_scrollbar_vertical" class="mCSB_scrollTools mCSB_2_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: block;">
                                                <div class="mCSB_draggerContainer">
                                                   <div id="mCSB_2_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px; height: 13px; display: block; max-height: 13.8438px;">
                                                      <div class="mCSB_dragger_bar" style="line-height: 30px;"></div>
                                                   </div>
                                                   <div class="mCSB_draggerRail"></div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row" style="display: none;">
                                       <div class="col-md-2">
                                          <div class="form-group">
                                             <input type="hidden" name="total_qty">
                                          </div>
                                       </div>
                                       <div class="col-md-2">
                                          <div class="form-group">
                                             <input type="hidden" name="total_discount" value="0.00">
                                          </div>
                                       </div>
                                       <div class="col-md-2">
                                          <div class="form-group">
                                             <input type="hidden" name="total_tax" value="0.00">
                                          </div>
                                       </div>
                                       <div class="col-md-2">
                                          <div class="form-group">
                                             <input type="hidden" name="total_price">
                                          </div>
                                       </div>
                                       <div class="col-md-2">
                                          <div class="form-group">
                                             <input type="hidden" name="item">
                                             <input type="hidden" name="order_tax">
                                          </div>
                                       </div>
                                       <div class="col-md-2">
                                          <div class="form-group">
                                             <input type="hidden" name="grand_total">
                                             <input type="hidden" name="coupon_discount">
                                             <input type="hidden" name="sale_status" value="1">
                                             <input type="hidden" name="coupon_active">
                                             <input type="hidden" name="coupon_id">
                                             <input type="hidden" name="coupon_discount">
                                             <input type="hidden" name="pos" value="1">
                                             <input type="hidden" name="draft" value="0">
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
                           </form>
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
                                          <input type="text" name="paying_amount" class="form-control numkey" required="" step="any">
                                       </div>
                                       <div class="col-md-6 mt-1">
                                          <label>Paying Amount *</label>
                                          <input type="text" name="paid_amount" class="form-control numkey" step="any">
                                       </div>
                                       <div class="col-md-6 mt-1">
                                          <label>Change : </label>
                                          <p id="change" class="ml-2">0.00</p>
                                       </div>
                                       <div class="col-md-6 mt-1">
                                          <input type="hidden" name="paid_by_id">
                                          <label>Paid By</label>
                                          <div class="btn-group bootstrap-select form-control">
                                             <button type="button" class="btn dropdown-toggle btn-link" data-toggle="dropdown" role="button" title="Cash"><span class="filter-option pull-left">Cash</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button>
                                             <div class="dropdown-menu open" role="combobox">
                                                <div class="dropdown-menu inner" role="listbox" aria-expanded="false"><a tabindex="0" class="dropdown-item selected" data-original-index="0"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="true"><span class="text">Cash</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="1"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">Gift Card</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="2"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">Credit Card</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="3"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">Cheque</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="4"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">Paypal</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="5"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">Deposit</span><span class="fa fa-check check-mark"></span></span></a></div>
                                             </div>
                                             <select name="paid_by_id_select" class="form-control selectpicker" tabindex="-98">
                                                <option value="1">Cash</option>
                                                <option value="2">Gift Card</option>
                                                <option value="3">Credit Card</option>
                                                <option value="4">Cheque</option>
                                                <option value="5">Paypal</option>
                                                <option value="6">Deposit</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="form-group col-md-12 mt-3">
                                          <div class="card-element form-control">
                                          </div>
                                          <div class="card-errors" role="alert"></div>
                                       </div>
                                       <div class="form-group col-md-12 gift-card">
                                          <label> Gift Card *</label>
                                          <input type="hidden" name="gift_card_id">
                                          <div class="btn-group bootstrap-select form-control">
                                             <button type="button" class="btn dropdown-toggle bs-placeholder btn-link" data-toggle="dropdown" role="button" data-id="gift_card_id_select" title="Select Gift Card..."><span class="filter-option pull-left">Select Gift Card...</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button>
                                             <div class="dropdown-menu open" role="combobox">
                                                <div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off" role="textbox" aria-label="Search"></div>
                                                <div class="dropdown-menu inner" role="listbox" aria-expanded="false"></div>
                                             </div>
                                             <select id="gift_card_id_select" name="gift_card_id_select" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Gift Card..." tabindex="-98">
                                                <option class="bs-title-option" value="">Select Gift Card...</option>
                                             </select>
                                          </div>
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
                                 <div class="btn-group bootstrap-select form-control">
                                    <button type="button" class="btn dropdown-toggle btn-link" data-toggle="dropdown" role="button" title="No Tax"><span class="filter-option pull-left">No Tax</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button>
                                    <div class="dropdown-menu open" role="combobox">
                                       <div class="dropdown-menu inner" role="listbox" aria-expanded="false"><a tabindex="0" class="dropdown-item selected" data-original-index="0"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="true"><span class="text">No Tax</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="1"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">vat@10</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="2"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">vat@15</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="3"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">vat 20</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="4"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">fdg</span><span class="fa fa-check check-mark"></span></span></a></div>
                                    </div>
                                    <select class="form-control" name="order_tax_rate_select" tabindex="-98">
                                       <option value="0">No Tax</option>
                                       <option value="10">vat@10</option>
                                       <option value="15">vat@15</option>
                                       <option value="20">vat 20</option>
                                       <option value="8">fdg</option>
                                    </select>
                                 </div>
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
                  <!-- product list -->
                  <div class="col-md-6">
                     <!-- navbar-->
                     
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
                                 <img src="https://www.pos.springsoftit.com/public/images/product/zummXD2dvAtI.png">
                                 <p class="text-center">Fruits</p>
                              </div>
                              <div class="col-md-3 category-img text-center" data-category="2">
                                 <img src="https://www.pos.springsoftit.com/public/images/product/zummXD2dvAtI.png">
                                 <p class="text-center">electronics</p>
                              </div>
                              <div class="col-md-3 category-img text-center" data-category="3">
                                 <img src="https://www.pos.springsoftit.com/public/images/category/20200701093146.jpg">
                                 <p class="text-center">computer</p>
                              </div>
                              <div class="col-md-3 category-img text-center" data-category="4">
                                 <img src="https://www.pos.springsoftit.com/public/images/product/zummXD2dvAtI.png">
                                 <p class="text-center">toy</p>
                              </div>
                              <div class="col-md-3 category-img text-center" data-category="9">
                                 <img src="https://www.pos.springsoftit.com/public/images/product/zummXD2dvAtI.png">
                                 <p class="text-center">food</p>
                              </div>
                              <div class="col-md-3 category-img text-center" data-category="16">
                                 <img src="https://www.pos.springsoftit.com/public/images/product/zummXD2dvAtI.png">
                                 <p class="text-center">desktop</p>
                              </div>
                              <div class="col-md-3 category-img text-center" data-category="19">
                                 <img src="https://www.pos.springsoftit.com/public/images/category/20210315083627.jpg">
                                 <p class="text-center">Fruit</p>
                              </div>
                              <div class="col-md-3 category-img text-center" data-category="20">
                                 <img src="https://www.pos.springsoftit.com/public/images/category/20210401050422.jpg">
                                 <p class="text-center">uiuyiuyi</p>
                              </div>
                              <div class="col-md-3 category-img text-center" data-category="21">
                                 <img src="https://www.pos.springsoftit.com/public/images/product/zummXD2dvAtI.png">
                                 <p class="text-center">Hp laptop</p>
                              </div>
                              <div class="col-md-3 category-img text-center" data-category="22">
                                 <img src="https://www.pos.springsoftit.com/public/images/category/20210404122402.jpeg">
                                 <p class="text-center">asasas</p>
                              </div>
                              <div class="col-md-3 category-img text-center" data-category="24">
                                 <img src="https://www.pos.springsoftit.com/public/images/product/zummXD2dvAtI.png">
                                 <p class="text-center">xxxx</p>
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
                              <div class="col-md-3 brand-img text-center" data-brand="3">
                                 <img src="https://www.pos.springsoftit.com/public/images/brand/HP.jpg">
                                 <p class="text-center">HP</p>
                              </div>
                              <div class="col-md-3 brand-img text-center" data-brand="4">
                                 <img src="https://www.pos.springsoftit.com/public/images/brand/samsung.jpg">
                                 <p class="text-center">samsung</p>
                              </div>
                              <div class="col-md-3 brand-img text-center" data-brand="5">
                                 <img src="https://www.pos.springsoftit.com/public/images/brand/Apple.jpg">
                                 <p class="text-center">Apple</p>
                              </div>
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
                        <div class="col-md-12 mt-1 table-container mCustomScrollbar _mCS_3">
                           <div id="mCSB_3" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0">
                              <div id="mCSB_3_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
                                 <div id="product-table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                    <table id="product-table" class="table no-shadow product-list dataTable no-footer" role="grid">
                                       <thead class="d-none">
                                          <tr role="row">
                                             <th class="sorting" tabindex="0" aria-controls="product-table" rowspan="1" colspan="1" aria-label=": activate to sort column ascending" style="width: 0px;"></th>
                                             <th class="sorting" tabindex="0" aria-controls="product-table" rowspan="1" colspan="1" aria-label=": activate to sort column ascending" style="width: 0px;"></th>
                                             <th class="sorting" tabindex="0" aria-controls="product-table" rowspan="1" colspan="1" aria-label=": activate to sort column ascending" style="width: 0px;"></th>
                                             <th class="sorting" tabindex="0" aria-controls="product-table" rowspan="1" colspan="1" aria-label=": activate to sort column ascending" style="width: 0px;"></th>
                                             <th class="sorting" tabindex="0" aria-controls="product-table" rowspan="1" colspan="1" aria-label=": activate to sort column ascending" style="width: 0px;"></th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr role="row" class="odd">
                                             <td class="product-img sound-btn" title="Mouse" data-product="63920719 (Mouse)">
                                                <img src="https://www.pos.springsoftit.com/public/images/product/toponemouse.jpg" width="100%" class="mCS_img_loaded">
                                                <p>Mouse</p>
                                                <span>63920719</span>
                                             </td>
                                             <td class="product-img sound-btn" title="mango" data-product="72782608 (mango)">
                                                <img src="https://www.pos.springsoftit.com/public/images/product/mango.jpg" width="100%" class="mCS_img_loaded">
                                                <p>mango</p>
                                                <span>72782608</span>
                                             </td>
                                             <td class="product-img sound-btn" title="Earphone" data-product="85415108 (Earphone)">
                                                <img src="https://www.pos.springsoftit.com/public/images/product/airphonesamsung.jpg" width="100%" class="mCS_img_loaded">
                                                <p>Earphone</p>
                                                <span>85415108</span>
                                             </td>
                                             <td class="product-img sound-btn" title="lychee" data-product="38314290 (lychee)">
                                                <img src="https://www.pos.springsoftit.com/public/images/product/lychee.jpg" width="100%" class="mCS_img_loaded">
                                                <p>lychee</p>
                                                <span>38314290</span>
                                             </td>
                                             <td class="product-img sound-btn" title="Baby doll" data-product="31261512 (Baby doll)">
                                                <img src="https://www.pos.springsoftit.com/public/images/product/lalacrybabydoll.jpg" width="100%" class="mCS_img_loaded">
                                                <p>Baby doll</p>
                                                <span>31261512</span>
                                             </td>
                                          </tr>
                                          <tr role="row" class="even">
                                             <td class="product-img sound-btn" title="ldms" data-product="40624536 (ldms)">
                                                <img src="https://www.pos.springsoftit.com/public/images/product/ldms.jpg" width="100%" class="mCS_img_loaded">
                                                <p>ldms</p>
                                                <span>40624536</span>
                                             </td>
                                             <td class="product-img sound-btn" title="iphone-X" data-product="97103461 (iphone-X)">
                                                <img src="https://www.pos.springsoftit.com/public/images/product/iphoneX.jpg" width="100%" class="mCS_img_loaded">
                                                <p>iphone-X</p>
                                                <span>97103461</span>
                                             </td>
                                             <td class="product-img sound-btn" title="doll" data-product="16905612 (doll)">
                                                <img src="https://www.pos.springsoftit.com/public/images/product/1615819113976download.jpg" width="100%" class="mCS_img_loaded">
                                                <p>doll</p>
                                                <span>16905612</span>
                                             </td>
                                             <td class="product-img sound-btn" title="hp monitor" data-product="124 (hp monitor)">
                                                <img src="https://www.pos.springsoftit.com/public/images/product/zummXD2dvAtI.png" width="100%" class="mCS_img_loaded">
                                                <p>hp monitor</p>
                                                <span>124</span>
                                             </td>
                                             <td style="border:none;"></td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <div class="dataTables_paginate paging_simple_numbers" id="product-table_paginate">
                                       <ul class="pagination">
                                          <li class="paginate_button page-item previous disabled" id="product-table_previous"><a href="#" aria-controls="product-table" data-dt-idx="0" tabindex="0" class="page-link"><i class="fa fa-angle-left"></i></a></li>
                                          <li class="paginate_button page-item active"><a href="#" aria-controls="product-table" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                          <li class="paginate_button page-item next disabled" id="product-table_next"><a href="#" aria-controls="product-table" data-dt-idx="2" tabindex="0" class="page-link"><i class="fa fa-angle-right"></i></a></li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                              <div id="mCSB_3_scrollbar_vertical" class="mCSB_scrollTools mCSB_3_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: block;">
                                 <div class="mCSB_draggerContainer">
                                    <div id="mCSB_3_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px; height: 4px; display: block; max-height: 29.75px;">
                                       <div class="mCSB_dragger_bar" style="line-height: 30px;"></div>
                                    </div>
                                    <div class="mCSB_draggerRail"></div>
                                 </div>
                              </div>
                           </div>
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
                                    <div class="btn-group bootstrap-select form-control">
                                       <button type="button" class="btn dropdown-toggle btn-link" data-toggle="dropdown" role="button" title="No Tax"><span class="filter-option pull-left">No Tax</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button>
                                       <div class="dropdown-menu open" role="combobox">
                                          <div class="dropdown-menu inner" role="listbox" aria-expanded="false"><a tabindex="0" class="dropdown-item selected" data-original-index="0"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="true"><span class="text">No Tax</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="1"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">vat@10</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="2"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">vat@15</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="3"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">vat 20</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="4"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">fdg</span><span class="fa fa-check check-mark"></span></span></a></div>
                                       </div>
                                       <select name="edit_tax_rate" class="form-control selectpicker" tabindex="-98">
                                          <option value="0">No Tax</option>
                                          <option value="1">vat@10</option>
                                          <option value="2">vat@15</option>
                                          <option value="3">vat 20</option>
                                          <option value="4">fdg</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div id="edit_unit" class="form-group">
                                    <label>Product Unit</label>
                                    <div class="btn-group bootstrap-select form-control">
                                       <button type="button" class="btn dropdown-toggle bs-placeholder btn-link" data-toggle="dropdown" role="button" title="Nothing selected"><span class="filter-option pull-left">Nothing selected</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button>
                                       <div class="dropdown-menu open" role="combobox">
                                          <div class="dropdown-menu inner" role="listbox" aria-expanded="false"></div>
                                       </div>
                                       <select name="edit_unit" class="form-control selectpicker" tabindex="-98">
                                       </select>
                                    </div>
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
                           <form method="POST" action="https://www.pos.springsoftit.com/customer" accept-charset="UTF-8" enctype="multipart/form-data">
                              <input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                              <div class="modal-header">
                                 <h5 id="exampleModalLabel" class="modal-title">Add Customer</h5>
                                 <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                              </div>
                              <div class="modal-body">
                                 <p class="italic"><small>The field labels marked with * are required input fields.</small></p>
                                 <div class="form-group">
                                    <label>Customer Group * </label>
                                    <div class="btn-group bootstrap-select form-control">
                                       <button type="button" class="btn dropdown-toggle btn-link" data-toggle="dropdown" role="button" title="general"><span class="filter-option pull-left">general</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button>
                                       <div class="dropdown-menu open" role="combobox">
                                          <div class="dropdown-menu inner" role="listbox" aria-expanded="false"><a tabindex="0" class="dropdown-item selected" data-original-index="0"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="true"><span class="text">general</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="1"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">distributor</span><span class="fa fa-check check-mark"></span></span></a><a tabindex="0" class="dropdown-item" data-original-index="2"><span class="dropdown-item-inner " data-tokens="null" role="option" tabindex="0" aria-disabled="false" aria-selected="false"><span class="text">reseller</span><span class="fa fa-check check-mark"></span></span></a></div>
                                       </div>
                                       <select required="" class="form-control selectpicker" name="customer_group_id" tabindex="-98">
                                          <option value="1">general</option>
                                          <option value="2">distributor</option>
                                          <option value="3">reseller</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label>Name * </label>
                                    <input type="text" name="name" required="" class="form-control">
                                 </div>
                                 <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" placeholder="example@example.com" class="form-control">
                                 </div>
                                 <div class="form-group">
                                    <label>Phone Number *</label>
                                    <input type="text" name="phone_number" required="" class="form-control">
                                 </div>
                                 <div class="form-group">
                                    <label>Address *</label>
                                    <input type="text" name="address" required="" class="form-control">
                                 </div>
                                 <div class="form-group">
                                    <label>City *</label>
                                    <input type="text" name="city" required="" class="form-control">
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
                              <h5 id="exampleModalLabel" class="modal-title">
                                 Recent Transaction 
                                 <div class="badge badge-primary">Latest 10</div>
                              </h5>
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
                                             <tr>
                                                <td>11-04-2021</td>
                                                <td>sr-20210411-020000</td>
                                                <td>tariq</td>
                                                <td>574</td>
                                                <td>
                                                   <div class="btn-group">
                                                      <a href="https://www.pos.springsoftit.com/sales/243/edit" class="btn btn-success btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp;
                                                      <form method="POST" action="https://www.pos.springsoftit.com/sales/243" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>
                                                      </form>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>10-04-2021</td>
                                                <td>sr-20210410-125051</td>
                                                <td>moinul</td>
                                                <td>443.6</td>
                                                <td>
                                                   <div class="btn-group">
                                                      <a href="https://www.pos.springsoftit.com/sales/242/edit" class="btn btn-success btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp;
                                                      <form method="POST" action="https://www.pos.springsoftit.com/sales/242" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>
                                                      </form>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>09-04-2021</td>
                                                <td>posr-20210409-091129</td>
                                                <td>moinul</td>
                                                <td>525.6</td>
                                                <td>
                                                   <div class="btn-group">
                                                      <a href="https://www.pos.springsoftit.com/sales/241/edit" class="btn btn-success btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp;
                                                      <form method="POST" action="https://www.pos.springsoftit.com/sales/241" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>
                                                      </form>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>07-04-2021</td>
                                                <td>posr-20210407-110021</td>
                                                <td>walk-in-customer</td>
                                                <td>977</td>
                                                <td>
                                                   <div class="btn-group">
                                                      <a href="https://www.pos.springsoftit.com/sales/239/edit" class="btn btn-success btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp;
                                                      <form method="POST" action="https://www.pos.springsoftit.com/sales/239" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>
                                                      </form>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>07-04-2021</td>
                                                <td>posr-20210407-105953</td>
                                                <td>walk-in-customer</td>
                                                <td>878</td>
                                                <td>
                                                   <div class="btn-group">
                                                      <a href="https://www.pos.springsoftit.com/sales/238/edit" class="btn btn-success btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp;
                                                      <form method="POST" action="https://www.pos.springsoftit.com/sales/238" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>
                                                      </form>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>06-04-2021</td>
                                                <td>posr-20210406-081816</td>
                                                <td>walk-in-customer</td>
                                                <td>444</td>
                                                <td>
                                                   <div class="btn-group">
                                                      <a href="https://www.pos.springsoftit.com/sales/237/edit" class="btn btn-success btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp;
                                                      <form method="POST" action="https://www.pos.springsoftit.com/sales/237" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>
                                                      </form>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>05-04-2021</td>
                                                <td>posr-20210405-090212</td>
                                                <td>walk-in-customer</td>
                                                <td>14</td>
                                                <td>
                                                   <div class="btn-group">
                                                      <a href="https://www.pos.springsoftit.com/sales/236/edit" class="btn btn-success btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp;
                                                      <form method="POST" action="https://www.pos.springsoftit.com/sales/236" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>
                                                      </form>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>04-04-2021</td>
                                                <td>posr-20210404-060333</td>
                                                <td>dhiman</td>
                                                <td>144</td>
                                                <td>
                                                   <div class="btn-group">
                                                      <a href="https://www.pos.springsoftit.com/sales/234/edit" class="btn btn-success btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp;
                                                      <form method="POST" action="https://www.pos.springsoftit.com/sales/234" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>
                                                      </form>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>04-04-2021</td>
                                                <td>posr-20210404-060331</td>
                                                <td>dhiman</td>
                                                <td>144</td>
                                                <td>
                                                   <div class="btn-group">
                                                      <a href="https://www.pos.springsoftit.com/sales/233/edit" class="btn btn-success btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp;
                                                      <form method="POST" action="https://www.pos.springsoftit.com/sales/233" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>
                                                      </form>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>04-04-2021</td>
                                                <td>posr-20210404-060256</td>
                                                <td>walk-in-customer</td>
                                                <td>880</td>
                                                <td>
                                                   <div class="btn-group">
                                                      <a href="https://www.pos.springsoftit.com/sales/232/edit" class="btn btn-success btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp;
                                                      <form method="POST" action="https://www.pos.springsoftit.com/sales/232" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>
                                                      </form>
                                                   </div>
                                                </td>
                                             </tr>
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
                                             <tr>
                                                <td>09-04-2021</td>
                                                <td>posr-20210409-091002</td>
                                                <td>walk-in-customer</td>
                                                <td>704</td>
                                                <td>
                                                   <div class="btn-group">
                                                      <a href="https://www.pos.springsoftit.com/sales/240/create" class="btn btn-success btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp;
                                                      <form method="POST" action="https://www.pos.springsoftit.com/sales/240" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>
                                                      </form>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>05-04-2021</td>
                                                <td>posr-20210405-085517</td>
                                                <td>walk-in-customer</td>
                                                <td>538</td>
                                                <td>
                                                   <div class="btn-group">
                                                      <a href="https://www.pos.springsoftit.com/sales/235/create" class="btn btn-success btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp;
                                                      <form method="POST" action="https://www.pos.springsoftit.com/sales/235" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>
                                                      </form>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>04-04-2021</td>
                                                <td>posr-20210404-111704</td>
                                                <td>walk-in-customer</td>
                                                <td>1244</td>
                                                <td>
                                                   <div class="btn-group">
                                                      <a href="https://www.pos.springsoftit.com/sales/231/create" class="btn btn-success btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp;
                                                      <form method="POST" action="https://www.pos.springsoftit.com/sales/231" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>
                                                      </form>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>07-02-2019</td>
                                                <td>posr-20190207-111542</td>
                                                <td>walk-in-customer</td>
                                                <td>440</td>
                                                <td>
                                                   <div class="btn-group">
                                                      <a href="https://www.pos.springsoftit.com/sales/118/create" class="btn btn-success btn-sm" title="Edit"><i class="dripicons-document-edit"></i></a>&nbsp;
                                                      <form method="POST" action="https://www.pos.springsoftit.com/sales/118" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="p43zciYUmZICHLWLKh7em1EZom4YGFJ9kzEjGdnr">
                                                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()" title="Delete"><i class="dripicons-trash"></i></button>
                                                      </form>
                                                   </div>
                                                </td>
                                             </tr>
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
         <script type="text/javascript">
            $("ul#sale").siblings('a').attr('aria-expanded','true');
            $("ul#sale").addClass("show");
            $("ul#sale #sale-pos-menu").addClass("active");
            
            
            // $( document ).ready(function() {
            //     $("#lims_productcodeSearch").focus();
            // });
            
            var public_key = "pk_test_ITN7KOYiIsHSCQ0UMRcgaYUB";
            var valid;
            
            // array data depend on warehouse
            var lims_product_array = [];
            var product_code = [];
            var product_name = [];
            var product_qty = [];
            var product_type = [];
            var product_id = [];
            var product_list = [];
            var qty_list = [];
            
            // array data with selection
            var product_price = [];
            var product_discount = [];
            var tax_rate = [];
            var tax_name = [];
            var tax_method = [];
            var unit_name = [];
            var unit_operator = [];
            var unit_operation_value = [];
            var gift_card_amount = [];
            var gift_card_expense = [];
            
            // temporary array
            var temp_unit_name = [];
            var temp_unit_operator = [];
            var temp_unit_operation_value = [];
            
            var deposit = {"2":80,"3":0,"11":0};
            var product_row_number = "4";
            var rowindex;
            var customer_group_rate;
            var row_product_price;
            var pos;
            var keyboard_active = "0";
            var role_id = "1";
            var warehouse_id = null;
            var biller_id = null;
            var coupon_list = [{"id":1,"code":"sonar bangla","type":"percentage","amount":"20","minimum_amount":"0","quantity":"100","used":"3","expired_date":"2020-03-31","user_id":"1","is_active":"1","created_at":"2018-10-26 06:38:50","updated_at":"2020-03-11 18:46:41"},{"id":2,"code":"i love bangladesh","type":"fixed","amount":"200","minimum_amount":"1000","quantity":"50","used":"1","expired_date":"2018-12-31","user_id":"1","is_active":"1","created_at":"2018-10-27 10:59:26","updated_at":"2019-03-02 13:46:48"}];
            var currency = "BDT";
            
            $('.selectpicker').selectpicker({
            style: 'btn-link',
            });
            
            if(keyboard_active==1){
            
            $("input.numkey:text").keyboard({
                usePreview: false,
                layout: 'custom',
                display: {
                'accept'  : '&#10004;',
                'cancel'  : '&#10006;'
                },
                customLayout : {
                  'normal' : ['1 2 3', '4 5 6', '7 8 9','0 {dec} {bksp}','{clear} {cancel} {accept}']
                },
                restrictInput : true, // Prevent keys not in the displayed keyboard from being typed in
                preventPaste : true,  // prevent ctrl-v and right click
                autoAccept : true,
                css: {
                    // input & preview
                    // keyboard container
                    container: 'center-block dropdown-menu', // jumbotron
                    // default state
                    buttonDefault: 'btn btn-default',
                    // hovered button
                    buttonHover: 'btn-primary',
                    // Action keys (e.g. Accept, Cancel, Tab, etc);
                    // this replaces "actionClass" option
                    buttonAction: 'active'
                },
            });
            
            $('input[type="text"]').keyboard({
                usePreview: false,
                autoAccept: true,
                autoAcceptOnEsc: true,
                css: {
                    // input & preview
                    // keyboard container
                    container: 'center-block dropdown-menu', // jumbotron
                    // default state
                    buttonDefault: 'btn btn-default',
                    // hovered button
                    buttonHover: 'btn-primary',
                    // Action keys (e.g. Accept, Cancel, Tab, etc);
                    // this replaces "actionClass" option
                    buttonAction: 'active',
                    // used when disabling the decimal button {dec}
                    // when a decimal exists in the input area
                    buttonDisabled: 'disabled'
                },
                change: function(e, keyboard) {
                        keyboard.$el.val(keyboard.$preview.val())
                        keyboard.$el.trigger('propertychange')        
                      }
            });
            
            $('textarea').keyboard({
                usePreview: false,
                autoAccept: true,
                autoAcceptOnEsc: true,
                css: {
                    // input & preview
                    // keyboard container
                    container: 'center-block dropdown-menu', // jumbotron
                    // default state
                    buttonDefault: 'btn btn-default',
                    // hovered button
                    buttonHover: 'btn-primary',
                    // Action keys (e.g. Accept, Cancel, Tab, etc);
                    // this replaces "actionClass" option
                    buttonAction: 'active',
                    // used when disabling the decimal button {dec}
                    // when a decimal exists in the input area
                    buttonDisabled: 'disabled'
                },
                change: function(e, keyboard) {
                        keyboard.$el.val(keyboard.$preview.val())
                        keyboard.$el.trigger('propertychange')        
                      }
            });
            
            $('#lims_productcodeSearch').keyboard().autocomplete().addAutocomplete({
                // add autocomplete window positioning
                // options here (using position utility)
                position: {
                  of: '#lims_productcodeSearch',
                  my: 'top+18px',
                  at: 'center',
                  collision: 'flip'
                }
            });
            }
            
            if(role_id > 2){
            $('#biller_id').addClass('d-none');
            $('#warehouse_id').addClass('d-none');
            $('select[name=warehouse_id]').val(warehouse_id);
            $('select[name=biller_id]').val(biller_id);
            }
            else{
            $('select[name=warehouse_id]').val($("input[name='warehouse_id_hidden']").val());
            $('select[name=biller_id]').val($("input[name='biller_id_hidden']").val());
            }
            
            $('select[name=customer_id]').val($("input[name='customer_id_hidden']").val());
            $('.selectpicker').selectpicker('refresh');
            
            var id = $("#customer_id").val();
            $.get('sales/getcustomergroup/' + id, function(data) {
            customer_group_rate = (data / 100);
            });
            
            var id = $("#warehouse_id").val();
            $.get('pos/getproduct/' + id, function(data) {
                console.log(data);
            lims_product_array = [];
            product_code = data[0];
            product_name = data[1];
            product_qty = data[2];
            product_type = data[3];
            product_id = data[4];
            product_list = data[5];
            qty_list = data[6];
            $.each(product_code, function(index) {
                lims_product_array.push(product_code[index] + ' (' + product_name[index] + ')');
            });
            });
            
            if(keyboard_active==1){
            $('#lims_productcodeSearch').bind('keyboardChange', function (e, keyboard, el) {
                var customer_id = $('#customer_id').val();
                var warehouse_id = $('select[name="warehouse_id"]').val();
                temp_data = $('#lims_productcodeSearch').val();
                if(!customer_id){
                    $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                    alert('Please select Customer!');
                }
                else if(!warehouse_id){
                    $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                    alert('Please select Warehouse!');
                }
            });
            }
            else{
            $('#lims_productcodeSearch').on('input', function(){
                var customer_id = $('#customer_id').val();
                var warehouse_id = $('#warehouse_id').val();
                temp_data = $('#lims_productcodeSearch').val();
                if(!customer_id){
                    $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                    alert('Please select Customer!');
                }
                else if(!warehouse_id){
                    $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
                    alert('Please select Warehouse!');
                }
            
            });
            }
            
            $("#print-btn").on("click", function(){
              var divToPrint=document.getElementById('sale-details');
              var newWin=window.open('','Print-Window');
              newWin.document.open();
              newWin.document.write('<link rel="stylesheet" href="https://www.pos.springsoftit.com/public/vendor/bootstrap/css/bootstrap.min.css" type="text/css"><style type="text/css">@media  print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
              newWin.document.close();
              setTimeout(function(){newWin.close();},10);
            });
            
            $('body').on('click', function(e){
            $('.filter-window').hide('slide', {direction: 'right'}, 'fast');
            });
            
            $('#category-filter').on('click', function(e){
            e.stopPropagation();
            $('.filter-window').show('slide', {direction: 'right'}, 'fast');
            $('.category').show();
            $('.brand').hide();
            });
            
            $('.category-img').on('click', function(){
            var category_id = $(this).data('category');
            var brand_id = 0;
            
            $(".table-container").children().remove();
            $.get('sales/getproduct/' + category_id + '/' + brand_id, function(data) {
                populateProduct(data);
            });
            });
            
            $('#brand-filter').on('click', function(e){
            e.stopPropagation();
            $('.filter-window').show('slide', {direction: 'right'}, 'fast');
            $('.brand').show();
            $('.category').hide();
            });
            
            $('.brand-img').on('click', function(){
            var brand_id = $(this).data('brand');
            var category_id = 0;
            
            $(".table-container").children().remove();
            $.get('sales/getproduct/' + category_id + '/' + brand_id, function(data) {
                populateProduct(data);
            });
            });
            
            $('#featured-filter').on('click', function(){
            $(".table-container").children().remove();
            $.get('sales/getfeatured', function(data) {
                populateProduct(data);
            });
            });
            
            function populateProduct(data) {
            var tableData = '<table id="product-table" class="table no-shadow product-list"> <thead class="d-none"> <tr> <th></th> <th></th> <th></th> <th></th> <th></th> </tr></thead> <tbody><tr>';
            
            if (Object.keys(data).length != 0) {
                $.each(data['name'], function(index) {
                    var product_info = data['code'][index]+' (' + data['name'][index] + ')';
                    if(index % 5 == 0 && index != 0)
                        tableData += '</tr><tr><td class="product-img sound-btn" title="'+data['name'][index]+'" data-product = "'+product_info+'"><img  src="public/images/product/'+data['image'][index]+'" width="100%" /><p>'+data['name'][index]+'</p><span>'+data['code'][index]+'</span></td>';
                    else
                        tableData += '<td class="product-img sound-btn" title="'+data['name'][index]+'" data-product = "'+product_info+'"><img  src="public/images/product/'+data['image'][index]+'" width="100%" /><p>'+data['name'][index]+'</p><span>'+data['code'][index]+'</span></td>';
                });
            
                if(data['name'].length % 5){
                    var number = 5 - (data['name'].length % 5);
                    while(number > 0)
                    {
                        tableData += '<td style="border:none;"></td>';
                        number--;
                    }
                }
            
                tableData += '</tr></tbody></table>';
                $(".table-container").html(tableData);
                $('#product-table').DataTable( {
                  "order": [],
                  'pageLength': product_row_number,
                   'language': {
                      'paginate': {
                          'previous': '<i class="fa fa-angle-left"></i>',
                          'next': '<i class="fa fa-angle-right"></i>'
                      }
                  },
                  dom: 'tp'
                });
                $('table.product-list').hide();
                $('table.product-list').show(500);
            }
            else{
                tableData += '<td class="text-center">No data avaialable</td></tr></tbody></table>'
                $(".table-container").html(tableData);
            }
            }
            
            $('select[name="customer_id"]').on('change', function() {
            var id = $(this).val();
            $.get('sales/getcustomergroup/' + id, function(data) {
                customer_group_rate = (data / 100);
            });
            });
            
            $('select[name="warehouse_id"]').on('change', function() {
            var id = $(this).val();
            $.get('sales/getproduct/' + id, function(data) {
                lims_product_array = [];
                product_code = data[0];
                product_name = data[1];
                product_qty = data[2];
                product_type = data[3];
                $.each(product_code, function(index) {
                    lims_product_array.push(product_code[index] + ' (' + product_name[index] + ')');
                });
            });
            });
            
            var lims_productcodeSearch = $('#lims_productcodeSearch');
            
            lims_productcodeSearch.autocomplete({
            source: function(request, response) {
                var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
                response($.grep(lims_product_array, function(item) {
                    return matcher.test(item);
                }));
            },
            response: function(event, ui) {
                if (ui.content.length == 1) {
                    var data = ui.content[0].value;
                    $(this).autocomplete( "close" );
                    productSearch(data);
                };
            },
            select: function(event, ui) {
                var data = ui.item.value;
                productSearch(data);
            },
            });
            
            $('#myTable').keyboard({
                accepted : function(event, keyboard, el) {
                    checkQuantity(el.value, true);
              }
            });
            
            $("#myTable").on('click', '.plus', function() {
            rowindex = $(this).closest('tr').index();
            var qty = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val()) + 1;
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
            checkQuantity(String(qty), true);
            });
            
            $("#myTable").on('click', '.minus', function() {
            rowindex = $(this).closest('tr').index();
            var qty = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val()) - 1;
            if (qty > 0) {
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
            } else {
                qty = 1;
            }
            checkQuantity(String(qty), true);
            });
            
            //Change quantity
            $("#myTable").on('input', '.qty', function() {
            rowindex = $(this).closest('tr').index();
            if($(this).val() < 1 && $(this).val() != '') {
              $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(1);
              alert("Quantity can't be less than 1");
            }
            checkQuantity($(this).val(), true);
            });
            
            $("#myTable").on('click', '.qty', function() {
            rowindex = $(this).closest('tr').index();
            });
            
            $(document).on('click', '.sound-btn', function() {
            var audio = $("#mysoundclip1")[0];
            audio.play();
            });
            
            $(document).on('click', '.product-img', function() {
            var customer_id = $('#customer_id').val();
            var warehouse_id = $('select[name="warehouse_id"]').val();
            if(!customer_id)
                alert('Please select Customer!');
            else if(!warehouse_id)
                alert('Please select Warehouse!');
            else{
                var data = $(this).data('product');
                data = data.split(" ");
                pos = product_code.indexOf(data[0]);
                alert(pos);
                if(pos < 0)
                    alert('Productxx is not avaialable in the selected warehouse');
                else{
                    productSearch(data[0]);
                }
            }
            });
            //Delete product
            $("table.order-list tbody").on("click", ".ibtnDel", function(event) {
            var audio = $("#mysoundclip2")[0];
            audio.play();
            rowindex = $(this).closest('tr').index();
            product_price.splice(rowindex, 1);
            product_discount.splice(rowindex, 1);
            tax_rate.splice(rowindex, 1);
            tax_name.splice(rowindex, 1);
            tax_method.splice(rowindex, 1);
            unit_name.splice(rowindex, 1);
            unit_operator.splice(rowindex, 1);
            unit_operation_value.splice(rowindex, 1);
            $(this).closest("tr").remove();
            calculateTotal();
            });
            
            //Edit product
            $("table.order-list").on("click", ".edit-product", function() {
            rowindex = $(this).closest('tr').index();
            edit();
            });
            
            //Update product
            $('button[name="update_btn"]').on("click", function() {
            var edit_discount = $('input[name="edit_discount"]').val();
            var edit_qty = $('input[name="edit_qty"]').val();
            var edit_unit_price = $('input[name="edit_unit_price"]').val();
            
            if (parseFloat(edit_discount) > parseFloat(edit_unit_price)) {
                alert('Invalid Discount Input!');
                return;
            }
            
            if(edit_qty < 1) {
                $('input[name="edit_qty"]').val(1);
                edit_qty = 1;
                alert("Quantity can't be less than 1");
            }
            
            var tax_rate_all = [0,"10","15","20","8"];
            
            tax_rate[rowindex] = parseFloat(tax_rate_all[$('select[name="edit_tax_rate"]').val()]);
            tax_name[rowindex] = $('select[name="edit_tax_rate"] option:selected').text();
            
            product_discount[rowindex] = $('input[name="edit_discount"]').val();
            if(product_type[pos] == 'standard'){
                var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
                var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(","));
                if (row_unit_operator == '*') {
                    product_price[rowindex] = $('input[name="edit_unit_price"]').val() / row_unit_operation_value;
                } else {
                    product_price[rowindex] = $('input[name="edit_unit_price"]').val() * row_unit_operation_value;
                }
                var position = $('select[name="edit_unit"]').val();
                var temp_operator = temp_unit_operator[position];
                var temp_operation_value = temp_unit_operation_value[position];
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sale-unit').val(temp_unit_name[position]);
                temp_unit_name.splice(position, 1);
                temp_unit_operator.splice(position, 1);
                temp_unit_operation_value.splice(position, 1);
            
                temp_unit_name.unshift($('select[name="edit_unit"] option:selected').text());
                temp_unit_operator.unshift(temp_operator);
                temp_unit_operation_value.unshift(temp_operation_value);
            
                unit_name[rowindex] = temp_unit_name.toString() + ',';
                unit_operator[rowindex] = temp_unit_operator.toString() + ',';
                unit_operation_value[rowindex] = temp_unit_operation_value.toString() + ',';
            }
            checkQuantity(edit_qty, false);
            });
            
            $('button[name="order_discount_btn"]').on("click", function() {
            calculateGrandTotal();
            });
            
            $('button[name="shipping_cost_btn"]').on("click", function() {
            calculateGrandTotal();
            });
            
            $('button[name="order_tax_btn"]').on("click", function() {
            calculateGrandTotal();
            });
            
            $(".coupon-check").on("click",function() {
            couponDiscount();
            });
            
            $(".payment-btn").on("click", function() {
            var audio = $("#mysoundclip2")[0];
            audio.play();
            $('input[name="paid_amount"]').val($("#grand-total").text());
            $('input[name="paying_amount"]').val($("#grand-total").text());
            $('.qc').data('initial', 1);
            });
            
            $("#draft-btn").on("click",function(){
            var audio = $("#mysoundclip2")[0];
            audio.play();
            $('input[name="sale_status"]').val(3);
            $('input[name="paying_amount"]').prop('required',false);
            $('input[name="paid_amount"]').prop('required',false);
            var rownumber = $('table.order-list tbody tr:last').index();
            if (rownumber < 0) {
                alert("Please insert product to order table!")
            }
            else
                $('.payment-form').submit();
            });
            
            $("#gift-card-btn").on("click",function() {
            $('select[name="paid_by_id_select"]').val(2);
            $('.selectpicker').selectpicker('refresh');
            $('div.qc').hide();
            giftCard();
            });
            
            $("#credit-card-btn").on("click",function() {
            $('select[name="paid_by_id_select"]').val(3);
            $('.selectpicker').selectpicker('refresh');
            $('div.qc').hide();
            creditCard();
            });
            
            $("#cheque-btn").on("click",function() {
            $('select[name="paid_by_id_select"]').val(4);
            $('.selectpicker').selectpicker('refresh');
            $('div.qc').hide();
            cheque();
            });
            
            $("#cash-btn").on("click",function() {
            $('select[name="paid_by_id_select"]').val(1);
            $('.selectpicker').selectpicker('refresh');
            $('div.qc').show();
            hide();
            });
            
            $("#paypal-btn").on("click",function() {
            $('select[name="paid_by_id_select"]').val(5);
            $('.selectpicker').selectpicker('refresh');
            $('div.qc').hide();
            hide();
            });
            
            $("#deposit-btn").on("click",function() {
            $('select[name="paid_by_id_select"]').val(6);
            $('.selectpicker').selectpicker('refresh');
            $('div.qc').hide();
            hide();
            deposits();
            });
            
            $('select[name="paid_by_id_select"]').on("change", function() {       
            var id = $(this).val();
            $(".payment-form").off("submit");
            if(id == 2) {
                $('div.qc').hide();
                giftCard();
            }
            else if (id == 3) {
                $('div.qc').hide();
                creditCard();
            } else if (id == 4) {
                $('div.qc').hide();
                cheque();
            } else {
                hide();
                if(id == 1)
                    $('div.qc').show();
                else if(id == 6) {
                    $('div.qc').hide();
                    deposits();
                }
            }
            });
            
            $('#add-payment select[name="gift_card_id_select"]').on("change", function() {
            var balance = gift_card_amount[$(this).val()] - gift_card_expense[$(this).val()];
            $('#add-payment input[name="gift_card_id"]').val($(this).val());
            if($('input[name="paid_amount"]').val() > balance){
                alert('Amount exceeds card balance! Gift Card balance: '+ balance);
            }
            });
            
            $('#add-payment input[name="paying_amount"]').on("input", function() {
            change($(this).val(), $('input[name="paid_amount"]').val());
            });
            
            $('input[name="paid_amount"]').on("input", function() {
            if( $(this).val() > parseFloat($('input[name="paying_amount"]').val()) ) {
                alert('Paying amount cannot be bigger than recieved amount');
                $(this).val('');
            }
            else if( $(this).val() > parseFloat($('#grand-total').text()) ){
                alert('Paying amount cannot be bigger than grand total');
                $(this).val('');
            }
            
            change( $('input[name="paying_amount"]').val(), $(this).val() );
            var id = $('select[name="paid_by_id_select"]').val();
            if(id == 2){
                var balance = gift_card_amount[$("#gift_card_id_select").val()] - gift_card_expense[$("#gift_card_id_select").val()];
                if($(this).val() > balance)
                    alert('Amount exceeds card balance! Gift Card balance: '+ balance);
            }
            else if(id == 6){
                if( $('input[name="paid_amount"]').val() > deposit[$('#customer_id').val()] )
                    alert('Amount exceeds customer deposit! Customer deposit : '+ deposit[$('#customer_id').val()]);
            }
            });
            
            $('.transaction-btn-plus').on("click", function() {
            $(this).addClass('d-none');
            $('.transaction-btn-close').removeClass('d-none');
            });
            
            $('.transaction-btn-close').on("click", function() {
            $(this).addClass('d-none');
            $('.transaction-btn-plus').removeClass('d-none');
            });
            
            $('.coupon-btn-plus').on("click", function() {
            $(this).addClass('d-none');
            $('.coupon-btn-close').removeClass('d-none');
            });
            
            $('.coupon-btn-close').on("click", function() {
            $(this).addClass('d-none');
            $('.coupon-btn-plus').removeClass('d-none');
            });
            
            $(document).on('click', '.qc-btn', function(e) {
            if($(this).data('amount')) {
                if($('.qc').data('initial')) {
                    $('input[name="paying_amount"]').val( $(this).data('amount').toFixed(2) );
                    $('.qc').data('initial', 0);
                }
                else {
                    $('input[name="paying_amount"]').val( (parseFloat($('input[name="paying_amount"]').val()) + $(this).data('amount')).toFixed(2) );
                }
            }
            else
                $('input[name="paying_amount"]').val('0.00');
            change( $('input[name="paying_amount"]').val(), $('input[name="paid_amount"]').val() );
            });
            
            function change(paying_amount, paid_amount) {
            $("#change").text( parseFloat(paying_amount - paid_amount).toFixed(2) );
            }
            
            function confirmDelete() {
            if (confirm("Are you sure want to delete?")) {
                return true;
            }
            return false;
            }
            
            function productSearch(data) {
            $.ajax({
                type: 'GET',
                url: '/pos/product_search',
                data: {
                    data: data
                },
                success: function(data) {
                    console.log(data);
                    var flag = 1;
                    $(".product-code").each(function(i) {
                        if ($(this).val() == data[1]) {
                            rowindex = i;
                            var pre_qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val();
                            if(pre_qty)
                                var qty = parseFloat(pre_qty) + 1;
                            else
                                var qty = 1;
                            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
                            flag = 0;
                            checkQuantity(String(qty), true);
                            flag = 0;
                        }
                    });
                    $("input[name='product_code_name']").val('');
                    if(flag){
                        addNewProduct(data);
                    }
                }
            });
            }
            
            function addNewProduct(data){
            var newRow = $("<tr>");
            var cols = '';
            temp_unit_name = (data[6]).split(',');
            cols += '<td class="col-sm-4 product-title"><button type="button" class="edit-product btn btn-link" data-toggle="modal" data-target="#editModal"><strong>' + data[0] + '</strong></button> [' + data[1] + '] </td>';
            cols += '<td class="col-sm-2 product-price"></td>';
            cols += '<td class="col-sm-3"><div class="input-group"><span class="input-group-btn"><button type="button" class="btn btn-default minus"><span class="dripicons-minus"></span></button></span><input type="text" name="qty[]" class="form-control qty numkey input-number" value="1" step="any" required><span class="input-group-btn"><button type="button" class="btn btn-default plus"><span class="dripicons-plus"></span></button></span></div></td>';
            cols += '<td class="col-sm-2 sub-total"></td>';
            cols += '<td class="col-sm-1"><button type="button" class="ibtnDel btn btn-danger btn-sm"><i class="dripicons-cross"></i></button></td>';
            cols += '<input type="hidden" class="product-code" name="product_code[]" value="' + data[1] + '"/>';
            cols += '<input type="hidden" class="product-id" name="product_id[]" value="' + data[9] + '"/>';
            cols += '<input type="hidden" class="sale-unit" name="sale_unit[]" value="' + temp_unit_name[0] + '"/>';
            cols += '<input type="hidden" class="net_unit_price" name="net_unit_price[]" />';
            cols += '<input type="hidden" class="discount-value" name="discount[]" />';
            cols += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="' + data[3] + '"/>';
            cols += '<input type="hidden" class="tax-value" name="tax[]" />';
            cols += '<input type="hidden" class="subtotal-value" name="subtotal[]" />';
            
            newRow.append(cols);
            if(keyboard_active==1){
                $("table.order-list tbody").append(newRow).find('.qty').keyboard({usePreview: false, layout: 'custom', display: { 'accept'  : '&#10004;', 'cancel'  : '&#10006;' }, customLayout : {
                  'normal' : ['1 2 3', '4 5 6', '7 8 9','0 {dec} {bksp}','{clear} {cancel} {accept}']}, restrictInput : true, preventPaste : true, autoAccept : true, css: { container: 'center-block dropdown-menu', buttonDefault: 'btn btn-default', buttonHover: 'btn-primary',buttonAction: 'active', buttonDisabled: 'disabled'},});
            }
            else
                $("table.order-list tbody").append(newRow);
            
            product_price.push(parseFloat(data[2]) + parseFloat(data[2] * customer_group_rate));
            product_discount.push('0.00');
            tax_rate.push(parseFloat(data[3]));
            tax_name.push(data[4]);
            tax_method.push(data[5]);
            unit_name.push(data[6]);
            unit_operator.push(data[7]);
            unit_operation_value.push(data[8]);
            rowindex = newRow.index();
            checkQuantity(1, true);
            }
            
            function edit(){
            var row_product_name_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(1)').text();
            $('#modal_header').text(row_product_name_code);
            
            var qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val();
            $('input[name="edit_qty"]').val(qty);
            
            $('input[name="edit_discount"]').val(parseFloat(product_discount[rowindex]).toFixed(2));
            
            var tax_name_all = ["No Tax","vat@10","vat@15","vat 20","fdg"];
            pos = tax_name_all.indexOf(tax_name[rowindex]);
            $('select[name="edit_tax_rate"]').val(pos);
            
            var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-code').val();
            pos = product_code.indexOf(row_product_code);
            if(product_type[pos] == 'standard'){
                unitConversion();
                temp_unit_name = (unit_name[rowindex]).split(',');
                temp_unit_name.pop();
                temp_unit_operator = (unit_operator[rowindex]).split(',');
                temp_unit_operator.pop();
                temp_unit_operation_value = (unit_operation_value[rowindex]).split(',');
                temp_unit_operation_value.pop();
                $('select[name="edit_unit"]').empty();
                $.each(temp_unit_name, function(key, value) {
                    $('select[name="edit_unit"]').append('<option value="' + key + '">' + value + '</option>');
                });
                $("#edit_unit").show();
            }
            else{
                row_product_price = product_price[rowindex];
                $("#edit_unit").hide();
            }
            $('input[name="edit_unit_price"]').val(row_product_price.toFixed(2));
            $('.selectpicker').selectpicker('refresh');
            }
            
            function couponDiscount() {
            var rownumber = $('table.order-list tbody tr:last').index();
            if (rownumber < 0) {
                alert("Please insert product to order table!")
            }
            else if($("#coupon-code").val() != ''){
                valid = 0;
                $.each(coupon_list, function(key, value) {
                    if($("#coupon-code").val() == value['code']){
                        valid = 1;
                        todyDate = "2021-04-12";
                        if(parseFloat(value['quantity']) <= parseFloat(value['used']))
                            alert('This Coupon is no longer available');
                        else if(todyDate > value['expired_date'])
                            alert('This Coupon has expired!');
                        else if(value['type'] == 'fixed'){
                            if(parseFloat($('input[name="grand_total"]').val()) >= value['minimum_amount']) {
                                $('input[name="grand_total"]').val($('input[name="grand_total"]').val() - value['amount']);
                                $('#grand-total').text(parseFloat($('input[name="grand_total"]').val()).toFixed(2));
                                if(!$('input[name="coupon_active"]').val())
                                    alert('Congratulation! You got '+value['amount']+' '+currency+' discount');
                                $(".coupon-check").prop("disabled",true);
                                $("#coupon-code").prop("disabled",true);
                                $('input[name="coupon_active"]').val(1);
                                $("#coupon-modal").modal('hide');
                                $('input[name="coupon_id"]').val(value['id']);
                                $('input[name="coupon_discount"]').val(value['amount']);
                                $('#coupon-text').text(parseFloat(value['amount']).toFixed(2));
                            }
                            else
                                alert('Grand Total is not sufficient for discount! Required '+value['minimum_amount']+' '+currency);
                        }
                        else{
                            var grand_total = $('input[name="grand_total"]').val();
                            var coupon_discount = grand_total * (value['amount'] / 100);
                            grand_total = grand_total - coupon_discount;
                            $('input[name="grand_total"]').val(grand_total);
                            $('#grand-total').text(parseFloat(grand_total).toFixed(2));
                            if(!$('input[name="coupon_active"]').val())
                                    alert('Congratulation! You got '+value['amount']+'% discount');
                            $(".coupon-check").prop("disabled",true);
                            $("#coupon-code").prop("disabled",true);
                            $('input[name="coupon_active"]').val(1);
                            $("#coupon-modal").modal('hide');
                            $('input[name="coupon_id"]').val(value['id']);
                            $('input[name="coupon_discount"]').val(coupon_discount);
                            $('#coupon-text').text(parseFloat(coupon_discount).toFixed(2));
                        }
                    }
                });
                if(!valid)
                    alert('Invalid coupon code!');
            }
            }
            
            function checkQuantity(sale_qty, flag) {
            var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-code').val();
            pos = product_code.indexOf(row_product_code);
            if(product_type[pos] == 'standard'){
                var operator = unit_operator[rowindex].split(',');
                var operation_value = unit_operation_value[rowindex].split(',');
                if(operator[0] == '*')
                    total_qty = sale_qty * operation_value[0];
                else if(operator[0] == '/')
                    total_qty = sale_qty / operation_value[0];
                if (total_qty > parseFloat(product_qty[pos])) {
                    alert('Quantity exceeds stock quantity!');
                    if (flag) {
                        sale_qty = sale_qty.substring(0, sale_qty.length - 1);
                        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
                        checkQuantity(sale_qty, true);
                    } else {
                        edit();
                        return;
                    }
                }
            }
            else if(product_type[pos] == 'combo'){
                child_id = product_list[pos].split(',');
                child_qty = qty_list[pos].split(',');
                $(child_id).each(function(index) {
                    var position = product_id.indexOf(parseInt(child_id[index]));
                    if( parseFloat(sale_qty * child_qty[index]) > product_qty[position] ) {
                        alert('Quantity exceeds stock quantity!');
                        if (flag) {
                            sale_qty = sale_qty.substring(0, sale_qty.length - 1);
                            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
                        }
                        else {
                            edit();
                            flag = true;
                            return false;
                        }
                    }
                });
            }
            
            if(!flag){
                $('#editModal').modal('hide');
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
            }
            calculateRowProductData(sale_qty);
            
            }
            
            function calculateRowProductData(quantity) {
            if(product_type[pos] == 'standard')
                unitConversion();
            else
                row_product_price = product_price[rowindex];
            
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.discount-value').val((product_discount[rowindex] * quantity).toFixed(2));
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-rate').val(tax_rate[rowindex].toFixed(2));
            
            if (tax_method[rowindex] == 1) {
                var net_unit_price = row_product_price - product_discount[rowindex];
                var tax = net_unit_price * quantity * (tax_rate[rowindex] / 100);
                var sub_total = (net_unit_price * quantity) + tax;
                
                if(parseFloat(quantity))
                    var sub_total_unit = sub_total / quantity;
                else
                    var sub_total_unit = sub_total;
            
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').val(net_unit_price.toFixed(2));
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(tax.toFixed(2));
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text(sub_total_unit.toFixed(2));
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(4)').text(sub_total.toFixed(2));
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(sub_total.toFixed(2));
            } else {
                var sub_total_unit = row_product_price - product_discount[rowindex];
                var net_unit_price = (100 / (100 + tax_rate[rowindex])) * sub_total_unit;
                var tax = (sub_total_unit - net_unit_price) * quantity;
                var sub_total = sub_total_unit * quantity;
            
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').val(net_unit_price.toFixed(2));
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(tax.toFixed(2));
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text(sub_total_unit.toFixed(2));
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(4)').text(sub_total.toFixed(2));
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(sub_total.toFixed(2));
            }
            
            calculateTotal();
            }
            
            function unitConversion() {
            var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
            var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(","));
            
            if (row_unit_operator == '*') {
                row_product_price = product_price[rowindex] * row_unit_operation_value;
            } else {
                row_product_price = product_price[rowindex] / row_unit_operation_value;
            }
            }
            
            function calculateTotal() {
            //Sum of quantity
            var total_qty = 0;
            $("table.order-list tbody .qty").each(function(index) {
                if ($(this).val() == '') {
                    total_qty += 0;
                } else {
                    total_qty += parseFloat($(this).val());
                }
            });
            $('input[name="total_qty"]').val(total_qty);
            
            //Sum of discount
            var total_discount = 0;
            $("table.order-list tbody .discount-value").each(function() {
                total_discount += parseFloat($(this).val());
            });
            
            $('input[name="total_discount"]').val(total_discount.toFixed(2));
            
            //Sum of tax
            var total_tax = 0;
            $(".tax-value").each(function() {
                total_tax += parseFloat($(this).val());
            });
            
            $('input[name="total_tax"]').val(total_tax.toFixed(2));
            
            //Sum of subtotal
            var total = 0;
            $(".sub-total").each(function() {
                total += parseFloat($(this).text());
            });
            $('input[name="total_price"]').val(total.toFixed(2));
            
            calculateGrandTotal();
            }
            
            function calculateGrandTotal() {
            var item = $('table.order-list tbody tr:last').index();
            var total_qty = parseFloat($('input[name="total_qty"]').val());
            var subtotal = parseFloat($('input[name="total_price"]').val());
            var order_tax = parseFloat($('select[name="order_tax_rate_select"]').val());
            var order_discount = parseFloat($('input[name="order_discount"]').val());
            if (!order_discount)
                order_discount = 0.00;
            $("#discount").text(order_discount.toFixed(2));
            
            var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());
            if (!shipping_cost)
                shipping_cost = 0.00;
            
            item = ++item + '(' + total_qty + ')';
            order_tax = (subtotal - order_discount) * (order_tax / 100);
            var grand_total = (subtotal + order_tax + shipping_cost) - order_discount;
            $('input[name="grand_total"]').val(grand_total.toFixed(2));
            
            couponDiscount();
            var coupon_discount = parseFloat($('input[name="coupon_discount"]').val());
            if (!coupon_discount)
                coupon_discount = 0.00;
            grand_total -= coupon_discount;
            
            $('#item').text(item);
            $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);
            $('#subtotal').text(subtotal.toFixed(2));
            $('#tax').text(order_tax.toFixed(2));
            $('input[name="order_tax"]').val(order_tax.toFixed(2));
            $('#shipping-cost').text(shipping_cost.toFixed(2));
            $('#grand-total').text(grand_total.toFixed(2));
            $('input[name="grand_total"]').val(grand_total.toFixed(2));
            }
            
            function hide() {
            $(".card-element").hide();
            $(".card-errors").hide();
            $(".cheque").hide();
            $(".gift-card").hide();
            $('input[name="cheque_no"]').attr('required', false);
            }
            
            function giftCard() {
            $(".gift-card").show();
            $.ajax({
                url: 'sales/get_gift_card',
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('#add-payment select[name="gift_card_id_select"]').empty();
                    $.each(data, function(index) {
                        gift_card_amount[data[index]['id']] = data[index]['amount'];
                        gift_card_expense[data[index]['id']] = data[index]['expense'];
                        $('#add-payment select[name="gift_card_id_select"]').append('<option value="'+ data[index]['id'] +'">'+ data[index]['card_no'] +'</option>');
                    });
                    $('.selectpicker').selectpicker('refresh');
                    $('.selectpicker').selectpicker();
                }
            });
            $(".card-element").hide();
            $(".card-errors").hide();
            $(".cheque").hide();
            $('input[name="cheque_no"]').attr('required', false);
            }
            
            function cheque() {
            $(".cheque").show();
            $('input[name="cheque_no"]').attr('required', true);
            $(".card-element").hide();
            $(".card-errors").hide();
            $(".gift-card").hide();
            }
            
            function creditCard() {
            $.getScript( "public/vendor/stripe/checkout.js" );
            $(".card-element").show();
            $(".card-errors").show();
            $(".cheque").hide();
            $(".gift-card").hide();
            $('input[name="cheque_no"]').attr('required', false);
            }
            
            function deposits() {
            if($('input[name="paid_amount"]').val() > deposit[$('#customer_id').val()]){
                alert('Amount exceeds customer deposit! Customer deposit : '+ deposit[$('#customer_id').val()]);
            }
            $('input[name="cheque_no"]').attr('required', false);
            $('#add-payment select[name="gift_card_id_select"]').attr('required', false);
            }
            
            function cancel(rownumber) {
            while(rownumber >= 0) {
                product_price.pop();
                product_discount.pop();
                tax_rate.pop();
                tax_name.pop();
                tax_method.pop();
                unit_name.pop();
                unit_operator.pop();
                unit_operation_value.pop();
                $('table.order-list tbody tr:last').remove();
                rownumber--;
            }
            $('input[name="shipping_cost"]').val('');
            $('input[name="order_discount"]').val('');
            $('select[name="order_tax_rate_select"]').val(0);
            calculateTotal();
            }
            
            function confirmCancel() {
            var audio = $("#mysoundclip2")[0];
            audio.play();
            if (confirm("Are you sure want to cancel?")) {
                cancel($('table.order-list tbody tr:last').index());
            }
            return false;
            }
            
            $(document).on('submit', '.payment-form', function(e) {
            var rownumber = $('table.order-list tbody tr:last').index();
            if (rownumber < 0) {
                alert("Please insert product to order table!")
                e.preventDefault();
            }
            else if( parseFloat( $('input[name="paying_amount"]').val() ) < parseFloat( $('input[name="paid_amount"]').val() ) ){
                alert('Paying amount cannot be bigger than recieved amount');
                e.preventDefault();
            }
            $('input[name="paid_by_id"]').val($('select[name="paid_by_id_select"]').val());
            $('input[name="order_tax_rate"]').val($('select[name="order_tax_rate_select"]').val());
            
            });
            
            $('#product-table').DataTable( {
            "order": [],
            'pageLength': product_row_number,
             'language': {
                'paginate': {
                    'previous': '<i class="fa fa-angle-left"></i>',
                    'next': '<i class="fa fa-angle-right"></i>'
                }
            },
            dom: 'tp'
            });
         </script>
      </div>
   </div>
   <ul id="ui-id-1" tabindex="0" class="ui-menu ui-widget ui-widget-content ui-autocomplete ui-front" style="display: none;"></ul>
   <div role="status" aria-live="assertive" aria-relevant="additions" class="ui-helper-hidden-accessible"></div>
   <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
   <script type="text/javascript">
      function myFunction() {
          setTimeout(showPage, 150);
      }
      
      function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("content").style.display = "block";
        $("#lims_productcodeSearch").focus();
      }
      
      $("div.alert").delay(3000).slideUp(750);
      $('select').selectpicker({
          style: 'btn-link',
      });
   </script>
   <iframe name="__privateStripeMetricsController6450" frameborder="0" allowtransparency="true" scrolling="no" allowpaymentrequest="true" src="https://js.stripe.com/v3/m-outer-0cba8a995d163797499ab006bbb6b889.html#url=https%3A%2F%2Fwww.pos.springsoftit.com%2Fpos&amp;title=POS%20%7C%20INVENTORY%20%7C&amp;referrer=https%3A%2F%2Fwww.pos.springsoftit.com%2F&amp;muid=fe8fd321-cccf-4896-8b62-e248754f766a1befa2&amp;sid=NA&amp;version=6&amp;preview=false" aria-hidden="true" tabindex="-1" style="border: none !important; margin: 0px !important; padding: 0px !important; width: 1px !important; min-width: 100% !important; overflow: hidden !important; display: block !important; visibility: hidden !important; position: fixed !important; height: 1px !important; pointer-events: none !important; user-select: none !important;"></iframe><iframe src="about:blank" style="display: none;"></iframe>
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
   <script src="{{ asset('backend/js/pos.js') }}"></script>
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