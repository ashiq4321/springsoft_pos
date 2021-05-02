@extends('layout.master')
@section('title')
UI Novel- User Checkout
@endsection
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@section('content')

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <!-- <h4 class="card-title">Billing Details</h4> -->
        <!-- <p class="card-description">Read the <a href="https://jqueryvalidation.org/" target="_blank"> Official jQuery Validation Documentation </a>for a full list of instructions and other options.</p> -->
        <div class="row">
          <div class="col-lg-7">
            <h4 class="card-title">Billing Details</h4>
                <form class="cmxform" id="signupForm" method="get" action="#">
              <fieldset>
                <div class="form-group">
                  <label for="name">Name</label>
                  <input id="name" class="form-control" type="text">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" class="form-control" type="email">
                </div>
                <div class="form-group">
                  <label for="Phone">Phone Number</label>
                  <input id="text" class="form-control" type="text">
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <input id="address" class="form-control" type="text">
                </div>
                <div class="form-group">
                  <label for="address">Order Notes</label>
                   <textarea class="form-control" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                </div>
                <input class="btn btn-primary" type="submit" value="Submit">
              </fieldset>
            </form>
          </div>
          <div class="col-lg-5">
            <h4 class="card-title">Your Order Details</h4>
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