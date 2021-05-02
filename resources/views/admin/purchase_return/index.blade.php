@extends('layout.master')
@section('title')
Essential-infotech- purchase
@endsection
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-header">
        <h6 class="card-title">Purchase Table</h6>
        <a href="{{route('purchase.add')}}">Add Purchase</a>

        {{--  <!-- Delete Modal -->
        @include('warehouse.deleteModal')

        <!-- Edit Modal -->
        @include('warehouse.editModal') --}}
        

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <th>sl no</th>
                <th>Warehouse Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>status</th>
                <th>Action</th>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
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
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script src="{{ asset('backend/js/warehouse.js') }}"></script>
@endpush
