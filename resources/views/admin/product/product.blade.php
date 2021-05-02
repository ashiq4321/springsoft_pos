@extends('layout.master')
@push('plugin-styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,500,700">
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js">
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> --}}

    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}"
        rel="stylesheet" />
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <link rel="stylesheet" href="{{ asset('backend/js/custom-default.css') }}" id="custom-style">
@endpush
@section('content')
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4>Add Product</h4>
                        </div>
                        <div class="card-body">
                            <p class="italic"><small>The field labels marked with * are required input fields.</small></p>
                            <form method="POST" enctype="multipart/form-data" id="product-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Type *</strong> </label>
                                            <div class="input-group">
                                                <select name="type" required class="form-control selectpicker" id="type">
                                                    <option value="standard">Standard</option>
                                                    <option value="combo">Combo</option>
                                                    {{-- <option value="digital">Digital</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Name *</strong> </label>
                                            <input type="text" name="name" class="form-control" id="name" required>
                                            {{-- <span class="validation-msg text-danger" id="name-error"></span> --}}
                                            <span class="text-danger" id="nameError"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Code *</strong> </label>
                                            <div class="input-group">
                                                <input name="code" id="code" aria-describedby="code" class="form-control"
                                                    placeholder="Minimum 6 Digit"
                                                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                    type="number" maxlength="6" required />
                                                {{-- <input type="text" name="code" class="form-control" id="code" aria-describedby="code" > --}}
                                                <div class="input-group-append">
                                                    <button id="genbutton" type="button" class="btn btn-sm table-bordered"
                                                        title="Generate"><i class="fa fa-refresh"></i></button>
                                                </div>
                                                <span class="validation-msg" id="code-error"></span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Barcode Symbology *</strong> </label>
                                            <div class="input-group">
                                                <select name="barcode_symbology" required class="form-control selectpicker">
                                                    <option value="C128">Code 128</option>
                                                    <option value="C39">Code 39</option>
                                                    <option value="UPCA">UPC-A</option>
                                                    <option value="UPCE">UPC-E</option>
                                                    <option value="EAN8">EAN-8</option>
                                                    <option value="EAN13">EAN-13</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="digital" class="col-md-4">
                                        <div class="form-group">
                                            <label>Attach File *</strong> </label>
                                            <div class="input-group">
                                                <input type="file" name="fileDigital" class="form-control">
                                            </div>
                                            <span class="validation-msg"></span>
                                        </div>
                                    </div>
                                    <div id="combo" class="col-md-9 mb-1">
                                        <label>Add Product</label>
                                        <div class="search-box input-group mb-3">
                                            <button class="btn btn-secondary"><i class="fa fa-barcode"></i></button>
                                            <input type="text" name="product_code_name" id="lims_productcodeSearch"
                                                placeholder="Please type product code and select..." class="form-control" />
                                        </div>
                                        <label>Combo Products</label>
                                        <div class="table-responsive">
                                            <table id="myTable" class="table table-hover order-list">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Quantity</th>
                                                        <th>Unit Price</th>
                                                        <th><i class="dripicons-trash"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Brand</strong> </label>
                                            <div class="input-group">
                                                <select name="brand_id" class="selectpicker form-control"
                                                    data-live-search="true" data-live-search-style="begins"
                                                    title="Select Brand...">
                                                    <@foreach ($all_brand as $brand) <option value="{{ $brand->id }}">{{ $brand->name }}</option> @endforeach </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Category *</strong> </label>
                                            <div class="input-group">

                                                <select name="category_id" required class="selectpicker form-control"
                                                    data-live-search="true" data-live-search-style="begins"
                                                    title="Select Category...">
                                                    <option value="">--select--</option>
                                                    <@foreach ($all_category as $category) <option value="{{ $category->id }}">{{ $category->category_name }}</option> @endforeach </select>
                                            </div>
                                            <span class="validation-msg"></span>
                                        </div>
                                    </div>
                                    <div id="unit" class="col-md-12">
                                        <div class="row ">
                                            <div class="col-md-4 form-group">
                                                <label>Product Unit *aumlan </strong> </label>
                                                <div class="input-group">
                                                    <select required class="form-control selectpicker" name="unit_id"
                                                        id="unit_id">
                                                        <option value="" disabled selected>Select Product Unit...</option>
                                                        <option value="1">Piece</option>
                                                        <option value="2">Meter</option>
                                                        <option value="3">Kilogram</option>
                                                        <option value="4">Litre</option>
                                                    </select>
                                                </div>
                                                <span class="validation-msg"></span>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Sale Unit</strong> </label>
                                                <div class="input-group">
                                                    <select class="form-control selectpicker" name="sale_unit_id"
                                                        id="sale_unit_id">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Purchase Unit</strong> </label>
                                                    <div class="input-group">
                                                        <select class="form-control selectpicker" name="purchase_unit_id"
                                                            id="purchase_unit_id">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="cost" class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Cost *</strong> </label>
                                            <input type="number" name="cost" required class="form-control" step="any">
                                            <span class="validation-msg"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Price *</strong> </label>
                                            <input type="number" name="price" required class="form-control" step="any">
                                            <input type="hidden" name="total_quantity" required class="form-control"
                                                step="any">
                                            <span class="validation-msg"></span>
                                        </div>
                                        <div class="form-group">
                                            {{-- <input type="hidden" name="qty" value="0.00"> --}}
                                        </div>
                                    </div>
                                    {{-- <div id="qty" class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Quantity *</strong> </label>
                                            <input type="number" name="qty" required class="form-control" step="any">
                                            <span class="validation-msg"></span>
                                        </div>

                                    </div> --}}
                                    <div id="alert-qty" class="col-md-4">
                                        <div class="form-group">
                                            <label>Alert Quantity</strong> </label>
                                            <input type="number" name="alert_quantity" class="form-control" step="any">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Tax</strong> </label>
                                            <select name="tax_id" id="tax_id" class="form-control selectpicker">
                                                <option value="">No Tax</option>
                                                <option value="10">vat@10</option>
                                                <option value="15">vat@15</option>
                                                <option value="20">vat 20</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tax Method</strong> </label> <i class="dripicons-question"
                                                data-toggle="tooltip"
                                                title="Exclusive: Poduct price = Actual product price + Tax. Inclusive: Actual product price = Product price - Tax"></i>
                                            <select name="tax_method" class="form-control selectpicker">
                                                <option value="1">Exclusive</option>
                                                <option value="2">Inclusive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mt-3">
                                            <input type="checkbox" name="featured" value="1">&nbsp;
                                            <label>Featured</label>
                                            <p class="italic">Featured product will be displayed in POS</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Image</strong> </label> <i class="dripicons-question"
                                                data-toggle="tooltip"
                                                title="You can upload multiple image. Only .jpeg, .jpg, .png, .gif file can be uploaded. First image will be base image."></i>
                                            <div id="imageUpload" style="border: 1px solid silver">
                                                <img style="width: 150px; height:150px; display:block; border-radius: 4px;"
                                                    id="doctor_update_img_load" src="" alt="Product Image">
                                                <input name="doctor_old_photo" type="hidden">

                                                <input type="file" id="doc_new_img" name="imageProduct"
                                                    class="form-control">
                                            </div>
                                            <span class="validation-msg" id="image-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Details</label>
                                            <textarea name="product_details" id="product_details" class="form-control"
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="variant-option">
                                        <h5><input name="is_variant" type="checkbox" id="is-variant" value="1">&nbsp; This
                                            product has variant</h5>
                                    </div>
                                    <div class="col-md-12" id="variant-section">
                                        <div class="col-md-6 form-group mt-2">
                                            <input type="text" name="variant" class="form-control"
                                                placeholder="Enter variant seperated by comma">
                                        </div>
                                        <div class="table-responsive ml-2">
                                            <table id="variant-table" class="table table-hover variant-list">
                                                <thead>
                                                    <tr>
                                                        <th><i class="dripicons-view-apps"></i></th>
                                                        <th>Name</th>
                                                        <th>Item Code</th>
                                                        <th>Additional Price</th>
                                                        <th><i class="dripicons-trash"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <input name="promotion" type="checkbox" id="promotion" value="1">&nbsp;
                                        <label>
                                            <h5> Add Promotional Price</h5>
                                        </label>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4" id="promotion_price">
                                                <label>Promotional Price</label>
                                                <input type="number" name="promotion_price" class="form-control"
                                                    step="any" />
                                            </div>
                                            <div class="col-md-4" id="start_date">
                                                <div class="form-group">
                                                    <label>Promotion Starts</label>
                                                    <div class="input-group">
                                                        {{-- <div class="input-group-prepend">
                                                        <div class="input-group-text"><i class="dripicons-calendar"></i></div>
                                                    </div> --}}
                                                        <input type="date" name="starting_date" id="starting_date"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="last_date">
                                                <div class="form-group">
                                                    <label>Promotion Ends</label>
                                                    <div class="input-group">
                                                        {{-- <div class="input-group-prepend">
                                                        <div class="input-group-text"><i class="dripicons-calendar"></i></div>
                                                    </div> --}}
                                                        <input type="date" name="last_date" id="ending_date"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="button" value="Submit" id="submit-btn" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        tinymce.init({
            selector: '#product_details',
            setup: function(editor) {
                editor.on('change', function() {
                    tinymce.triggerSave();
                });
            },
            menubar: false,
            browser_spellcheck: true
        });

    </script>
    <script type="text/javascript">
        $(document).on('change', '#doc_new_img', function(e) {
            e.preventDefault();
            let file_url = URL.createObjectURL(e.target.files[0]);
            $('img#doctor_update_img_load').attr('src', file_url);
        });

        $(".btn-success").click(function() {

            var lsthmtl = $(".clone").html();

            $(".increment").after(lsthmtl);

        });

        $("body").on("click", ".btn-danger", function() {

            $(this).parents(".hdtuto").remove();

        });

        $(document).on('click', '#genbutton', function(e) {
            e.preventDefault();
            //alert("eeee");
            var code = Math.floor(100000 + Math.random() * 900000);
            //alert(code);
            $("input[name='code']").val(code);


        });

        $('select[name="type"]').on('change', function() {

            if ($(this).val() == 'combo') {

                $("input[name='cost']").prop('required', false);
                $("input[name='quantity']").prop('required', false);
                $("select[name='unit_id']").prop('required', false);
                hide();
                $("#combo").show(300);
                $("input[name='price']").prop('readonly', true);
                $("#is-variant").prop("checked", false);
                $("#variant-section, #variant-option").hide(300);
            } else if ($(this).val() == 'digital') {
                $("input[name='cost']").prop('required', false);
                $("select[name='unit_id']").prop('required', false);
                $("input[name='file']").prop('required', true);
                hide();
                $("#digital").show(300);
                $("#combo").hide(300);
                $("input[name='price']").prop('disabled', false);
                $("#is-variant").prop("checked", false);
                $("#variant-section, #variant-option").hide(300);
            } else if ($(this).val() == 'standard') {
                $("input[name='cost']").prop('required', true);
                $("select[name='unit_id']").prop('required', true);
                $("input[name='file']").prop('required', false);
                $("#cost").show(300);
                $("#unit").show(300);
                $("#alert-qty").show(300);
                $("#variant-option").show(300);
                $("#digital").hide(300);
                $("#combo").hide(300);
                $("input[name='price']").prop('disabled', false);
            }
        });


        // $("input[name='is_variant']").on("change", function () {
        //     if ($(this).is(':checked')) {
        //         $("#variant-section").show(300);
        //     } else
        //         $("#variant-section").hide(300);
        // });


        $("input[name='variant']").on("input", function() {
            if ($("#code").val() == '') {
                $("input[name='variant']").val('');
                alert('Please add insert a Code for the Product.');
            } else if ($(this).val().indexOf(',') > -1) {
                var variant_name = $(this).val().slice(0, -1);
                var item_code = variant_name + '-' + $("#code").val();
                var newRow = $("<tr>");
                var cols = '';
                cols += '<td style="cursor:grab"><i class="dripicons-view-apps"></i></td>';
                cols += '<td><input type="text" class="form-control" name="variant_name[]" value="' + variant_name +
                    '" /></td>';
                cols += '<td><input readonly type="text" class="form-control" name="item_code[]" value="' +
                    item_code + '" /></td>';
                cols +=
                    '<td><input type="number" class="form-control" name="additional_price[]" value="" step="any" /></td>';
                cols += '<td><button type="button" class="vbtnDel btn btn-sm btn-danger">X</button></td>';

                $("input[name='variant']").val('');
                newRow.append(cols);
                $("table.variant-list tbody").append(newRow);
            }
        });

        //Delete variant
        $("table#variant-table tbody").on("click", ".vbtnDel", function(event) {
            $(this).closest("tr").remove();
        });

        $("#promotion").on("change", function() {
            if ($(this).is(':checked')) {
                $("#starting_date").val();
                $("#promotion_price").show(300);
                $("#start_date").show(300);
                $("#last_date").show(300);
            } else {
                $("#promotion_price").hide(300);
                $("#start_date").hide(300);
                $("#last_date").hide(300);
            }
        });

        $('#type').on('change', function() {

            console.log('i am changeing')
        });

        $("ul#product").siblings('a').attr('aria-expanded', 'true');
        $("ul#product").addClass("show");
        $("ul#product #product-create-menu").addClass("active");

        $("#digital").hide();
        $("#combo").hide();
        $("#variant-section").hide();
        $("#promotion_price").hide();
        $("#start_date").hide();
        $("#last_date").hide();

        $('[data-toggle="tooltip"]').tooltip();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#unit_id').on('change', function() {

            if ($('#unit_id').val() == 1) {
                $('#sale_unit_id').empty();
                $('select[name="sale_unit_id"]').append('<option value="1">Piece</option>');
                $('select[name="sale_unit_id"]').append('<option value="2">Dozen Box</option>');
                $('select[name="sale_unit_id"]').append('<option value="3">Cartoon Box</option>');
                $('#purchase_unit_id').empty();
                $('select[name="purchase_unit_id"]').append('<option value="1">Piece</option>');
                $('select[name="purchase_unit_id"]').append('<option value="2">Dozen Box</option>');
                $('select[name="purchase_unit_id"]').append('<option value="3">Cartoon Box</option>');
            }
            if ($('#unit_id').val() == 2) {

                $('#sale_unit_id').empty();
                $('select[name="sale_unit_id"]').append('<option value="1">Meter</option>');
                $('#purchase_unit_id').empty();
                $('select[name="purchase_unit_id"]').append('<option value="1">Meter</option>');
            }
            if ($('#unit_id').val() == 3) {

                $('#sale_unit_id').empty();
                $('select[name="sale_unit_id"]').append('<option value="1">Kilogram</option>');
                $('select[name="sale_unit_id"]').append('<option value="2">Gram</option>');
                $('#purchase_unit_id').empty();
                $('select[name="purchase_unit_id"]').append('<option value="1">Kilogram</option>');
                $('select[name="purchase_unit_id"]').append('<option value="2">Gram</option>');
            }

        });

        // var lims_product_code = ["63920719 [ Mouse ]","4554654 [ product-1 ]", "72782608 [ mango ]", "85415108 [ Earphone ]", "38314290 [ lychee ]", "31261512 [ Baby doll ]", "212132 [ potato ]", "97103461 [ iphone-X ]", "16905612 [ doll ]", "4343543 [ product-2 ]"];
        var lims_product_code;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: '/getAllProduct',
            dataType: "json",
            success: function(data) {
                lims_product_code = data;
                console.log(data);
                // var city = ('#city');
                // $(city).empty();
                // for (var i = 0; i < data.length; i++) {
                //     $(city).append('<option id=' + data[i].sysid + ' value=' + data[i].city_name + '>' + data[i].city_name + '</option>');

                // }
            }

        });

        var lims_productcodeSearch = $('#lims_productcodeSearch');
        //alert(lims_productcodeSearch.val());



        lims_productcodeSearch.autocomplete({

            source: function(request, response) {
                var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
                response($.grep(lims_product_code, function(item) {
                    return matcher.test(item);
                }));
            },
            select: function(event, ui) {
                var data = ui.item.value;
                var product_code = data.split(" ");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: "/searchProduct/" + product_code[0],
                    data: {
                        data: data
                    },
                    success: function(data) {
                        console.log(data);
                        var flag = 1;
                        $(".product-id").each(function() {
                            if ($(this).val() == data['id']) {
                                swal("Warning!", "Dupplicate Product Not Allowed!",
                                    "warning");
                                //alert('Duplicate input is not allowed!')
                                flag = 0;
                            }
                        });
                        $("input[name='product_code_name']").val('');
                        if (flag) {
                            var newRow = $("<tr>");
                            var cols = '';
                            cols += '<td>' + data['name'] + ' [' + data['barcode_symbology'] +
                                ']</td>';
                            cols +=
                                '<td><input type="number" class="form-control qty" name="product_qty[]" value="1" step="any"/></td>';
                            cols +=
                                '<td><input type="number" class="form-control unit_price" name="unit_price[]" value="' +
                                data['price'] + '" step="any" readonly/></td>';
                            cols +=
                                '<td><button type="button" class="ibtnDel btn btn-sm btn-danger">X</button></td>';
                            cols +=
                                '<input type="hidden" class="product-id" name="product_id[]" value="' +
                                data['id'] + '"/>';

                            newRow.append(cols);
                            $("table.order-list tbody").append(newRow);
                            calculate_price();
                        }
                    }
                });
            }
        });

        // function search(){
        //     $( "#lims_productcodeSearch" ).autocomplete({
        //            source: function( request, response ) {
        //              $.ajax({
        //                url:"/search",
        //                type: 'post',
        //                dataType: "json",
        //                headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //                data: {
        //                   search: request.term
        //                },
        //                success: function( data ) {
        //                    response( data );
        //                }
        //              });
        //            },
        //            select: function (event, ui) {
        //               $('#productcodeSearch').val(ui.item.label); // display the selected text
        //               $('#result').val(ui.item.value);
        //               return false;
        //            }
        //          });

        //        }

        //Change quantity or unit price
        $("#myTable").on('input', '.qty , .unit_price', function() {
            calculate_price();
        });

        //Delete product
        $("table.order-list tbody").on("click", ".ibtnDel", function(event) {
            $(this).closest("tr").remove();
            calculate_price();
        });


        function hide() {
            $("#cost").hide(300);
            $("#unit").hide(300);
            $("#alert-qty").hide(300);
            //$("#qty").hide(300);

        }




        function calculate_price() {
            var price = 0;
            var total_quantity = 0;
            //var tax_id = $('#tax_id').val();
            //alert(tax_id);

            $(".qty").each(function() {
                rowindex = $(this).closest('tr').index();
                quantity = $(this).val();
                unit_price = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .unit_price').val();
                //unit_quantity = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val();

                price += quantity * unit_price;
                total_quantity += quantity * 1;
                // if (tax_id) {
                //     var tax = price * (tax_id / 100);
                //     price = price - tax;
                // }

            });
            $('input[name="price"]').val(price);
            $('input[name="total_quantity"]').val(total_quantity);
        }

        function populate_category(unitID) {
            $.ajax({
                url: 'saleunit/' + unitID,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="sale_unit_id"]').empty();
                    $('select[name="purchase_unit_id"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="sale_unit_id"]').append('<option value="' + key + '">' + value +
                            '</option>');
                        $('select[name="purchase_unit_id"]').append('<option value="' + key + '">' +
                            value + '</option>');
                    });
                    $('.selectpicker').selectpicker('refresh');
                },
            });
        }


        // var starting_date = $('#starting_date');
        // starting_date.datepicker({
        //     format: "dd-mm-yyyy",
        //     startDate: "11-04-2021",
        //     autoclose: true,
        //     todayHighlight: true
        // });

        // var ending_date = $('#ending_date');
        // ending_date.datepicker({
        //     format: "dd-mm-yyyy",
        //     startDate: "11-04-2021",
        //     autoclose: true,
        //     todayHighlight: true
        // });

        $(window).keydown(function(e) {
            if (e.which == 13) {
                var $targ = $(e.target);

                if (!$targ.is("textarea") && !$targ.is(":button,:submit")) {
                    var focusNext = false;
                    $(this).find(":input:visible:not([disabled],[readonly]), a").each(function() {
                        if (this === e.target) {
                            focusNext = true;
                        } else if (focusNext) {
                            $(this).focus();
                            return false;
                        }
                    });

                    return false;
                }
            }
        });
        //dropzone portion
        Dropzone.autoDiscover = false;

        // jQuery.validator.setDefaults({
        //     errorPlacement: function(error, element) {
        //         if (error.html() == 'Select Category...')
        //             error.html('This field is required aumlan.');
        //         $(element).closest('div.form-group').find('.validation-msg').html(error.html());
        //     },
        //     highlight: function(element) {
        //         $(element).closest('div.form-group').removeClass('has-success').addClass('has-error');
        //     },
        //     unhighlight: function(element, errorClass, validClass) {
        //         $(element).closest('div.form-group').removeClass('has-error').addClass('has-success');
        //         $(element).closest('div.form-group').find('.validation-msg').html('');
        //     }
        // });

        // function error_validation() {

        //     if ($('#name').val('')) {
        //         $('#nameError').val("Product name required");
        //     }else{

        //     }

        // }

        function validate() {
            var product_code = $("input[name='code']").val();
            var barcode_symbology = $('select[name="barcode_symbology"]').val();
            var exp = /^\d+$/;

            if (!(product_code.match(exp)) && (barcode_symbology == 'UPCA' || barcode_symbology == 'UPCE' ||
                    barcode_symbology == 'EAN8' || barcode_symbology == 'EAN13')) {
                alert('Product code must be numeric.');
                return false;
            } else if (product_code.match(exp)) {
                if (barcode_symbology == 'UPCA' && product_code.length > 11) {
                    alert('Product code length must be less than 12');
                    return false;
                } else if (barcode_symbology == 'EAN8' && product_code.length > 7) {
                    alert('Product code length must be less than 8');
                    return false;
                } else if (barcode_symbology == 'EAN13' && product_code.length > 12) {
                    alert('Product code length must be less than 13');
                    return false;
                }
            }

            if ($("#type").val() == 'combo') {
                var rownumber = $('table.order-list tbody tr:last').index();
                if (rownumber < 0) {
                    alert("Please insert product to table!")
                    return false;
                }
            }
            // if ($("#is-variant").is(":checked")) {
            //     rowindex = $("table#variant-table tbody tr:last").index();
            //     if (rowindex < 0) {
            //         alert('This product has variant. Please insert variant to table');
            //         return false;
            //     }
            // }
            $("input[name='price']").prop('disabled', false);
            return true;
        }

        $("table#variant-table tbody").sortable({
            items: 'tr',
            cursor: 'grab',
            opacity: 0.5,
        });

        $('#submit-btn').on("click", function(e) {
            e.preventDefault();
            var formData = new FormData(document.getElementById("product-form"));

            if ($("#product-form").valid() && validate()) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/addProduct',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        swal("Inserted!", "Data has been Successfully Inserted!", "success");

                        //console.log(data);
                        //alert("success");
                        location.href = '../productList';
                    },
                    error: function(response) {
                        console.log(response);
                        if (response.responseJSON.errors.name) {
                            $("#name-error").text(response.responseJSON.errors.name);
                        } else if (response.responseJSON.errors.code) {
                            $("#code-error").text(response.responseJSON.errors.code);
                        }
                    },
                });

            }
        });



        // $(".dropzone").sortable({
        //     items: '.dz-preview',
        //     cursor: 'grab',
        //     opacity: 0.5,
        //     containment: '.dropzone',
        //     distance: 20,
        //     tolerance: 'pointer',
        //     stop: function () {
        //         var queue = myDropzone.getAcceptedFiles();
        //         newQueue = [];
        //         $('#imageUpload .dz-preview .dz-filename [data-dz-name]').each(function (count, el) {
        //             var name = el.innerHTML;
        //             queue.forEach(function (file) {
        //                 if (file.name === name) {
        //                     newQueue.push(file);
        //                 }
        //             });
        //         });
        //         myDropzone.files = newQueue;
        //     }
        // });

        // myDropzone = new Dropzone('div#imageUpload', {
        //     addRemoveLinks: true,
        //     autoProcessQueue: false,
        //     uploadMultiple: true,
        //     parallelUploads: 100,
        //     maxFilesize: 12,
        //     paramName: 'image',
        //     clickable: true,
        //     method: 'POST',
        //     url: '/addProductImage',
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     // renameFile: function (file) {
        //     //     var dt = new Date();
        //     //     var time = dt.getTime();
        //     //     return time + file.name;
        //     // },
        //     acceptedFiles: ".jpeg,.jpg,.png,.gif",
        //     timeout:500000,
        //     // init: function () {
        //     //     var myDropzone = this;
        //     //     $('#submit-btn').on("click", function (e) {
        //     //         e.preventDefault();
        //     //         if ($("#product-form").valid() && validate()) {
        //     //             tinyMCE.triggerSave();
        //     //             if (myDropzone.getAcceptedFiles().length) {
        //     //                 myDropzone.processQueue();
        //     //             } else {
        //     //                 $.ajaxSetup({
        //     //             headers: {
        //     //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     //             }
        //     //         });
        //     //                 $.ajax({
        //     //                     type: 'POST',
        //     //                     url: '/addProduct',
        //     //                     data: $("#product-form").serialize(),
        //     //                     success: function (response) {
        //     //                         console.log(response);

        //     //                         //console.log(data);
        //     //                         alert("success");
        //     //                         location.href = '../productList';
        //     //                     },
        //     //                     error: function (response) {
        //     //                         console.log(response);
        //     //                         if (response.responseJSON.errors.name) {
        //     //                             $("#name-error").text(response.responseJSON.errors.name);
        //     //                         } else if (response.responseJSON.errors.code) {
        //     //                             $("#code-error").text(response.responseJSON.errors.code);
        //     //                         }
        //     //                     },
        //     //                 });
        //     //             }
        //     //         }
        //     //     });

        //     //     this.on('sending', function (file, xhr, formData) {
        //     //         // Append all form inputs to the formData Dropzone will POST
        //     //         var data = $("#product-form").serializeArray();
        //     //         $.each(data, function (key, el) {
        //     //             formData.append(el.name, el.value);
        //     //         });
        //     //     });
        //     // },
        //     error: function (file, response) {
        //         console.log(response);
        //         if (response.errors.name) {
        //             $("#name-error").text(response.errors.name);
        //             this.removeAllFiles(true);
        //         } else if (response.errors.code) {
        //             $("#code-error").text(response.errors.code);
        //             this.removeAllFiles(true);
        //         } else {
        //             try {
        //                 var res = JSON.parse(response);
        //                 if (typeof res.message !== 'undefined' && !$modal.hasClass('in')) {
        //                     $("#success-icon").attr("class", "fas fa-thumbs-down");
        //                     $("#success-text").html(res.message);
        //                     $modal.modal("show");
        //                 } else {
        //                     if ($.type(response) === "string")
        //                         var message = response; //dropzone sends it's own error messages in string
        //                     else
        //                         var message = response.message;
        //                     file.previewElement.classList.add("dz-error");
        //                     _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        //                     _results = [];
        //                     for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        //                         node = _ref[_i];
        //                         _results.push(node.textContent = message);
        //                     }
        //                     return _results;
        //                 }
        //             } catch (error) {
        //                 console.log(error);
        //             }
        //         }
        //     },
        //     successmultiple: function (file, response) {
        //         location.href = '../products';
        //         console.log(file, response);
        //     },
        //     completemultiple: function (file, response) {
        //         console.log(file, response, "completemultiple");
        //     },
        //     reset: function () {
        //         console.log("resetFiles");
        //         this.removeAllFiles(true);
        //     }
        // });   

    </script>
    <script type="text/javascript">
        if ($(window).outerWidth() > 1199) {
            $('nav.side-navbar').removeClass('shrink');
        }

        function myFunction() {
            setTimeout(showPage, 150);
        }

        function showPage() {
            document.getElementById("loader").style.display = "none";
            document.getElementById("content").style.display = "block";
        }

        $("div.alert").delay(3000).slideUp(750);

        function confirmDelete() {
            if (confirm("Are you sure want to delete?")) {
                return true;
            }
            return false;
        }

        $("a#add-expense").click(function(e) {
            e.preventDefault();
            $('#expense-modal').modal();
        });

        $("a#add-account").click(function(e) {
            e.preventDefault();
            $('#account-modal').modal();
        });

        $("a#account-statement").click(function(e) {
            e.preventDefault();
            $('#account-statement-modal').modal();
        });

        $("a#profitLoss-link").click(function(e) {
            e.preventDefault();
            $("#profitLoss-report-form").submit();
        });

        $("a#report-link").click(function(e) {
            e.preventDefault();
            $("#product-report-form").submit();
        });

        $("a#purchase-report-link").click(function(e) {
            e.preventDefault();
            $("#purchase-report-form").submit();
        });

        $("a#sale-report-link").click(function(e) {
            e.preventDefault();
            $("#sale-report-form").submit();
        });

        $("a#payment-report-link").click(function(e) {
            e.preventDefault();
            $("#payment-report-form").submit();
        });

        $("a#warehouse-report-link").click(function(e) {
            e.preventDefault();
            $('#warehouse-modal').modal();
        });

        $("a#user-report-link").click(function(e) {
            e.preventDefault();
            $('#user-modal').modal();
        });

        $("a#customer-report-link").click(function(e) {
            e.preventDefault();
            $('#customer-modal').modal();
        });

        $("a#supplier-report-link").click(function(e) {
            e.preventDefault();
            $('#supplier-modal').modal();
        });

        $("a#due-report-link").click(function(e) {
            e.preventDefault();
            $("#due-report-form").submit();
        });

        // $(".daterangepicker-field").daterangepicker({
        //     callback: function(startDate, endDate, period){
        //       var start_date = startDate.format('YYYY-MM-DD');
        //       var end_date = endDate.format('YYYY-MM-DD');
        //       var title = start_date + ' To ' + end_date;
        //       $(this).val(title);
        //       $('#account-statement-modal input[name="start_date"]').val(start_date);
        //       $('#account-statement-modal input[name="end_date"]').val(end_date);
        //     }
        // });

        // $('.selectpicker').selectpicker({
        //     style: 'btn-link',
        // });

    </script>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

@endpush
@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
