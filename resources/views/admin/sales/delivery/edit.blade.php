<div class="mess"></div>
<form action="{{ route('delivery.update', $id) }}" method="post" id="globalForm" data-id="{{ $id }}" enctype="multipart/form-data">

    @csrf
    @method('PATCH')
    
    <div class="mess"></div>

    <div class="row">
        <div class="col-md-6">
          <div class="form-group">
              <label>Delivery Reference</label>
              <br>
              <strong>{{ $delivery_reference }}</strong>
              <span class="text-danger" id="nError"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
              <label>Sale Reference</label>
              <br>
              <strong>{{ $sale_reference }}</strong>
              <span class="text-danger" id="cError"></span>  
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
              <label>Status *</label>
              <select name="status" id="status">
                  <option value="Picking" {{ $status == 'Picking' ? 'selected':'' }}>Picking</option>
                  <option value="Delivering" {{ $status == 'Delivering' ? 'selected':'' }}>Delivering</option>
                  <option value="Delivered" {{ $status == 'Delivered' ? 'selected':'' }}>Delivered</option>
              </select>
              <span class="text-danger" id="pError"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
              <label>Delevered By</label>
              <input type="text" class=" form-control" id="delevered_by" name="delevered_by" value="{{ $delevered_by }}">
              <span class="text-danger" id="tError"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
              <label>Received By</label>
              <input type="text" class=" form-control" id="received_by" name="received_by" value="{{ $received_by }}">
              <span class="text-danger" id="eError"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
              <label>Customer *</label>
              <br>
              <strong>{{ $customer }}</strong>
              <span class="text-danger" id="eError"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
              <label>Attach File</label>
              <input type="file" class=" form-control" id="file" name="file">
              <span class="text-danger" id="cuError"></span>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" name="address" id="address" cols="5" rows="5">{{ $address }}</textarea>
                <span class="text-danger" id="aError"></span>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Note</label>
                <textarea  class=" form-control" name="note" id="note" cols="5" rows="5">{{ $note }}</textarea>
                <span class="text-danger" id="aError"></span>
            </div>
        </div>
    </div>
    <div class="form-group" style="display: flex">
    </div>
    <div class="form-group">
        <button id="updateDelivery" class="btn btn-block btn-info submit" type="button">Update</button>
    </div>
</form>