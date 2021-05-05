var gift_card_amount = [];
var gift_card_expense = [];

$(document).ready(function() {
    $(document).on('click', '.product-img', function() {
        var product_id = $(this).data('product');
        find_in_warehouse(product_id);
    });

    $("#myTable").on('click', '.plus', function() {
        rowindex = $(this).closest('tr').index();
        product_id = $(this).attr('data-id');
        find_in_warehouse(product_id);
        /* var qty = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val()) + 1;
        var total = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .product-price').text() * qty);
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .sub-total').text(total); */
        calculateTotal();
        //checkQuantity(String(qty), true);
    });
    $('#warehouse_id').change(function() {
        $('input[name="warehouse_id"]').val($('#warehouse_id').val());
        swal("Remember!", "This can not be done!, please reload the page to select another warehouse", "warning") 
        $(this).prop('disabled', true);
    });

    $("#myTable").on('click', '.minus', function() {
        rowindex = $(this).closest('tr').index();
        var qty = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val()) - 1;
        var price = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .product-price').text());
        var total = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .sub-total').text());

        if (qty > 0) {
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .sub-total').text(total - price);
        } else {
            qty = 1;
        }
        calculateTotal();
        //checkQuantity(String(qty), true);
    });

    //Delete product
    $("table.order-list tbody").on("click", ".ibtnDel", function(event) {
        var audio = $("#mysoundclip2")[0];

        $(this).closest("tr").remove();
        calculateTotal();
    });

    $('input[name="shipping_cost"]').keyup(function() {
        calculateGrandTotal();
    });

    $('#order_tax_rate_select').click(function() {
        //$('input[name="order_tax_rate"]').val('#order_tax_rate_select');
        calculateGrandTotal();
    });




    var typingTimer; //timer identifier
    var doneTypingInterval = 2000; //time in ms, 5 second for example
    var $input = $('input[name="coupon-text"]');
    //on keyup, start the countdown
    $input.on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });
    //on keydown, clear the countdown 
    $input.on('keydown', function() {
        clearTimeout(typingTimer);
    });
    //user is "finished typing," do something
    function doneTyping() {
        couponDiscount();
    }

    $('input[name="order_discount"]').keyup(function() {
        calculateGrandTotal();
    });

    $("#gift-card-btn").on("click", function() {
        $("#credit_card_id").attr("required", false);
        $("#submit-btn").prop('disabled', true);
        $('input[name="credit_card_id"]').val('');
        $('#paid_by').val('gift card');
        $('select[name="paid_by_id_select"]').val(2);
        $('.selectpicker').selectpicker('refresh');
        $('div.qc').hide();
        giftCard();
        
    });

    $(".payment-btn").on("click", function() {
        $('input[name="credit_card_id"]').val('');
        var audio = $("#mysoundclip2")[0];

        $('.qc').data('initial', 1);
    });

    $("#draft-btn").on("click", function() {
        $("#credit_card_id").attr("required", true);
        $('input[name="credit_card_id"]').val('');
        var audio = $("#mysoundclip2")[0];
        audio.play();
        $('input[name="sale_status"]').val(3);
        $('input[name="draft"]').val(1);
        $('input[name="paying_amount"]').prop('required', false);
        $('input[name="paid_amount"]').prop('required', false);
        var rownumber = $('table.order-list tbody tr:last').index();
        if (rownumber < 0) {
            alert("Please insert product to order table!")
        } else
            $('.payment-form').submit();
    });

    $("#credit-card-btn").on("click", function() {
        $("#submit-btn").prop('disabled', false);
        $("#credit_card_id").attr("required", true);
        $('select[name="paid_by_id_select"]').val(3);
        $('#paid_by').val('card');
        $('.selectpicker').selectpicker('refresh');
        $('div.qc').hide();
        creditCard();
    });

    $("#cheque-btn").on("click", function() {
        $("#submit-btn").prop('disabled', false);
        $('input[name="credit_card_id"]').val('');
        $('select[name="paid_by_id_select"]').val(4);
        $('.selectpicker').selectpicker('refresh');
        $('div.qc').hide();
        cheque();
    });

    $("#cash-btn").on("click", function() {
        $("#submit-btn").prop('disabled', false);
        $("#credit_card_id").attr("required", false);
        $('input[name="credit_card_id"]').val('');
        $('#paid_by').val('cash');
        $('select[name="paid_by_id_select"]').val('1');
        $('.selectpicker').selectpicker('refresh');
        $('div.qc').show();
        hide();
    });

    /* $("#paypal-btn").on("click", function() {
        $('input[name="credit_card_id"]').val('');
        $('select[name="paid_by_id_select"]').val(5);
        $('.selectpicker').selectpicker('refresh');
        $('div.qc').hide();
        hide();
    });

    $("#deposit-btn").on("click", function() {
        $('input[name="credit_card_id"]').val('');
        $('select[name="paid_by_id_select"]').val(6);
        $('.selectpicker').selectpicker('refresh');
        $('div.qc').hide();
        hide();
        deposits();
    }); */

    /* $('body').on('click', function(e) {
        $('.filter-window').hide('fast','slide');
    }); */

    $('#category-filter').on('click', function(e) {
        e.stopPropagation();
        $('.filter-window').show();
        $('.category').show();
        $('.brand').hide();
    });
    $('.category-img').on('click', function() {
        var category_id = $(this).data('category');
        var brand_id = 0;
        //$(".table-container").children().remove();
        $.ajax({
            url: '/pos/product_category/' + category_id,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('.category').hide();
                $('.filter-window').hide();
                $("#product-table tbody").empty();
                var len = data.length;
                if (len != null) {
                    row = '<tr>'
                    for (var i = 0; i < len; i++) {
                        row += '<td class="product-img sound-btn" title="' + data[i]['name'] + '" data-product ="' + data[i]['id'] + '"><img  src="#" width="100%" /><p>' + data[i]['name'] + '</p><span>' + data[i]['barcode_symbology'] + '</span></td>'
                    }
                    row += '/<tr>'
                    $("#product-table tbody").append(row);
                }
                //populateProduct(data);
            },
            error: function(error) {
                alert('error');
                console.log(error);
            }
        });
        /* $.get('/pos/product_category/' + category_id , function(data) {
            alert(data)
            populateProduct(data);
        }); */
    });
    $('#brand-filter').on('click', function(e) {
        e.stopPropagation();
        $('.filter-window').show();
        $('.brand').show();
        $('.category').hide();
    });

    $('.brand-img').on('click', function() {
        var brand_id = $(this).data('brand');
        //$(".table-container").children().remove();
        $.ajax({
            url: '/pos/product_brand/' + brand_id,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('.category').hide();
                $('.filter-window').hide();
                $("#product-table tbody").empty();
                var len = data.length;
                if (len != null) {
                    row = '<tr>'
                    for (var i = 0; i < len; i++) {
                        row += '<td class="product-img sound-btn" title="' + data[i]['name'] + '" data-product ="' + data[i]['id'] + '"><img  src="#" width="100%" /><p>' + data[i]['name'] + '</p><span>' + data[i]['barcode_symbology'] + '</span></td>'
                    }
                    row += '/<tr>'
                    $("#product-table tbody").append(row);
                }
                //populateProduct(data);
            },
            error: function(error) {
                alert('error');
                console.log(error);
            }
        });

    });

    $('#featured-filter').on('click', function() {
        // $(".table-container").children().remove();
        $("#product-table tbody").empty();
        $.ajax({
            url: '/pos/product_featured/',
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('.category').hide();
                $('.filter-window').hide();
                var len = data.length;
                if (len != null) {
                    row = '<tr>'
                    for (var i = 0; i < len; i++) {
                        row += '<td class="product-img sound-btn" title="' + data[i]['name'] + '" data-product ="' + data[i]['id'] + '"><img  src="#" width="100%" /><p>' + data[i]['name'] + '</p><span>' + data[i]['barcode_symbology'] + '</span></td>'
                    }
                    row += '/<tr>'
                    $("#product-table tbody").append(row);
                }
                //populateProduct(data);
            },
            error: function(error) {
                alert('error');
                console.log(error);
            }
        });

    });
    $(document).on('keyup', '#filter', function() {
        var query = $(this).val();
        search_product_data(query);
    });

    $('#searched_product').on("click", (function() {
        var product_id = $('#searched_product').val();
        find_in_warehouse(product_id);

    }));

    /* $('select[name="paid_by_id_select"]').on("change", function() {
        var id = $(this).val();
        $(".payment-form").off("submit");
        if (id == 2) {
            $('div.qc').hide();
            giftCard();
        } else if (id == 3) {
            $('div.qc').hide();
            creditCard();
        } else if (id == 4) {
            $('div.qc').hide();
            cheque();
        } else {
            hide();
            if (id == 1)
                $('div.qc').show();
            else if (id == 6) {
                $('div.qc').hide();
                deposits();
            }
        }
    }); */


    $('#add-payment select[name="gift_card_id_select"]').on("change", function() {
        $("#submit-btn").prop('disabled', true);
        var balance = gift_card_amount[$(this).val()] - gift_card_expense[$(this).val()];
        $('#add-payment input[name="gift_card_id"]').val($(this).val());
        if(balance==0){
            swal("Empty!", "Gift card is already used! ", "error"); 
        }
        else if ($('input[name="paid_amount"]').val() > balance) {
            swal("invalid!", "Gift card is not sufficient! ", "warning"); 
        }
        else{
            $("#submit-btn").prop('disabled', false);
            newbalance=balance-$('input[name="paid_amount"]').val() ;
            swal("Applied!","Gift Card prev balance: "+balance+"\n Purchased amount: -"+ $('input[name="paid_amount"]').val()+"\n Gift Card new balance: "+ newbalance,"success");
        }
    
    });

    $('#add-payment input[name="paying_amount"]').on("input", function() {
        change($(this).val(), $('input[name="paid_amount"]').val());
    });

    $('input[name="paid_amount"]').on("input", function() {
        if ($(this).val() > parseFloat($('input[name="paying_amount"]').val())) {
            alert('Paying amount cannot be bigger than recieved amount');
            $(this).val('');
        } else if ($(this).val() > parseFloat($('#grand-total').text())) {
            alert('Paying amount cannot be bigger than grand total');
            $(this).val('');
        }

        change($('input[name="paying_amount"]').val(), $(this).val());
        var id = $('select[name="paid_by_id_select"]').val();
        if (id == 2) {
            var balance = gift_card_amount[$("#gift_card_id_select").val()] - gift_card_expense[$("#gift_card_id_select").val()];
            if ($(this).val() > balance)
                alert('Amount exceeds card balance! Gift Card balance: ' + balance);
        } else if (id == 6) {
            if ($('input[name="paid_amount"]').val() > deposit[$('#customer_id').val()])
                alert('Amount exceeds customer deposit! Customer deposit : ' + deposit[$('#customer_id').val()]);
        }
    });

    $('.transaction-btn-plus').on("click", function() {
        $(this).addClass('d-none');
        $('.transaction-btn-close').removeClass('d-none');
    });

    $('.transaction-btn-close').on("click", function() {
        $(this).addClass('d-none');
        $('.transaction-btn-plus').removeClass('d-none');
    });

    $('.coupon-btn-plus').on("click", function() {
        $(this).addClass('d-none');
        $('.coupon-btn-close').removeClass('d-none');
    });

    $('.coupon-btn-close').on("click", function() {
        $(this).addClass('d-none');
        $('.coupon-btn-plus').removeClass('d-none');
    });
    $(document).on('click', '.qc-btn', function(e) {
        if ($(this).data('amount')) {
            if ($('.qc').data('initial')) {
                $('input[name="paying_amount"]').val($(this).data('amount').toFixed(2));
                $('#paid_amount').val($(this).data('amount').toFixed(2));
                $('.qc').data('initial', 0);
            } else {
                $('input[name="paying_amount"]').val((parseFloat($('input[name="paying_amount"]').val()) + $(this).data('amount')).toFixed(2));
            }
        } else
            $('input[name="paying_amount"]').val('0.00');
        change($('input[name="paying_amount"]').val(), $('input[name="paid_amount"]').val());
    });


});

