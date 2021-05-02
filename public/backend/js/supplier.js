(function($) {
    $(document).ready(function() {
        //alert('ssds');
        //var form = $('#addSupplierForm');

        //alert("enter to leave.js");
        //let employee_id = $("input[name=employee_id]").val();
        //alert('/employee/LeaveRequestTable/' + employee_id);
        //alert(employee_id);
        /**
         * Admin Expense
         */


        var tableLoadSupplierList = $('#supplierDT').DataTable({
            ajax: '/admin/supplierListTable',
            columns: [
                // {
                //     "data": null,
                //     "sortable": false,
                //     render: function(data, type, row, meta) {
                //         return '<span class="ml-3">'+ (meta.row + meta.settings._iDisplayStart + 1)  + '</span>';
                //     }
                // },
                {
                    "data": null,
                    render: function(data, type, row) {
                        return [`<img src="/uploads/supplier/${row.image}" ' + "${row.image}" + 'alt="Admin" class="rounded-circle" width="65px" height="65px"></img>`];
                    }
                },
                { "data": "name" },
                { "data": "company_name" },
                { "data": "vat_number" },
                { "data": "email" },
                { "data": "phone" },
                { "data": "address" },
                // { "data": "city" },
                // { "data": "state" },
                // { "data": "postal_code" },
                // { "data": "country" },
                {
                    "data": null,
                    render: function(data, type, row) {
                        return [`<a id="editSupplierModal"  data-id="${row.id}" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit" style="margin-right: 10px"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a> 
                        
                        <a data-id="${row.id}" id="deleteSupplierModal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg></a>`];
                    }
                }
            ]
        });


        $('#addSupplierForm').on('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#nameError').text('');
            $('#company_nameError').text('');
            $('#vatError').text('');
            $('#phoneError').text('');
            $('#emailError').text('');
            $('#imageError').text('');
            $('#addressError').text('');
            $('#cityError').text('');
            $('#stateError').text('');
            $('#postal_codeError').text('');
            $('#countryError').text('');

            $.ajax({
                url: '/admin/add-supplierList',
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    swal("Inserted!", "Data has been Successfully Insert!", "success");
                    $('#add_supplier_modal form :input').val("");
                    $('#add_supplier_modal').modal('hide');
                    //$(this).removeData('#add_supplier_modal');
                    tableLoadSupplierList.ajax.reload();
                    //alert(data.id);
                },
                error: function(response) {
                    console.log(response);
                    // swal("Warning!", "All The Field is required!", "warning");
                    //alert('error');
                    //console.log(response);
                    $('#nameError').text(response.responseJSON.errors.name);
                    $('#company_nameError').text(response.responseJSON.errors.company_name);
                    $('#vatError').text(response.responseJSON.errors.vat_number);
                    $('#phoneError').text(response.responseJSON.errors.phone);
                    $('#emailError').text(response.responseJSON.errors.email);
                    $('#imageError').text(response.responseJSON.errors.image);
                    $('#addressError').text(response.responseJSON.errors.address);
                    $('#cityError').text(response.responseJSON.errors.city);
                    $('#stateError').text(response.responseJSON.errors.state);
                    $('#postal_codeError').text(response.responseJSON.errors.postal_code);
                    $('#countryError').text(response.responseJSON.errors.country);
                }
            })
        });



        //Admin Delete Leave Type
        $(document).on('click', 'a#deleteSupplierModal', function(e) {
            e.preventDefault();

            $('#delete_supplier_modal').modal('show');
            let supplierID = $(this).attr('data-id');
            $('#delete_supplier_modal input[name="supplierID"]').val(supplierID);
            //alert(supplierID);

        });

        $(document).on('click', '#deleteSupplier', function(e) {
            e.preventDefault();
            let supplierID = $('#delete_supplier_modal input[name="supplierID"]').val();
            //alert(supplierID);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/delete-supplierList/' + supplierID,
                method: 'POST',
                dataType: "json",
                success: function(response) {
                    swal("Deleted!", "Supplier has been Successfully Delete!", "success");
                    $('#delete_supplier_modal').modal('hide');
                    tableLoadSupplierList.ajax.reload();
                    //alert(data.id);
                },
                error: function(response) {
                    alert('error');
                    console.log(response);
                }
            });


        });


        //Admin Edit Supplier
        $(document).on('click', '#editSupplierModal', function(e) {
            e.preventDefault();
            $('#edit_supplier_modal').modal('show');
            let supplierID = $(this).attr('data-id');
            $('#edit_supplier_modal input[name="supplierID"]').val(supplierID);

            //alert(leaveRequestID);
            $.ajax({
                url: '/admin/edit-supplierList/' + supplierID,
                method: 'get',
                dataType: "json",
                success: function(data) {
                    console.log(data);

                    //$("#referenceEdit").val(data.reference).change();;
                    $('#edit_supplier_modal input[name="nameEdit"]').val(data.name);
                    $('#edit_supplier_modal input[name="company_nameEdit"]').val(data.company_name);
                    $('#edit_supplier_modal input[name="phoneEdit"]').val(data.phone);
                    $('#edit_supplier_modal input[name="vatEdit"]').val(data.vat_number);
                    $('#edit_supplier_modal input[name="emailEdit"]').val(data.email);
                    $('#edit_supplier_modal input[name="imageEdit"]').val('');

                    $('#edit_supplier_modal input[name="cityEdit"]').val(data.city);
                    $('#edit_supplier_modal input[name="stateEdit"]').val(data.state);
                    $('#edit_supplier_modal input[name="postal_codeEdit"]').val(data.postal_code);
                    $('#edit_supplier_modal input[name="countryEdit"]').val(data.country);
                    //$('#edit_supplier_modal input[name="imageEdit"]').val(data.image);

                    // $('#edit_supplier_modal textarea[name="addressEdit"]').val(data.address);
                    $("textarea[name='addressEdit']").val(data.address);

                    $('#edit_supplier_modal').modal('show');

                    $('#nameEditError').text('');
                    $('#company_nameEditError').text('');
                    $('#vatEditError').text('');
                    $('#phoneEditError').text('');
                    $('#emailEditError').text('');
                    $('#addressEditError').text('');
                    $('#cityEditError').text('');
                    $('#stateEditError').text('');
                    $('#postal_codeEditError').text('');
                    $('#countryEditError').text('');
                },
                error: function(data) {
                    alert('error');
                    console.log(data);
                }
            });

        });


        $('#supplierEditForm').on('submit', function(event) {
            event.preventDefault();
            let supplierID = $('#edit_supplier_modal input[name="supplierID"]').val();
            //alert(supplierID);
            var formData = new FormData(this);

            let updateForm = $(this).parent().parent().parent().find('form');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/edit-supplierList/' + supplierID,
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    swal("Updated!", "Data has been Successfully Update!", "success");
                    //$('#edit_supplier_modal form :input').val("");
                    $('#edit_supplier_modal').modal('hide');
                    //$(this).removeData('#add_supplier_modal');
                    tableLoadSupplierList.ajax.reload();
                    //alert(data.id);
                },
                error: function(data) {
                    console.log(data);
                    // swal("Warning!", "All The Field is required!", "warning");
                    //alert('error');
                    //console.log(response);

                    updateForm.find('#nameEditError').text(data.responseJSON.errors.nameEdit);
                    updateForm.find('#company_nameEditError').text(data.responseJSON.errors.company_nameEdit);
                    updateForm.find('#vatEditError').text(data.responseJSON.errors.vatEdit);
                    updateForm.find('#phoneEditError').text(data.responseJSON.errors.phoneEdit);
                    updateForm.find('#emailEditError').text(data.responseJSON.errors.emailEdit);
                    updateForm.find('#addressEditError').text(data.responseJSON.errors.addressEdit);
                    updateForm.find('#cityEditError').text(data.responseJSON.errors.cityEdit);
                    updateForm.find('#stateEditError').text(data.responseJSON.errors.stateEdit);
                    updateForm.find('#postal_codeEditError').text(data.responseJSON.errors.postal_codeEdit);
                    updateForm.find('#countryEditError').text(data.responseJSON.errors.countryEdit);
                }
            })
        });


        /**
         * Admin Expense Catagory
         */

        var tableLoadExpenseCategoryList = $('#expenseCategoryDT').DataTable({
            ajax: '/admin/expenseCategoryListTable',
            columns: [
                { "data": "code" },
                { "data": "name" },
                {
                    "data": null,
                    render: function(data, type, row) {
                        return [`<a id="editExpenseCategoryModal"  data-id="${row.id}" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit" style="margin-right: 10px"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a> 
                        
                        <a data-id="${row.id}" id="deleteExpenseCategoryModal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg></a>`];
                    }
                }
            ]
        });

        $(document).on('click', '#rendomCategoryCode', function(e) {
            e.preventDefault();
            var code = Math.floor(100000 + Math.random() * 900000);
            //alert(code);
            $("input[name=code]").val(code);
            $("input[name=codeEdit]").val(code);

        });


        $(document).on('click', '#addExpenseCategory', function(e) {
            e.preventDefault();
            let code = $("input[name=code]").val();
            let name = $("input[name=name]").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/add-expenseCategoryList',
                method: 'POST',
                data: {
                    'code': code,
                    'name': name,
                },
                dataType: "json",
                success: function(response) {
                    swal("Inserted!", "Data has been Successfully Insert!", "success");
                    $('#add_expenseCategory_modal form :input').val("");
                    $('#add_expenseCategory_modal').modal('hide');
                    //$(this).removeData('#add_expense_modal');
                    tableLoadExpenseCategoryList.ajax.reload();
                    //alert(data.id);
                },
                error: function(response) {
                    swal("Warning!", "All The Field is required!", "warning");
                    //alert('error');
                    console.log(response);
                }
            });


        });

        $(document).on('click', 'a#editExpenseCategoryModal', function(e) {
            e.preventDefault();
            $('#edit_expenseCategory_modal').modal('show');
            let expenseCategoryID = $(this).attr('data-id');
            $('#edit_expenseCategory_modal input[name="expenseCategoryID"]').val(expenseCategoryID);

            //alert(leaveRequestID);
            $.ajax({
                url: '/admin/edit-expenseCategoryList/' + expenseCategoryID,
                method: 'get',
                dataType: "json",
                success: function(data) {
                    console.log(data);

                    $('#edit_expenseCategory_modal input[name="codeEdit"]').val(data.code);
                    $('#edit_expenseCategory_modal input[name="nameEdit"]').val(data.name);

                    $('#edit_expenseCategory_modal').modal('show');
                },
                error: function(data) {
                    alert('error');
                    console.log(data);
                }
            });

        });

        $(document).on('click', '#editExpenseCategory', function(e) {
            e.preventDefault();

            let code = $('#edit_expenseCategory_modal input[name="codeEdit"]').val();
            let name = $('#edit_expenseCategory_modal input[name="nameEdit"]').val();

            let expenseCategoryID = $('#edit_expenseCategory_modal input[name="expenseCategoryID"]').val();
            //alert(percalender);
            //alert('/employee/edit-LeaveRequest/' + leaveRequestID);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/edit-expenseCategoryList/' + expenseCategoryID,
                method: 'POST',
                data: {
                    'code': code,
                    'name': name,
                },
                success: function(response) {
                    console.log(response);
                    $('#edit_expenseCategory_modal').modal('hide');
                    tableLoadExpenseCategoryList.ajax.reload();

                    //alert(data.id);
                },
                error: function(response) {
                    alert('error');
                    console.log(response);
                }
            });


        });

        //Admin Delete ExpenseCategory
        $(document).on('click', 'a#deleteExpenseCategoryModal', function(e) {
            e.preventDefault();

            $('#delete_expenseCategory_modal').modal('show');
            let expenseCategoryID = $(this).attr('data-id');
            $('#delete_expenseCategory_modal input[name="expenseCategoryID"]').val(expenseCategoryID);
            //alert(leaveTypeID);

        });

        $(document).on('click', '#deleteExpenseCategory', function(e) {
            e.preventDefault();
            let expenseCategoryID = $('#delete_expenseCategory_modal input[name="expenseCategoryID"]').val();
            //alert(leaveRequestID);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/delete-expenseCategoryList/' + expenseCategoryID,
                method: 'POST',
                dataType: "json",
                success: function(response) {
                    swal("Deleted!", "Data has been Successfully Delete!", "success");
                    $('#delete_expenseCategory_modal').modal('hide');
                    tableLoadExpenseCategoryList.ajax.reload();
                    //alert(data.id);
                },
                error: function(response) {
                    alert('error');
                    console.log(response);
                }
            });


        });













































    });

})(jQuery)