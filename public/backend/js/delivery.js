// Pass the CSRF Token
$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

});

// ------------------------getdata----------
    $(document).ready(function() {
        
        var tableLoadDeliveryList = $('#table').DataTable({
            "ajax": {
            "url": "/delivery/data",
            "dataSrc": ""
            },
            columns: [
                { "data": "ref" },
                { "data": "sale_id" },
                { "data": "address" },
                { "data": "deli_by" },
                { "data": "rec_by" },
                {
                    "data": null,
                    render: function(data, type, row) {
                        return [`<img src="/uploads/deliveries/${row.file}" ' + "${row.file}" + 'alt="Admin" class="rounded-circle" width="65px" height="65px"></img>`];
                    }
                },
                { "data": "note" },
                { "data": "status" },
                {
                    "data": null,
                    render: function(data, type, row) {
                        return [`
                        <a id="editDeliveryModal" data-id="${row.id}" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                        class="feather feather-edit" style="margin-right: 10px">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path
                        d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a> 


                        <a id="deleteDeliveryModal" data-id="${row.id}"><svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 
                        8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" 
                        y1="9" x2="18" y2="15"></line></svg></a>`];
                    }
                }
            ],
            buttons: [ 'pdf','csv','print','colvis' ],
            dom: 
                "<'row'<'col-md-4'l><'col-md-6'B><'col-md-2'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
                lengthMenu:[
                    [5,10,25,50,100,-1],
                    [5,10,25,50,100]
                ]
        });
    
        // table.buttons().container()
        //     .appendTo( '#table_wrapper .col-md-5:eq(0)' );

       // --- Edit --- //
       $('body').on('click', '#editDeliveryModal', function() {

            $('#edit_delivery_modal').modal('show');
            let deliveryID = $(this).attr('data-id');
            $('input[name="deliveryID"]').val(deliveryID);

            let route = '/delivery/' + deliveryID +'/edit';

            $.ajax({
                url: route,
                // dataType: 'html',
                success: function (data) {
                    $('.modal-body').find('.loadForm').html(data);
                    // console.log(data);
                },
                error: function (data) {
                    // console.log(data);
                }
            });
        });

        // --- Update --- //
        $('body').on('click', '#updateDelivery', function(event) {
            event.preventDefault();
            let action = $('#globalForm').attr('action');
            let globalForm = $('#globalForm');

            $.ajax({
                url: action,
                data:new FormData(globalForm[0]),
                async:false,
                type:'post',
                processData: false,
                contentType: false,
                success: function(data) {
                    // console.log(data);
                    swal("Updated!", "Data has been Successfully Update!", "success");
                    $('#edit_delivery_modal').modal('hide');
                    tableLoadDeliveryList.ajax.reload();
                },
                error: function(data) {
                    // console.log(data);
                    swal("Warning!", "All The Field is required!", "warning");
                }
            });
        });
        
        // --- Delete Alert --- //
        $('body').on('click', '#deleteDeliveryModal', function(e) {
            $('#delete_delivery_modal').modal('show');

            let deliveryID = $(this).attr('data-id');
            $('#delete_delivery_modal input[name="deliveryID"]').val(deliveryID);
        });

        // --- Delete Confirm --- //
        $('body').on('click', '#deleteDelivery', function(e) {
            e.preventDefault();
            let deliveryID = $('#delete_delivery_modal input[name="deliveryID"]').val();

            // alert(deliveryID);

            $.ajax({
                url: '/delivery/' + deliveryID,
                method: 'DELETE',
                success: function(response) {
                    swal("Deleted!", "delivery has been Successfully Delete!", "success");
                    $('#delete_delivery_modal').modal('hide');
                    tableLoadDeliveryList.ajax.reload();
                    //alert(data.id);
                },
                error: function(response) {
                    alert('error');
                    // console.log(response);
                }
            });
        });
    });