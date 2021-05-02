@extends('layout.master')
@section('title')
UI Novel- Front User Cart
@endsection
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Your Choose Item Table</h4>
        <!-- <p class="card-description">
          Add class <code>.table-striped</code>
        </p> -->
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Images</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th> Remove</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="py-1">
                  <img src="{{asset('assets/images/1.jpg')}}" width="80px" alt="image">
                </td>
                <td>Pizza</td>
                <td>250 Tk</td>
                <td>2</td>
                <td>500 TK</td>
                <td><a href="#"><i data-feather="x"></i></a></td>
              </tr>
            </tbody>
          </table>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-danger">Continue Shopping</button>
          </div>
           <div class="col-md-6" style="text-align: right;">
           <a href="{{url('frontcheckout')}}" class="btn btn-danger">Proceed to Checkout</a>
          </div>
        </div> 
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush
 