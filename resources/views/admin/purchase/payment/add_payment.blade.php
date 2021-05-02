<div class="mess"></div>
<form action="{{ route('admin.addPayment', $purchase->id) }}" method="post" id="globalForm"
    data-id="{{ $purchase->id }}" enctype="multipart/form-data">

    @csrf
    @method('PATCH')

    <div class="mess"></div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Received Amount *</label>
                <input type="text" class="form-control" id="received_amount" name="received_amount"
                    value="{{ $purchase->grand_total - $purchase->paid_amount }}">
                <span class="text-danger print-error-msg" id="nameError"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Paying Amount *</label>
                <input type="text" class="form-control" id="paying_amount" name="paying_amount"
                    value="{{ $purchase->grand_total - $purchase->paid_amount }}">
                <span class="text-danger" id="paying_amountError"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Change:</label>
                <input type="text" class=" form-control" id="change" name="change" value="0.00" readonly>
                <span class="text-danger" id="company_nameError"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Paid By</label>
                <select name="paid_by" id="paid_by">
                    <option value="cash">Cash</option>
                    <option value="card">Credit Card</option>
                    <option value="cheque">Cheque</option>
                </select>
                <span class="text-danger" id="company_nameError"></span>
            </div>
        </div>

        <div class="col-md-12" id="cheque_input" style="display: none;">
            <div class="form-group">
                <label>Cheque Number *</label>
                <input type="text" id="cheque" name="cheque_no" class="form-control">
            </div>
        </div>
        <div class="col-md-12" id="card_input" style="display: none;">
            <div class="form-group">
                <label>Card Number *</label>
                <input type="text" id="card" name="card_no" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">

    </div>

    <div class="row">

    </div>

    <div class="row">
        <div class="col-md-12">
            <label>Payment Note</label>
            <textarea rows="3" class="form-control" name="payment_note"></textarea>
        </div>
    </div>
    <div class="form-group mt-3">
        <button id="pay_now" class="btn btn-block btn-info submit" type="button">Pay</button>
    </div>
</form>

<script>
    $('body').on('keyup', '#received_amount', function() {
        $('#change').val($(this).val() - $('#paying_amount').val());
    });

    $('body').on('keyup', '#paying_amount', function() {
        if ($(this).val() > {{ $purchase->grand_total - $purchase->paid_amount }}) {
            alert('Paying amount cannot be greater than the due amount!')
        }

        var str = $(this).val();
        var res = str.substr(str.length - 1, 1);
        console.log(res)
        $('#change').val($('#received_amount').val() - $(this).val());
    });

    $('body').on('click', '#pay_now', function(event) {
        event.preventDefault();
        let action = $('#globalForm').attr('action');
        let globalForm = $('#globalForm');

        let updateForm = $(this).parent().parent().parent().find('form');

        if ($('#paying_amount').val() > {{ $purchase->grand_total - $purchase->paid_amount }}) {
            alert('Paying amount cannot be greater than Due amount!')

            return false;
        }

        $.ajax({
            url: action,
            data: new FormData(globalForm[0]),
            async: false,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(data) {
                console.log(data);
                swal("Payment Added Successfully!", "success");
                $('#add_payment_modal').modal('hide');
                window.location.reload();
            },
            error: function(data) {
                console.log(data);
                // swal("Warning!", "All The Field is required!", "warning");

                updateForm.find('#nameError').text(data.responseJSON.errors.name);
            }
        });
    })

</script>