//find selected product
function productSearch(data, stored_quantity) {
    $.ajax({
        type: 'GET',
        url: '/pos/product_search',
        data: {
            data: data
        },
        success: function(data) {
            var flag = 1;
            $(".product-code").each(function(i) {
                if ($(this).val() == data.name) {
                    rowindex = i;
                    var pre_qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val();
                    var qty;
                    if (pre_qty)
                        qty = parseFloat(pre_qty) + 1;
                    else
                        qty = 1;
                    if (qty <= stored_quantity) {
                        var total = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .product-price').text() * qty);
                        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
                        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .sub-total').text(total);
                    } else {
                        alert('Product quantity is not avaialable in the selected warehouse');
                        var total = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .product-price').text() * stored_quantity);
                        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(stored_quantity);
                        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .sub-total').text(total);
                    }

                    flag = 0;
                }
            });
            $("input[name='product_code_name']").val('');
            if (flag) {
                addNewProduct(data);
            }
            calculateTotal();
        },
        error: function(response) {
            alert('error');
            console.log(response);
        }

    });
}

function addNewProduct(data) {
    var newRow = $("<tr>");
    var cols = '';
    //temp_unit_name = (data[6]).split(',');
    cols += '<td class="col-sm-2 product-title"><span ><strong>' + data.name + '</strong></span></td>';
    cols += '<td class="col-sm-2 product-price">' + (data.tax_method == 2 ? (data.price + (data.price * (data.tax_id / 100))) : data.price) + '</td>';
    cols += '<td class="col-sm-4"><div class="input-group"><span class="input-group-btn"><button type="button" class="btn btn-default btn-xs minus"><span class="dripicons-minus"></span></button></span><input type="text" name="qty[]" class="form-control qty numkey input-number" value="1" step="any" required><span class="input-group-btn"><button type="button" data-id="' + data.id + '" class="btn btn-default btn-xs plus"><span class="dripicons-plus"></span></button></span></div></td>';
    cols += '<td class="col-sm-2 sub-total">' + (data.tax_method == 2 ? (data.price + (data.price * (data.tax_id / 100))) : data.price) + '</td>';
    cols += '<td class="col-sm-1"><button type="button" class="ibtnDel btn btn-danger btn-xs"><span class="dripicons-cross"></span></button></td>';
    cols += '<input type="hidden" class="product-code" name="product_code[]" value="' + data.name + '"/>';
    cols += '<input type="hidden" class="product-id" name="product_id[]" value="' + data.id + '"/>';
    cols += '<input type="hidden" class="sale-unit" name="sale_unit[]" value="' + data.name + '"/>';
    cols += '<input type="hidden" class="net_unit_price" name="net_unit_price[]" />';
    cols += '<input type="hidden" class="discount-value" name="discount[]" />';
    cols += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="' + data.tax_id + '"/>';
    cols += '<input type="hidden" class="tax-value" name="tax[]" />';
    cols += '<input type="hidden" class="subtotal-value" name="subtotal[]" />';

    newRow.append(cols);
    $("table.order-list tbody").append(newRow);
}


