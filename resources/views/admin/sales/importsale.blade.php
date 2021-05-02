@extends('layout.master')
@section('title')
POS || Inventory
@endsection
@section('content')  
 <section class="forms">
            <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
            <div class="card">
            <div class="card-header d-flex align-items-center">
                    <h4>Import Sale</h4>
             </div>
<div class="card-body">
           <p class="font-italic text-muted"><small>The field labels marked with * are required input fields.</small></p><br>
    <form method="POST" action="http://pos.springsoftit.com/importsale" accept-charset="UTF-8" class="payment-form" enctype="multipart/form-data"><input name="_token" type="hidden" value="0lyCILRKXTQYFyWzsJLt7u2Y7pGEneHnkYvJ94pX">
                            <div class="row">
                            <div class="col-md-12">
                            <div class="row">
                            <div class="col-md-4">
                            <div class="form-group">
                            <label>Customer *</label>
                            <select required name="customer_id" class="selectpicker form-control" data-live-search="true" id="customer-id" data-live-search-style="begins" title="Select customer...">
                            <option value="2">moinul (+8801200000001)</option>
                            <option value="3">tariq (3424)</option>
                            <option value="11">walk-in-customer (01923000001)</option>
                            </select>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                            <label>Warehouse *</label>
                            <select required name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                            <option value="1">warehouse 1</option>
                            <option value="2">warehouse 2</option>
                            </select>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                            <label>Biller *</label>
                            <select required name="biller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Biller...">
                            <option value="1">yousuf (aks)</option>
                            <option value="2">tariq (big tree)</option>
                            <option value="5">modon (mogaTel)</option>
                            <option value="8">x (x)</option>
                            </select>
                            </div>
                            </div>
                            </div>
                            <div class="row mt-3">
                            <div class="col-md-6">
                            <div class="form-group">
                            <label>Upload CSV File *</label>
                            <input type="file" name="file" class="form-control" required />
                            <p  class="font-normal text-justify text-muted">The correct column order is (product_code, quantity, sale_unit, product_price, 
                            discount, tax_name) and you must follow this. For Digital product sale_unit willbe n/a. All columns are required.</p>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group mt-2">
                            <label></label><br>
                            <a download href="../public/sample_file/sample_sale_products.csv" class="btn btn-primary btn-block btn-lg"> <i class="dripicons-download"></i> Download Sample File</a>
                            </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-2">
                            <div class="form-group">
                            <input type="hidden" name="total_qty" value="0" />
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                            <input type="hidden" name="total_discount" value="0"/>
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                            <input type="hidden" name="total_tax" value="0" />
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                            <input type="hidden" name="total_price" value="0" />
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                            <input type="hidden" name="item" value="0" />
                            <input type="hidden" name="order_tax" value="0" />
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                            <input type="hidden" name="grand_total" value="0" />
                            <input type="hidden" name="paid_amount" value="0.00" />
                            <input type="hidden" name="payment_status" value="2" />
                            </div>
                            </div>
                            </div>
                            <div class="row mt-3">
                            <div class="col-md-4">
                            <div class="form-group">
                            <label>Order Tax</label>
                            <select class="form-control" name="order_tax_rate">
                            <option value="0">No Tax</option>
                            <option value="10">vat@10</option>
                            <option value="15">vat@15</option>
                            <option value="20">vat 20</option>
                            <option value="8">fdg</option>
                            </select>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                            <label>
                            <strong>Order Discount</strong>
                            </label>
                            <input type="number" name="order_discount" class="form-control" step="any" />
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                            <label>
                            <strong>Shipping Cost</strong>
                            </label>
                            <input type="number" name="shipping_cost" class="form-control" step="any" />
                            </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-4">
                            <div class="form-group">
                            <label>Attach Document</label>
                            <i class="dripicons-question" data-toggle="tooltip" title="Only jpg, jpeg, png, gif, pdf, csv, docx, xlsx and txt file is supported"></i> 
                            <input type="file" name="document" class="form-control" />
                                        </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                            <label>Sale Status *</label>
                            <select name="sale_status" class="form-control">
                            <option value="1">Completed</option>
                            <option value="2">Pending</option>
                            </select>
                            </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                            <label>Sale Note</label>
                            <textarea rows="5" class="form-control" name="sale_note"></textarea>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label>Staff Note</label>
                            <textarea rows="5" class="form-control" name="staff_note"></textarea>
                            </div>
                            </div>
                            </div>
                            <div class="form-group">
                            <input type="submit" value="Submit" class="btn btn-sm btn-info" id="submit-button">
                            </div>
                            </div>
                            </div>
      </form>
</div>
</div>
</div>
</div>
</section>
@endsection