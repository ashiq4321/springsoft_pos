@extends('layout.master')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item"><a href="#">Special pages</a></li>
    <li class="breadcrumb-item active" aria-current="page">Invoice</li> --}}
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid d-flex justify-content-between">
                        <div class="col-lg-3 pl-0">
                            <a href="#" class="noble-ui-logo d-block mt-3">Noble<span>UI</span></a>
                            <p class="mt-1 mb-1"><b>springsoftit</b></p>
                            <p>108,<br> uttara,<br>dhaka.</p>
                            <h5 class="mt-5 mb-2 text-muted">Invoice to :</h5>
                            <p>{{ $invoice['customer_name'] }},<br> {{ $invoice['customer_address'] }}</p>
                        </div>
                        <div class="col-lg-3 pr-0">
                            <h4 class="font-weight-medium text-uppercase text-right mt-4 mb-2">invoice</h4>
                            <h6 class="text-right mb-5 pb-4"># {{ $invoice['invoice_id'] }}</h6>
                            {{-- <p class="text-right mb-1">Balance Due</p>
            <h4 class="text-right font-weight-normal">$ 72,420.00</h4> --}}
                            <h6 class="mb-0 mt-3 text-right font-weight-normal mb-2"><span class="text-muted">Invoice Date
                                    :</span> {{ $invoice['date'] }}</h6>
                            {{-- <h6 class="text-right font-weight-normal"><span class="text-muted">Due Date :</span> 12th Jul 2020</h6> --}}
                        </div>
                    </div>
                    <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                        <div class="table-responsive w-100">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Description</th>
                                        <th class="text-right">Quantity</th>
                                        <th class="text-right">Unit cost</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoice['purchased'] as $purchase)
                                        <tr class="text-right">
                                            <td class="text-left">{{ $loop->index + 1 }}</td>
                                            <td class="text-left">{{ $purchase['name'] }}</td>
                                            <td>{{ $purchase['qty'] }}</td>
                                            <td>{{ $purchase['unit_cost'] }}</td>
                                            <td>{{ $purchase['total'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="container-fluid mt-5 w-100">
                        <div class="row">
                            <div class="col-md-6 ml-auto">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Sub Total</td>
                                                <td class="text-right">$ {{ $invoice['sub_total'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>TAX ({{ $invoice['order_tax_rate'] }}%)</td>
                                                <td class="text-right">$ {{ $invoice['order_tax'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Order Discount</td>
                                                <td class="text-right">$ {{ $invoice['discount'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Coupon Discount</td>
                                                <td class="text-right">$ {{ $invoice['coupon_discount'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Shipping Cost Discount</td>
                                                <td class="text-right">$ {{ $invoice['shipping_cost'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-800">Total</td>
                                                <td class="text-bold-800 text-right"> $ {{ $invoice['grand_total'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Payment Made</td>
                                                <td class="text-danger text-right">(-) $ {{ $invoice['paid_amount'] }}
                                                </td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td class="text-bold-800">Balance Due</td>
                                                <td class="text-bold-800 text-right">$ {{ $invoice['balance_due'] }}</td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td class="text-bold-800">Change</td>
                                                <td class="text-bold-800 text-right">$ {{ $invoice['change'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid w-100">
                        <a href="#" class="btn btn-primary float-right mt-4 ml-2"><i data-feather="send"
                                class="mr-3 icon-md"></i>Send Invoice</a>
                        <button onclick="window.print();" href="#" class="btn btn-outline-primary float-right mt-4"><i
                                data-feather="printer" class="mr-2 icon-md"></i>Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript">
    function auto_print() {
        window.print()
    }
    setTimeout(auto_print, 1000);
    if (window.history.replaceState) {
        window.history.replaceState(null, null, '/pos');
    }

</script>