//Unit conversion
function calculateTotal() {
    //Sum of quantity
    var total_qty = 0;
    $("table.order-list tbody .qty").each(function(index) {
        if ($(this).val() == '') {
            total_qty += 0;
        } else {
            total_qty += parseFloat($(this).val());
        }
    });
    $('input[name="total_qty"]').val(total_qty);

    /* //Sum of discount
    var total_discount = 0;
    $("table.order-list tbody .discount-value").each(function() {
        total_discount += parseFloat($(this).val());
    });

    $('input[name="total_discount"]').val(total_discount.toFixed(2));

    //Sum of tax
    var total_tax = 0;
    $(".tax-value").each(function() {
        total_tax += parseFloat($(this).val());
    });

    $('input[name="total_tax"]').val(total_tax.toFixed(2));
 */
    //Sum of subtotal
    var total = 0;
    $(".sub-total").each(function() {
        total += parseFloat($(this).text());
    });
    $('input[name="total_price"]').val(total.toFixed(2));

    calculateGrandTotal();
}

function calculateGrandTotal() {
    var item = $('table.order-list tbody tr:last').index();
    var total_qty = parseFloat($('input[name="total_qty"]').val());
    var subtotal = parseFloat($('input[name="total_price"]').val());
    var order_tax = parseFloat($('select[name="order_tax_rate_select"]').val());
    var order_discount = parseFloat($('input[name="order_discount"]').val());
    if (!order_discount)
        order_discount = 0.00;
    $("#discount").text(order_discount.toFixed(2));

    var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());
    if (!shipping_cost)
        shipping_cost = 0.00;

    item = ++item + '(' + total_qty + ')';
    order_tax = (subtotal - order_discount) * (order_tax / 100);

    var grand_total = (subtotal + order_tax + shipping_cost) - order_discount;
    $('input[name="grand_total"]').val(grand_total.toFixed(2));


    var coupon_discount = parseFloat($('input[name="coupon_discount"]').val());
    if (!coupon_discount)
        coupon_discount = 0.00;
    grand_total -= coupon_discount;

    $('#item').text(item);
    $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);
    $('#subtotal').text(subtotal.toFixed(2));
    $('#tax').text(order_tax.toFixed(2));
    $('input[name="order_tax"]').val(order_tax.toFixed(2));
    $('#shipping-cost').text(shipping_cost.toFixed(2));
    $('#grand-total').text(grand_total.toFixed(2));
    $('input[name="grand_total"]').val(grand_total.toFixed(2));
    $('#paid_amount').val(grand_total.toFixed(2));
    $('input[name="paying_amount"]').val(grand_total.toFixed(2));
}

