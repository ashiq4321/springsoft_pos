<div class="modal fade" id="addWarehouseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Warehouse</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('warehouse.add')}}" method="POST" id='warehouseForm' enctype="multipart/form-data">
            @csrf
            <div id="warehouseaddition">

            </div>
            <div class="form-group">
              <label>Warehouse name</label>
              <input type="text" name="warehouse_name" id="warehouse_name" class="form-control" value="{{old('warehouse_name')}}" placeholder="Warehouse Name">
              {{-- @error('warehouse_name')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror --}}
              <span class="text-danger" id="nError"></span>

            </div>
            <div class="form-group">
              <label>Phone</label>
              <input type="text" name="warehouse_phone" id="warehouse_phone" class="form-control" value="{{old('warehouse_phone')}}" placeholder="Warehouse Phone">
              {{-- @error('warehouse_phone')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror --}}
              <span class="text-danger" id="pError"></span>

            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="warehouse_email" id="warehouse_email" class="form-control" value="{{old('warehouse_email')}}" placeholder="Warehouse Email">
              {{-- @error('warehouse_email')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror --}}
              <span class="text-danger" id="emailError"></span>

            </div>
            <div class="form-group">
              <label>Address</label>
              <input type="text" name="warehouse_address" id='warehouse_address' class="form-control" value="{{old('warehouse_address')}}" placeholder="Warehouse Address">
              {{-- @error('warehouse_address')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror --}}
              <span class="text-danger" id="aError"></span>

            </div>
            <div class="form-group">
              <label>Status</label>
              <select name="warehouse_status" id="warehouse_status" class="form-control">
                <option value="">-- Choose Status --</option>
                <option value="1">Active</option>
                <option value="0">Deactive</option>
              </select>
              {{-- @error('warehouse_status')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror --}}
              <span class="text-danger" id="statusError"></span>

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id='addWarehouse'>Submit</button>
        </div>
      </form>
      </div>
    </div>
  </div>