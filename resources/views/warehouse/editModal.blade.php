<div class="modal fade" id="editWarehouseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Warehouse</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form  method="POST" enctype="multipart/form-data">
            @csrf
            <div id="warehouseaddition">

            </div>
            <div class="form-group">
              <label>Warehouse name</label>
              <input type="text" name="warehouse_nameEdit" id="warehouse_nameEdit" class="form-control" value="{{old('warehouse_name')}}" placeholder="Warehouse Name">
              <span class="text-danger" id="warehouse_nameEditError"></span>
            </div>
            <div class="form-group">
              <label>Phone</label>
              <input type="text" name="warehouse_phoneEdit" id="warehouse_phoneEdit" class="form-control" value="{{old('warehouse_phone')}}" placeholder="Warehouse Phone">
              <span class="text-danger" id="warehouse_phoneEditError"></span>

            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="warehouse_emailEdit" id="warehouse_emailEdit" class="form-control" value="{{old('warehouse_email')}}" placeholder="Warehouse Email">
              <span class="text-danger" id="warehouse_emailEditError"></span>

            </div>
            <div class="form-group">
              <label>Address</label>
              <input type="text" name="warehouse_addressEdit" id='warehouse_addressEdit' class="form-control" value="{{old('warehouse_address')}}" placeholder="Warehouse Address">
              <span class="text-danger" id="warehouse_addressEditError"></span>

            </div>
            <div class="form-group">
              <label>Status</label>
              <select name="warehouse_statusEdit" id="warehouse_statusEdit" class="form-control">
                <option value="">-- Choose Category --</option>
                <option value="1">Active</option>
                <option value="0">Deactive</option>
              </select>
              <span class="text-danger" id="warehouse_statusEditError"></span>

            </div>
        </div>
        <div class="modal-footer">
        <input type="hidden" name='warehouse_id' id='warehouse_id'>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id='save'>Save Changes </button>
        </div>
      </form>
      </div>
    </div>
  </div>