function couponDiscount() {
    var rownumber = $('table.order-list tbody tr:last').index();
    if (rownumber < 0) {
        alert("Please insert product to order table!")
    } else if ($("#coupon-code").val() != '') {
        valid = 0;
        $.ajax({
            url: '/pos/getCoupon',
            type: "GET",
            dataType: "json",
            success: function(data) {
                $.each(data, function(key, value) {
                    if ($("#coupon-code").val() == value['code'] && !$('input[name="coupon_active"]').val()) {

                        valid = 1;
                        todyDate = new Date().toISOString().slice(0, 10);
                        if (parseFloat(value['quantity']) <= parseFloat(value['used']))
                            alert('This Coupon is no longer available');
                        else if (todyDate > value['expire_date'])
                            alert('This Coupon has expired!');
                        else if (value['type'] == 'fixed') {
                            if (parseFloat($('input[name="grand_total"]').val()) >= value['minimum_amount']) {
                                $('input[name="grand-total"]').val($('input[name="grand_total"]').val() - value['amount']);
                                $('#grand-total').text(parseFloat($('input[name="grand_total"]').val()).toFixed(2));
                                $('input[name="grand_total"]').val($('input[name="grand-total"]').val());
                                alert('Congratulation! You got ' + value['amount'] + ' discount');
                                $('input[name="coupon_active"]').val('1');
                                $('input[name="coupon_id"]').val(value['id']);
                                $('input[name="coupon_discount"]').val(value['amount'])
                                $('input[name="coupon-text"]').text(parseFloat(value['amount']).toFixed(2));

                            } else
                                alert('Grand Total is not sufficient for discount! Required ' + value['minimum_amount'] + ' ');
                        } else {
                            var grand_total = $('input[name="grand_total"]').val();
                            var coupon_discount = grand_total * (value['amount'] / 100);
                            grand_total = grand_total - coupon_discount;
                            $('input[name="grand_total"]').val(grand_total.toFixed(2));
                            $('input[name="grand-total"]').val($('input[name="grand_total"]').val());
                            $('#grand-total').text(parseFloat(grand_total).toFixed(2));
                            alert('Congratulation! You got ' + value['amount'] + '% discount');
                            $('input[name="coupon_active"]').val('1');
                            $('input[name="coupon_id"]').val(value['id']);
                            $('input[name="coupon_discount"]').val(coupon_discount);
                            $('input[name="coupon-text"]').text(parseFloat(value['amount']).toFixed(2));


                        }
                    }
                });
                if (!valid) {
                    alert('Invalid coupon code!');
                    $('input[name="coupon_active"]').val('')
                    var grand_total = parseFloat($('input[name="grand_total"]').val());
                    if ($('input[name="coupon_discount"]').val())
                        grand_total = grand_total + parseFloat($('input[name="coupon_discount"]').val());
                    $('input[name="coupon_id"]').val('');
                    $('input[name="coupon_discount"]').val('');
                    $('input[name="grand_total"]').val(grand_total.toFixed(2));
                    $('input[name="grand-total"]').val($('input[name="grand_total"]').val());
                    $('#grand-total').text(parseFloat(grand_total).toFixed(2));
                }
                calculateGrandTotal();
            }

        });
    } else if ($('input[name="coupon_active"]').val() == '1')
        alert('coupon is already applied')

}

