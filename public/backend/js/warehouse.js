$(document).ready(function() {

    fetchRecords();
    //add record
    $(document).on('click', '#addWarehouse', function(e) {
        e.preventDefault();
        var name = $('#warehouse_name').val();
        var phone = $('#warehouse_phone').val();
        var email = $('#warehouse_email').val();
        var address = $('#warehouse_address').val();
        var status = $('#warehouse_status').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $('#nError').text('');
        $('#pError').text('');
        $('#emailError').text('');
        $('#aError').text('');
        $('#statusError').text('');

        $.ajax({
            url: 'warehouse',
            method: 'POST',
            data: {
                name: name,
                phone: phone,
                email: email,
                address: address,
                status: status,
            },
            dataType: "json",
            success: function(response) {
                swal("Inserted!", "Data has been Successfully Insert!", "success");
                $("#warehouseForm").trigger("reset");
                $('#addWarehouseModal').modal('hide');
                fetchRecords();
            },
            error: function(response) {
                // alert('error');
                // console.log(response);
                $('#nError').text(response.responseJSON.errors.name);
                $('#pError').text(response.responseJSON.errors.phone);
                $('#emailError').text(response.responseJSON.errors.email);
                $('#aError').text(response.responseJSON.errors.address);
                $('#statusError').text(response.responseJSON.errors.status);
            }
        });

    });

    // Delete record
    $(document).on("click", ".delete", function(e) {
        e.preventDefault();
        var delete_id = $(this).data('id');
        $(document).on("click", "#delete", function() {
            $.ajax({
                url: 'deleteWarehouse/' + delete_id,
                type: 'get',
                success: function(response) {
                    swal("Deleted!", "Warehouse has been Successfully Delete!", "success");
                    $('#deleteModal').modal('hide');
                    fetchRecords();
                },
                error: function(response) {
                    alert('error');
                    console.log(response);
                }
            });
        });
    });

    // Edit record
    $(document).on("click", ".edit", function(e) {
        e.preventDefault();
        var edit_id = $(this).data('id');
        $('#editWarehouseModal input[name="warehouse_id"]').val(edit_id);
        console.log(edit_id)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: 'findWarehouse/' + edit_id,
            type: 'get',
            success: function(response) {
                $('#warehouse_nameEdit').val(response.warehouse['name']);
                $('#warehouse_phoneEdit').val(response.warehouse['phone']);
                $('#warehouse_emailEdit').val(response.warehouse['email']);
                $('#warehouse_addressEdit').val(response.warehouse['address']);
                $('#warehouse_statusEdit').val(response.warehouse['is_active']);

                $('#warehouse_nameEditError').text('');
                $('#warehouse_phoneEditError').text('');
                $('#warehouse_emailEditError').text('');
                $('#warehouse_addressEditError').text('');
                $('#warehouse_statusEditError').text('');
            },
            error: function(response) {
                alert('error');
                console.log(response);
            }
        });
    });
    $(document).on("click", "#save", function(e) {
        e.preventDefault();

        var edit_id = $('#editWarehouseModal input[name="warehouse_id"]').val();
        var name = $('#editWarehouseModal input[name="warehouse_nameEdit"]').val();
        var phone = $('#editWarehouseModal input[name="warehouse_phoneEdit"]').val();
        var email = $('#editWarehouseModal input[name="warehouse_emailEdit"]').val();
        var address = $('#editWarehouseModal input[name="warehouse_addressEdit"]').val();
        var status = $('#warehouse_statusEdit').val();
        /*  var name = $('#').val();
         var phone = $('#').val();
         var email = $('#').val();
         var address = $('#').val();
         var status = $('#').val(); */

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: '/updateWarehouse/' + edit_id,
            type: 'post',
            data: {
                'name': name,
                'phone': phone,
                'email': email,
                'address': address,
                'status': status,
            },
            success: function(response) {
                swal("Updated!", "Data has been Successfully Update!", "success");
                $('#editWarehouseModal').modal('hide');
                fetchRecords();
            },
            error: function(response) {
                // alert('error');
                // console.log(response);

                $('#warehouse_nameEditError').text(response.responseJSON.errors.name);
                $('#warehouse_phoneEditError').text(response.responseJSON.errors.phone);
                $('#warehouse_emailEditError').text(response.responseJSON.errors.email);
                $('#warehouse_addressEditError').text(response.responseJSON.errors.address);
                $('#warehouse_statusEditError').text(response.responseJSON.errors.status);
            }
        });
    });

});

// Fetch records
function fetchRecords() {
    $.ajax({
        type: "GET",
        datatype: "json",
        url: '/getWarehouse',
        success: function(response) {
            var data = ""
            $.each(response.warehouses, function(key, value) {
                key = key + 1;
                data = data + "<tr>"
                data = data + "<td>" + key + "</td>"
                data = data + "<td>" + value.name + "</td>"
                data = data + "<td>" + value.phone + "</td>"
                data = data + "<td>" + value.email + "</td>"
                data = data + "<td>" + value.address + "</td>"
                data = data + "<td>" + value.is_active + "</td>"
                data = data + "<td>"
                    // data = data + "<button class='btn btn-sm btn-primary mr-2' onclick='editData("+value.id+")' data-toggle='modal' data-target='#myModal'>Edit</button>"
                    //data = data + "<input type='button' value='Delete' class="+"delete, btn btn-sm btn-danger mr-2" +"'data-id='"+value.id+"' >"
                data = data + "<a class='edit' data-id='" + value.id + "' data-feather='edit' data-toggle='modal' data-target='#editWarehouseModal'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit' style='margin-right: 10px'><path d='M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7'></path><path d='M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z'></path></svg></a>"
                data = data + "<a class='delete' data-id='" + value.id + "' data-feather='delete' data-toggle='modal' data-target='#deleteModal'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-delete'><path d='M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z'></path><line x1='18' y1='9' x2='12' y2='15'></line><line x1='12' y1='9' x2='18' y2='15'></line></svg></a>"

                data = data + "</td>"
                data = data + "</tr>"
            })
            $('tbody').html(data);
        },
        error: function(response) {
            alert('error');
            console.log(response);
        }
    });
}