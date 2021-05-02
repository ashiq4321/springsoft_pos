(function($) {
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // --- Render --- //
        var tableLoadBillerList = $('#billerDT').DataTable({
            ajax: '/admin/biller-operations',
            columns: [
                // {
                //     "data": null,
                //     "sortable": false,
                //     render: function(data, type, row, meta) {
                //         return meta.row + meta.settings._iDisplayStart + 1;
                //     }
                // },
                {
                    "data": null,
                    render: function(data, type, row) {
                        return [`<img src="/uploads/billers/${row.image}" ' + "${row.image}" + 'alt="Admin" class="rounded-circle" width="65px" height="65px"></img>`];
                    }
                },
                { "data": "name" },
                { "data": "company_name" },
                { "data": "vat_number" },
                { "data": "email" },
                { "data": "phone_number" },
                { "data": "address" },
                // { "data": "city" },
                // { "data": "state" },
                // { "data": "postal_code" },
                // { "data": "country" },
                {
                    "data": null,
                    render: function(data, type, row) {
                        return [`<a id="editBillerModal"  data-id="${row.id}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit" style="margin-right: 10px"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a> 
                        
                        <a data-id="${row.id}" id="deleteBillerModal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg></a>`];
                    }
                }
            ]
        });

        // --- Store --- //
        $('#addBillerForm').on('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            $('#nameError').text('');
            $('#company_nameError').text('');
            $('#vat_numberError').text('');
            $('#phone_numberError').text('');
            $('#emailError').text('');
            $('#imageError').text('');
            $('#addressError').text('');
            $('#cityError').text('');
            $('#stateError').text('');
            $('#postal_codeError').text('');
            $('#countryError').text('');

            $.ajax({
                url: '/admin/biller-operations',
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    swal("Inserted!", "Data has been Successfully Insert!", "success");
                    $('#add_biller_modal form :input').val("");
                    $('#add_biller_modal').modal('hide');
                    //$(this).removeData('#add_biller_modal');
                    tableLoadBillerList.ajax.reload();
                    //alert(data.id);
                },
                error: function(response) {
                    // console.log(data);
                    // swal("Warning!", "All The Field is required!", "warning");
                    //alert('error');
                    //console.log(response);

                    $('#nameError').text(response.responseJSON.errors.name);
                    $('#company_nameError').text(response.responseJSON.errors.company_name);
                    $('#vat_numberError').text(response.responseJSON.errors.vat_number);
                    $('#phone_numberError').text(response.responseJSON.errors.phone_number);
                    $('#emailError').text(response.responseJSON.errors.email);
                    $('#imageError').text(response.responseJSON.errors.image);
                    $('#addressError').text(response.responseJSON.errors.address);
                    $('#cityError').text(response.responseJSON.errors.city);
                    $('#stateError').text(response.responseJSON.errors.state);
                    $('#postal_codeError').text(response.responseJSON.errors.postal_code);
                    $('#countryError').text(response.responseJSON.errors.country);
                }
            });
        });

        // --- Edit --- //
        $('body').on('click', '#editBillerModal', function() {

            $('#edit_biller_modal').modal('show');
            let billerID = $(this).attr('data-id');
            $('input[name="billerID"]').val(billerID);

            let route = '/admin/biller-operations/' + billerID + '/edit';

            $.ajax({
                url: route,
                // dataType: 'html',
                success: function(data) {
                    $('.modal-body').find('.loadForm').html(data);
                    // console.log(data);
                },
                error: function(data) {
                    // console.log(data);
                }
            });
        });

        // --- Update --- //
        $('body').on('click', '#updateBiller', function(event) {
            event.preventDefault();
            let action = $('#globalForm').attr('action');
            let globalForm = $('#globalForm');

            let updateForm = $(this).parent().parent().parent().find('form');
            
            $.ajax({
                url: action,
                data: new FormData(globalForm[0]),
                async: false,
                type: 'post',
                processData: false,
                contentType: false,
                success: function(data) {
                    // console.log(data);
                    swal("Updated!", "Data has been Successfully Update!", "success");
                    $('#edit_biller_modal').modal('hide');
                    tableLoadBillerList.ajax.reload();
                },
                error: function(data) {
                    // console.log(data);
                    // swal("Warning!", "All The Field is required!", "warning");

                    // updateForm.find('#nameError').text('ok');

                    updateForm.find('#nameError').text(data.responseJSON.errors.name);
                    updateForm.find('#company_nameError').text(data.responseJSON.errors.company_name);
                    updateForm.find('#vat_numberError').text(data.responseJSON.errors.vat_numberEdit);
                    updateForm.find('#phone_numberError').text(data.responseJSON.errors.phone_number);
                    updateForm.find('#emailError').text(data.responseJSON.errors.email);
                    updateForm.find('#imageError').text(data.responseJSON.errors.image);
                    updateForm.find('#addressError').text(data.responseJSON.errors.address);
                    updateForm.find('#cityError').text(data.responseJSON.errors.city);
                    updateForm.find('#stateError').text(data.responseJSON.errors.state);
                    updateForm.find('#postal_codeError').text(data.responseJSON.errors.postal_code);
                    updateForm.find('#countryError').text(data.responseJSON.errors.country);

                }
            });
        });

        // --- Delete Alert --- //
        $('body').on('click', '#deleteBillerModal', function(e) {
            $('#delete_biller_modal').modal('show');

            let billerID = $(this).attr('data-id');
            $('#delete_biller_modal input[name="billerID"]').val(billerID);
        });

        // --- Delete Confirm --- //
        $('body').on('click', '#deleteBiller', function(e) {
            e.preventDefault();
            let billerID = $('#delete_biller_modal input[name="billerID"]').val();

            // alert(billerID);

            $.ajax({
                url: '/admin/biller-operations/' + billerID,
                method: 'DELETE',
                success: function(response) {
                    swal("Deleted!", "biller has been Successfully Delete!", "success");
                    $('#delete_biller_modal').modal('hide');
                    tableLoadBillerList.ajax.reload();
                    //alert(data.id);
                },
                error: function(response) {
                    alert('Operation failed!');
                    // console.log(response);
                }
            });
        });

    });

})(jQuery);