function cheque() {
    $(".cheque").show();
    $('input[name="cheque_no"]').attr('required', true);
    $(".card-element").hide();
    $(".card-errors").hide();
    $(".gift-card").hide();
}

function creditCard() {
    /*  $.getScript("public/vendor/stripe/checkout.js"); */
    $(".card-element").show();
    $(".card-errors").show();
    $(".cheque").hide();
    $(".gift-card").hide();
    $('input[name="cheque_no"]').attr('required', false);
}

function deposits() {
    /* if ($('input[name="paid_amount"]').val() > deposit[$('#customer_id').val()]) {
        alert('Amount exceeds customer deposit! Customer deposit : ' + deposit[$('#customer_id').val()]);
    } */
    $('input[name="cheque_no"]').attr('required', false);
    $('#add-payment select[name="gift_card_id_select"]').attr('required', false);
}

function hide() {
    $(".card-element").hide();
    $(".card-errors").hide();
    $(".cheque").hide();
    $(".gift-card").hide();
    $('input[name="cheque_no"]').attr('required', false);
}

function giftCard() {
    $(".gift-card").show();
    var customer_id = $("#customer_id").val();
    $.ajax({
        url: '/pos/get_gift_card',
        type: "GET",
        data: {
            'customer_id': customer_id,
        },
        dataType: "json",
        success: function(data) {
            $('#add-payment select[name="gift_card_id_select"]').empty();
            $('#add-payment select[name="gift_card_id_select"]').append('<option disabled selected>Choose Giftcard</option>');
            $.each(data, function(index) {
                gift_card_amount[data[index]['id']] = data[index]['amount'];
                gift_card_expense[data[index]['id']] = data[index]['expense'];
                $('#add-payment select[name="gift_card_id_select"]').append('<option value="' + data[index]['id'] + '">' + data[index]['card']+"-$"+data[index]['amount'] + '</option>');
            });
            $('.selectpicker').selectpicker('refresh');
            $('.selectpicker').selectpicker();
        }
    });

    $(".card-element").hide();
    $(".card-errors").hide();
    $(".cheque").hide();
    $('input[name="cheque_no"]').attr('required', false);
}

