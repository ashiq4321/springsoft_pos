(function($) {
    $(document).ready(function() {
        //alert('ssds');


        //alert("enter to leave.js");
        //let employee_id = $("input[name=employee_id]").val();
        //alert('/employee/LeaveRequestTable/' + employee_id);
        //alert(employee_id);
        /**
         * Admin Expense
         */
        var tableLoadExpenseList = $('#leaveTypeDT').DataTable({
            ajax: '/admin/expenseListTable',
            columns: [
                { "data": "date" },
                { "data": "reference" },
                { "data": "warehouse" },
                { "data": "category" },
                { "data": "amount" },
                { "data": "note" },
                {
                    "data": null,
                    render: function(data, type, row) {
                        return [`<a id="editExpenseModal"  data-id="${row.id}" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit" style="margin-right: 10px"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a> 
                        
                        <a data-id="${row.id}" id="deleteExpenseModal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg></a>`];
                    }
                }
            ]
        });

        $(document).on('click', '#addExpense', function(e) {
            e.preventDefault();

            $('#dateError').text('');
            $('#referenceError').text('');
            $('#warehouseError').text('');
            $('#categoryError').text('');
            $('#amountError').text('');

            let date = $("input[name=date]").val();
            let warehouse = $("#warehouse").val();
            let category = $("#category").val();
            let amount = $("input[name=amount]").val();
            let note = $("input[name=note]").val();
            let reference = $('#reference').val();

            //console.log(reference, category, warehouse);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/add-expenseList',
                method: 'POST',
                data: {
                    'date': date,
                    'reference': reference,
                    'warehouse': warehouse,
                    'category': category,
                    'amount': amount,
                    'note': note
                },
                dataType: "json",
                success: function(response) {
                    swal("Inserted!", "Data has been Successfully Insert!", "success");
                    $('#add_expense_modal form :input').val("");
                    $('#add_expense_modal').modal('hide');
                    //$(this).removeData('#add_expense_modal');
                    tableLoadExpenseList.ajax.reload();
                    //alert(data.id);
                },
                error: function(error) {
                    //swal("Warning!", "All The Field is required!", "warning");
                    //alert('error');
                    console.log(error);

                    $('#dateError').text(error.responseJSON.errors.date);
                    $('#referenceError').text(error.responseJSON.errors.reference);
                    $('#warehouseError').text(error.responseJSON.errors.warehouse);
                    $('#categoryError').text(error.responseJSON.errors.category);
                    $('#amountError').text(error.responseJSON.errors.amount);

                }
            });


        });


        //Admin Delete Leave Type
        $(document).on('click', 'a#deleteExpenseModal', function(e) {
            e.preventDefault();

            $('#delete_expense_modal').modal('show');
            let expenseID = $(this).attr('data-id');
            $('#delete_expense_modal input[name="expenseID"]').val(expenseID);
            //alert(leaveTypeID);

        });

        $(document).on('click', '#deleteExpense', function(e) {
            e.preventDefault();
            let expenseID = $('#delete_expense_modal input[name="expenseID"]').val();
            //alert(leaveRequestID);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/delete-expenseList/' + expenseID,
                method: 'POST',
                dataType: "json",
                success: function(response) {
                    swal("Deleted!", "Data has been Successfully Delete!", "success");
                    $('#delete_expense_modal').modal('hide');
                    tableLoadExpenseList.ajax.reload();
                    //alert(data.id);
                },
                error: function(response) {
                    alert('error');
                    console.log(response);
                }
            });


        });


        //Admin Edit Type
        $(document).on('click', 'a#editExpenseModal', function(e) {
            e.preventDefault();
            $('#edit_expense_modal').modal('show');
            let expenseID = $(this).attr('data-id');
            $('#edit_expense_modal input[name="expenseID"]').val(expenseID);

            //alert(leaveRequestID);
            $.ajax({
                url: '/admin/edit-expenseList/' + expenseID,
                method: 'get',
                dataType: "json",
                success: function(data) {
                    console.log(data);

                    $("#referenceEdit").val(data.reference).change();
                    $("#warehouseEdit").val(data.warehouse).change();
                    $("#categoryEdit").val(data.category).change();
                    $('#edit_expense_modal input[name="dateEdit"]').val(data.date);
                    //$('#edit_expense_modal input[name="categoryEdit"]').val(data.category);
                    //$('#edit_expense_modal input[name="warehouseEdit"]').val(data.warehouse);
                    $('#edit_expense_modal input[name="amountEdit"]').val(data.amount);
                    $('#edit_expense_modal input[name="noteEdit"]').val(data.note);

                    $('#edit_expense_modal').modal('show');
                },
                error: function(data) {
                    alert('error');
                    console.log(data);
                }
            });

        });

        $(document).on('click', '#editExpense', function(e) {
            e.preventDefault();

            $('#dateErrorEdit').text('');
            $('#referenceErrorEdit').text('');
            $('#warehouseErrorEdit').text('');
            $('#categoryErrorEdit').text('');
            $('#amountErrorEdit').text('');


            let date = $('#edit_expense_modal input[name="dateEdit"]').val();
            //let warehouse = $('#edit_expense_modal input[name="warehouseEdit"]').val();
            //let category = $('#edit_expense_modal input[name="categoryEdit"]').val();
            let amount = $('#edit_expense_modal input[name="amountEdit"]').val();
            let note = $('#edit_expense_modal input[name="noteEdit"]').val();
            let reference = $("#referenceEdit").val();
            let warehouse = $("#warehouseEdit").val();
            let category = $("#categoryEdit").val();

            let expenseID = $('#edit_expense_modal input[name="expenseID"]').val();
            //alert(percalender);
            //alert('/employee/edit-LeaveRequest/' + leaveRequestID);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/edit-expenseList/' + expenseID,
                method: 'POST',
                data: {
                    'date': date,
                    'reference': reference,
                    'warehouse': warehouse,
                    'category': category,
                    'amount': amount,
                    'note': note
                },
                success: function(response) {
                    console.log(response);
                    swal("Updated!", "Data has been Successfully Update!", "success");
                    $('#edit_expense_modal').modal('hide');
                    tableLoadExpenseList.ajax.reload();

                    //alert(data.id);
                },
                error: function(error) {
                    //alert('error');
                    console.log(error.responseJSON.errors.reference);

                    $('#dateErrorEdit').text(error.responseJSON.errors.date);
                    $('#referenceErrorEdit').text(error.responseJSON.errors.reference);
                    $('#warehouseErrorEdit').text(error.responseJSON.errors.warehouse);
                    $('#categoryErrorEdit').text(error.responseJSON.errors.category);
                    $('#amountErrorEdit').text(error.responseJSON.errors.amount);
                }
            });


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

            $('#codeError').text('');
            $('#nameError').text('');
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
                error: function(error) {

                    $('#codeError').text(error.responseJSON.errors.code);
                    $('#nameError').text(error.responseJSON.errors.name);

                    //swal("Warning!", "'  '", "warning");
                    //alert('error');

                    console.log(error);
                    //console.log(response.responseText[errors[0]]);
                    // var err = JSON.parse(response.responseText);
                    // console.log(err.errors);
                }
            });


        });

        $(document).on('click', 'a#editExpenseCategoryModal', function(e) {
            e.preventDefault();
            $('#codeError').text('');
            $('#nameError').text('');
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
                error: function(error) {
                    $('#codeError').text(error.responseJSON.errors.code);
                    $('#nameError').text(error.responseJSON.errors.name);
                    // alert('error');
                    // console.log(data);
                }
            });

        });

        $(document).on('click', '#editExpenseCategory', function(e) {
            e.preventDefault();
            $('#codeErrorEdit').text('');
            $('#nameErrorEdit').text('');

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

                    swal("Updated!", "Data has been Successfully Updated!", "success");
                    tableLoadExpenseCategoryList.ajax.reload();

                    //alert(data.id);
                },
                error: function(error) {
                    console.log(error);
                    $('#codeErrorEdit').text(error.responseJSON.errors.code);
                    $('#nameErrorEdit').text(error.responseJSON.errors.name);
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