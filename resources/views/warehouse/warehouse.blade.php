@extends('layout.master')
@section('title')
Essential-infotech- warehouse
@endsection
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-header">

        <!-- Delete Modal -->
        @include('warehouse.deleteModal')

        <!-- Edit Modal -->
        @include('warehouse.editModal')

        <h6 class="card-title">Warehouse Table</h6>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addWarehouseModal">
          Add new warehouse
        </button> 

        <!-- Modal -->  
        @include('warehouse.addModal')
        
      </div>
      <div class="card-body">
        <h6 class="card-title">Warehouse Table</h6>
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



{{--
            <tbody>
              {{-- @forelse($get_categories as $index => $category)
              <tr>
                <td>{{$get_categories->firstitem() + $index}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->phone}}</td>
                <td>{{$category->email}}</td>
                <td>{{$category->address}}</td>
                <td>
                  <a href="#" class="btn @php echo $category->is_active == 0?'bg-maroon':'bg-blue'@endphp">
                      @php
                      echo $category->is_active == 0?'Off&nbsp&nbsp&nbsp<i data-feather="toggle-left"></i>':'On&nbsp&nbsp&nbsp<i data-feather="toggle-right"></i>'
                      @endphp
                  </a>
                </td>
                <td>
                  <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="{{url('edit_category')}}/{{$category->id}}" class="btn bg-blue"><i data-feather="edit"></i></a>
                      <a href="/deleteWarehouse/{{$category->id}}" class="btn bg-marron" id='deleteWarehouse' name="deleteId" value='{{$category->id}}'><i data-feather="delete"> {{$category->id}}</i></a>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td class="text-danger text-center" colspan="4">No Data Found</td>
              </tr>
              @endforelse 
            </tbody>

{{-- old --}}
{{-- <div class="row">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header">
        <h4>Warehouse Table</h4>
      </div>
      <div class="card-body">
          @if(session('delete'))
            <div class="alert alert-success">
              {{session('delete')}}
            </div>
          @endif
            <!-- <h4>Category Table</h4> -->
          <div class="table-responsive">
            <table class="table table-bordered" id='warehouseDT'>
              <tr>
                <th>sl no</th>
                <th>Warehouse Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>status</th>
                <th>Action</th>
              </tr>
              @forelse($get_categories as $index => $category)
              <tr>
                <td>{{$get_categories->firstitem() + $index}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->phone}}</td>
                <td>{{$category->email}}</td>
                <td>{{$category->address}}</td>
                <td>
                  <a href="{{url('active_category')}}/{{$category->id}}" class="btn @php echo $category->is_active == 0?'bg-maroon':'bg-blue'@endphp">
                      @php
                      echo $category->is_active == 0?'Off&nbsp&nbsp&nbsp<i data-feather="toggle-left"></i>':'On&nbsp&nbsp&nbsp<i data-feather="toggle-right"></i>'
                      @endphp
                  </a>
                </td>
                <td>
                  <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="{{url('edit_category')}}/{{$category->id}}" class="btn bg-blue"><i data-feather="edit"></i></a>
                      <a href="{{url('delete_category')}}/{{$category->id}}" class="btn bg-marron"><i data-feather="delete"></i></a>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td class="text-danger text-center" colspan="4">No Data Found</td>
              </tr>
              @endforelse
            </table>
          </div>
            <div class="mt-2">
              {{$get_categories->links()}}
            </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card">
      @if(session('category_success'))
      <strong class="alert alert-success">{{session('category_success')}}</strong>
      @endif
      <div class="card-header">
        <h4 class="card-title">Add Warehouse</h4>
      </div>
      <div class="card-body">
        <form action="{{url('categorypost')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Warehouse name</label>
              <input type="text" name="warehouse_name" id="warehouse_name" class="form-control" value="{{old('warehouse_name')}}" placeholder="Warehouse Name">
              @error('warehouse_name')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Phone</label>
              <input type="text" name="warehouse_phone" id="warehouse_phone" class="form-control" value="{{old('warehouse_phone')}}" placeholder="Warehouse Phone">
              @error('warehouse_phone')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="warehouse_email" id="warehouse_email" class="form-control" value="{{old('warehouse_email')}}" placeholder="Warehouse Email">
              @error('warehouse_email')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Address</label>
              <input type="text" name="warehouse_address" id='warehouse_address' class="form-control" value="{{old('warehouse_address')}}" placeholder="Warehouse Address">
              @error('warehouse_address')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Status</label>
              <select name="warehouse_status" id="warehouse_status" class="form-control">
                <option value="">-- Choose Category --</option>
                <option value="1">Active</option>
                <option value="0">Deactive</option>
              </select>
              @error('warehouse_status')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success" id='addWarehouse'>Submit</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection --}}