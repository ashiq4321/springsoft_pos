@extends('layout.master')
@section('title')
SpringSoft-IT Dashboard
@endsection
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
@if(Auth::user()->role == 1)
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
  </div>
  
</div>

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total Customer</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">
                </h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total Warehouse</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2"></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
   

      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total Supplier</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2"></h3>
                
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total Supplier</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
              
                <h3 class="mb-2">{{auth()->user()->unreadNotifications->count()}}</h3>
                @foreach (auth()->user()->unreadNotifications as $n)
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div>
                        <div class="text-truncate">{{$n->data['quantity_alert']}}</div>
                        <div class="small text-gray-500">{{$n->created_at}}</div>
                    </div>
                </a>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
</div> <!-- row -->


@else
<div class="row">
    
    <div class="col-lg-7 m-auto">
      <div class="card">
        <div class="card-header">
          Your Question
        </div>
        <div class="card-body">
          
            
        </div>
      </div>
    </div>
</div>
   
@endif

<script>

// $(document).ready(function() {
//   alert("dashboard");
//   $.ajaxSetup({
//                  headers: {
//                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                  }
//              });
//     $.ajax({
//         type: 'POST',
//         url: '/productAlert',
//         dataType: "json",
//         success: function(data) {
//           alert("yrs");
//           console.log(data);
//             console.log("notification send");  
//         },
//         error: function(data) {
//           alert("no");
//           console.log(data);
//             console.log("notification send");  
//         }

//     });
// });



</script>






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
