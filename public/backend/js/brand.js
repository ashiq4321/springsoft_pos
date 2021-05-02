(function($) {
    $(document).ready(function() {


        /**
         * Admin Product Catagory
         */

           var tableLoadProductCategoryList = $('#productCategory').DataTable({
            ajax: '/admin/productCategoryList',
            columns: [{
                    "data": null,
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": null,
                    render: function(data, type, row) {
                        return [`<img src="/uploads/product/category/${row.image}" ' + "${row.image}" + 'alt="Admin" class="rounded-circle" width="65px" height="65px"></img>`];
                    }
                },
                {
                    "data": "name"
                },
                {
                    "data": "is_active",
                    render: function(data, type, row) {
                        return data == '1' ? '<span class="badge badge-info">Active</span>' : '<span class="badge  badge-danger">Inactive</span>';
                    }
                },
                {
                    "data": "category_name"
                },
                {
                    "data": null,
                    render: function(data, type, row) {
                        return [`<a id="editProductCategoryModal"  data-id="${row.id}" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit" style="margin-right: 10px"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a> 
                    
                    <a data-id="${row.id}" id="deleteProductCategoryModal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg></a>`];
                    }
                }
            ]
        });

      $('#addProductCategoryFrom').on('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/add-productBrand',
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    swal("Inserted!", "Data has been Successfully Insert!", "success");
                    $('#add_productCategory_modal form :input').val("");
                    $('#add_productCategory_modal').modal('hide');
                    //$(this).removeData('#add_supplier_modal');
                    tableLoadProductCategoryList.ajax.reload();
                    //alert(data.id);
                },
                error: function(data) {
                    console.log(data);
                    swal("Warning!", "All The Field is required!", "warning");
                    //alert('error');
                    //console.log(response);
                }
            })
        });
        
        
        
        //Admin Edit Supplier
        $(document).on('click', 'a#editProductCategoryModal', function(e) {
            e.preventDefault();
            //$('#edit_productCategory_modal').modal('show');
            let productCategoryID = $(this).attr('data-id');
            $('#edit_productCategory_modal input[name="productBrandID"]').val(productCategoryID);

            //alert(leaveRequestID);
            $.ajax({
                url: '/admin/edit-productBrand/' + productCategoryID,
                method: 'get',
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    //var status = data.status == '1' ? 'Active' : 'Inactive';
                    //alert(status);

                    //$("#referenceEdit").val(data.reference).change();;
//                     $('#edit_productCategory_modal input[name="productBrandID"]').val(data.id);
                     
                    $('#edit_productCategory_modal input[name="brand_nameEdit"]').val(data.category_name);
                    $('#edit_productCategory_modal input[name="imageEdit"]').val('');
                    $("#productCategoryStatusEdit").val(data.is_active).change();
                    $("#categoryEdit").val(data.category_id).change();;

                    $('#edit_productCategory_modal').modal('show');
                },
                error: function(data) {
                    alert('error');
                    console.log(data);
                }
            });

        });


        $('#editProductCategoryFrom').on('submit', function(event) {
            event.preventDefault();
            let productCategoryID = $('#edit_productCategory_modal input[name="productBrandID"]').val();
            //alert(productCategoryID);
            var formData = new FormData(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/edit-productBrand/' + productCategoryID,
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    swal("Updated!", "Data has been Successfully Update!", "success");
                    //$('#edit_supplier_modal form :input').val("");
                    $('#edit_productCategory_modal').modal('hide');
                    //$(this).removeData('#add_supplier_modal');
                    tableLoadProductCategoryList.ajax.reload();
                    //alert(data.id);
                },
                error: function(data) {
                    console.log(data);
                    swal("Warning!", "All The Field is required!", "warning");
                    //alert('error');
                    //console.log(response);
                }
            })
        });


        //Admin Delete category
        $(document).on('click', 'a#deleteProductCategoryModal', function(e) {
            e.preventDefault();

            $('#delete_productCategory_modal').modal('show');
            let productCategoryID = $(this).attr('data-id');
            $('#delete_productCategory_modal input[name="productCategoryID"]').val(productCategoryID);
            //alert(supplierID);

        });

        $(document).on('click', '#deleteProductCategory', function(e) {
            e.preventDefault();
            let productCategoryID = $('#delete_productCategory_modal input[name="productCategoryID"]').val();
            //alert(supplierID);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/delete-brand/' + productCategoryID,
                method: 'POST',
                dataType: "json",
                success: function(response) {
                    swal("Deleted!", "Category has been Successfully Delete!", "success");
                    $('#delete_productCategory_modal').modal('hide');
                    tableLoadProductCategoryList.ajax.reload();
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