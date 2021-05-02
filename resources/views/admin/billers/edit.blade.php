<div class="mess"></div>
<form action="{{ route('biller-operations.update', $biller->id) }}" method="post" id="globalForm"
    data-id="{{ $biller->id }}" enctype="multipart/form-data">

    @csrf
    @method('PATCH')

    <div class="mess"></div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <input type="hidden" name="billerID">
                <label>Name</label>
                <input type="text" class=" form-control" id="name" name="name" value="{{ $biller->name }}">
                <span class="text-danger print-error-msg" id="nameError"></span>
            </div>
            <div class="form-group">
                <label>Company Name</label>
                <input type="text" class=" form-control" id="company_name" name="company_name"
                    value="{{ $biller->company_name }}">
                <span class="text-danger" id="company_nameError"></span>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="number" class=" form-control" id="phone_number" name="phone_number"
                    value="{{ $biller->phone_number }}">
                <span class="text-danger" id="phone_numberError"></span>
            </div>
            <div class="form-group">
                <label>Vat Number</label>
                <input type="number" class=" form-control" id="vat_number" name="vat_number"
                    value="{{ $biller->vat_number }}">
                <span class="text-danger" id="vat_numberError"></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class=" form-control" id="email" name="email" value="{{ $biller->email }}">
                <span class="text-danger" id="emailError"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>City</label>
                <input type="text" class=" form-control" id="city" name="city" value="{{ $biller->city }}">
                <span class="text-danger" id="cityError"></span>
            </div>
            <div class="form-group">
                <label>State</label>
                <input type="text" class=" form-control" id="state" name="state" value="{{ $biller->state }}">
                <span class="text-danger" id="stateError"></span>
            </div>
            <div class="form-group">
                <label>Postal Code</label>
                <input type="text" class=" form-control" id="postal_code" name="postal_code"
                    value="{{ $biller->postal_code }}">
                <span class="text-danger" id="postal_codeError"></span>
            </div>
            <div class="form-group">
                <label>Country</label>
                <input type="text" class=" form-control" id="country" name="country" value="{{ $biller->country }}">
                <span class="text-danger" id="countryError"></span>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" class=" form-control" id="imageEdit" name="imageEdit">
                <span class="text-danger" id="imageError"></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label style="width: 17%">Address</label>
        <textarea class=" form-control" name="address" id="address" cols="5"
            rows="5">{{ $biller->address }}</textarea>
        <span class="text-danger" id="addressError"></span>
    </div>
    <div class="form-group">
    </div>
    <div class="form-group">
        <button id="updateBiller" class="btn btn-block btn-info submit" type="button">Update</button>
    </div>
</form>