function confirmCancel() {
    var audio = $("#mysoundclip2")[0];

    if (confirm("Are you sure want to cancel?")) {
        $('input[name="shipping_cost"]').val('');
        $('input[name="order_discount"]').val('');
        $('select[name="order_tax_rate_select"]').val(0);
        $("table.order-list tbody").empty()
        calculateTotal();
        // cancel($('table.order-list tbody tr:last').index());
    }
    //return false;
    calculateTotal();

}

function search_product_data(query = '') {
    $.ajax({
        url: '/pos/filter',
        method: 'GET',
        data: { query: query },
        dataType: 'json',
        success: function(data) {
            if (data != null) {
                var len = data.length;
                $("#searched_product").empty();
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

function change(paying_amount, paid_amount) {
    $("#change").text(parseFloat(paying_amount - paid_amount).toFixed(2));
    $('input[name="change"]').val($("#change").text());

}

function find_in_warehouse(product_id) {
    var biller_id = $("#biller_id").val();
    var warehouse_id = $("#warehouse_id").val();
    var customer_id = $("#customer_id").val();

    if (!warehouse_id)
        alert('Please select Warehouse!');
    else if (!biller_id)
        alert('Please select Biller !');

    else if (!customer_id)
        alert('Please select Customer !');
    else {
        $.ajax({
            url: '/pos/product_check',
            type: "GET",
            data: {
                product_id: product_id,
                warehouse_id: warehouse_id
            },
            success: function(data) {
                if (data['id'] == undefined) {
                    alert('Product is not avaialable in the selected warehouse');
                } else {
                    productSearch(product_id, data['qty']);
                }

            },
            error: function(error) {
                alert('error');
                console.log(error);
            }
        });


    }
}

function confirmDelete() {
    if (confirm("Are you sure want to delete?")) {
        return true;
    }
    return false;
}