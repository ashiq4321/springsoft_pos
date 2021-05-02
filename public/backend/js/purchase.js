$(document).ready(function() {

    $(document).on('keyup', '#search', function() {
        var query = $(this).val();
        search_product_data(query);
    });

    var selected_product = new Array
    $('#searched_product').click(function() {
        if (!selected_product.includes($('#searched_product').val())) {
            selected_product.push($('#searched_product').val());
            $.ajax({
                url: '/findProduct/' + $('#searched_product').val(),
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    var discount = 10.00;
                    var tax = 32.00;
                    var row = ""
                    row = row + "<tr>"
                    row = row + "<td>" + data['name'] + "</td>"
                    row = row + "<td>" + data['barcode_symbology'] + "</td>"
                    row = row + "<td><input type='number' min='1' class='qty'></td>"
                    row = row + "<td><input type='number'class='unit_rate' value='" + data['price'] + "'/></td>"
                    row = row + "<td><input type='number'class='discount' value='" + discount + "'/></td>"
                    row = row + "<td><input type='number'class='tax' value='" + tax + "'/></td>"
                    row = row + "<td><input type='number' class='sub-total' value='" + (1 * data['price'] + tax - discount) + "'/></td>" //{qty}*{unit_rate}+{tax}-{disc}
                    row = row + "<td><a type='button'class='delete' data-feather='delete' value ='delete' data-id='" + data['id'] + "' ><svg xmlns='http: //www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-delete'><path d='M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z'></path><line x1='18' y1='9' x2='12' y2='15'></line><line x1='12' y1='9' x2='18' y2='15'></line></svg></a></td>"
                    row = row + "</tr>"
                    $('#each_product').append(row);
                },
                error: function(response) {
                    alert('error');
                    console.log(response);
                }
            })

        }

    });

    // row = row + "<td><a type='button'class='delete' data-feather='delete' value ='delete' data-id='" + data['id'] + "' ><svg xmlns='http: //www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-delete'><path d='M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z'></path><line x1='18' y1='9' x2='12' y2='15'></line><line x1='12' y1='9' x2='18' y2='15'></line></svg></a></td>"

    // Delete record
    $(document).on("click", ".delete", function() {
        var remove_id = $(this).data('id');
        removeElement(selected_product, remove_id.toString());
        var el = this;
        $(el).closest("tr").remove();
        calculateTotal();
    });

    $(document).on('keyup', '#each_product', function() {
        $('tr').each(function() {
            var unit_rate = parseInt($(this).find('.unit_rate').val())
            var discount = parseInt($(this).find('.discount').val())
            var tax = parseInt($(this).find('.tax').val())
            var qty = parseInt($(this).find('.qty').val())
            $(this).find('.sub-total').val(qty * unit_rate + tax - discount);
        });
        calculateTotal();
    });

    $('#order_tax_rate').click(function() {
        calculateGrandTotal();
    });

    $('input[name="order_discount"]').keyup(function() {
        calculateGrandTotal();
    });

    $('input[name="shipping_cost"]').keyup(function() {
        calculateGrandTotal();
    });

});

function calculateTotal() {
    //Sum of quantity
    var total_qty = 0;
    $(".qty").each(function() {
        if ($(this).val() == '') {
            total_qty += 0;
        } else {
            total_qty += parseFloat($(this).val());
        }
    });
    $("#total-qty").text(total_qty);
    $('input[name="total_qty"]').val(total_qty);

    //Sum of discount
    var total_discount = 0;
    $(".discount").each(function() {
        total_discount += parseFloat($(this).val());
    });
    $("#total-discount").text(total_discount.toFixed(2));
    $('input[name="total_discount"]').val(total_discount.toFixed(2));

    //Sum of tax
    var total_tax = 0;
    $(".tax").each(function() {
        total_tax += parseFloat($(this).val());
    });
    $("#total-tax").text(total_tax.toFixed(2));
    $('input[name="total_tax"]').val(total_tax.toFixed(2));

    //Sum of subtotal
    var total = 0;
    $(".sub-total").each(function() {
        total += parseFloat($(this).val());
    });
    $("#total").text(total.toFixed(2));
    $('input[name="total_cost"]').val(total.toFixed(2));

    calculateGrandTotal();
}


//calculate grand total
function calculateGrandTotal() {

    var item = $('table.order-list tbody tr:last').index();

    var total_qty = parseFloat($('#total-qty').text());
    var subtotal = parseFloat($('#total').text());
    var order_tax = parseFloat($('select[name="order_tax_rate"]').val());
    var order_discount = parseFloat($('input[name="order_discount"]').val());
    var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());

    if (!order_discount)
        order_discount = 0.00;
    if (!shipping_cost)
        shipping_cost = 0.00;

    item = ++item + '(' + total_qty + ')';
    order_tax = (subtotal - order_discount) * (order_tax / 100);
    var grand_total = (subtotal + order_tax + shipping_cost) - order_discount;

    $('#item').text(item);
    $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);
    $('#subtotal').text(subtotal.toFixed(2));
    $('#order_tax').text(order_tax.toFixed(2));
    $('#order_discount').text(order_discount);
    $('#shipping_cost').text(shipping_cost.toFixed(2));
    $('#grand_total').text(grand_total.toFixed(2));
    $('input[name="grand_total"]').val(grand_total.toFixed(2));
}


//search products
function search_product_data(query = '') {
    $.ajax({
        url: '/getProductToPurchase',
        method: 'GET',
        data: { query: query },
        dataType: 'json',
        success: function(data) {
            var len = data.length;
            $("#searched_product").empty();
            if (len != null) {
                for (var i = 0; i < len; i++) {
                    var id = data[i]['id'];
                    var name = data[i]['name'];
                    var barcode_symbology = data[i]['barcode_symbology']; //code

                    $("#searched_product").append("<option value='" + id + "'>" + barcode_symbology + '(' + name + ')' + "</option>");

                }
            }
        },
        error: function(response) {
            alert('error');
            console.log(response);
        }
    })
}

//to remove from cart
function removeElement(array, elem) {
    var index = array.indexOf(elem);
    if (index > -1) {
        array.splice(index, 1);
    }
}