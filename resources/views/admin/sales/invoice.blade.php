  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

  <!-- plugin css -->
  <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.css"
      integrity="sha512-3icgkoIO5qm2D4bGSUkPqeQ96LS8+ukJC7Eqhl1H5B2OJMEnFqLmNDxXVmtV/eq5M65tTDkUYS/Q0P4gvZv+yA=="
      crossorigin="anonymous" />
  <link href="{{ asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
  <!-- Data Table  -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
  <!-- end plugin css -->


  <!-- jquery  -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
      integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
      crossorigin="anonymous"></script>


  <!-- common css -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
  <div class="ml-5 mt-3 mb-3 mr-5">
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                      <div class="container-fluid d-flex justify-content-between">
                          <div class="col-lg-3 pl-0">
                              <a href="#" class="noble-ui-logo d-block mt-3">SpringSoft<span>IT</span></a>
                              <p class="mt-1 mb-1"><b>SpringSoftIT</b></p>
                              <p>108,<br> uttara,<br>dhaka.</p>
                              <h5 class="mt-5 mb-2 text-muted">Invoice to :</h5>
                              <p>{{ $i[0] }},<br>{{ $i[1] }} <br>Phone: {{ $i[11] }} </p>
                          </div>
                          <div class="col-lg-3 pr-0">
                              <h4 class="font-weight-medium text-uppercase text-right mt-4 mb-2">invoice</h4>
                              <h6 class="text-right mb-5 pb-4">#{{ $i[3] }}</h6>
                              <h4 class="font-weight-medium text-uppercase text-right mt-2 mb-2">Sale RN</h4>
                              <h6 class="text-right mb-5 pb-4">#{{ $i[15] }}</h6>
                              <h6 class="mb-0 mt-3 text-right font-weight-normal mb-2"><span class="text-muted">Invoice
                                      Date : {{ $i[2] }}</span> </h6>
                          </div>
                      </div>
                      <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                          <div class="table-responsive w-100">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th class="text-center">Name</th>
                                          <th class="text-center">Qty*Unitprice</th>
                                          <th class="text-center">Tax</th>
                                          <th class="text-center">Discount</th>
                                          <th class="text-center">Total</th>

                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($purchased as $index => $p)
                                          <tr class="text-center">
                                              <td>{{ $p['code'] }} ({{ $p['name'] }})</td>
                                              <td>{{ $p['qty'] }} x {{ $p['unit_cost'] }}</td>
                                              <td>{{ $p['tax'] }}</td>
                                              <td>{{ $p['discount'] }}</td>
                                              <td>$ {{ $p['total'] }}</td>
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
                                                  <td class="text-right">$ {{ $i[4] }}</td>
                                              </tr>
                                              <tr>
                                                  <td>Order TAX ({{ $i[14] }}) </td>
                                                  <td class="text-right">$ {{ $i[5] }}</td>
                                              </tr>
                                              <tr>
                                                  <td class="text-bold-800">Order Discount</td>
                                                  <td class="text-bold-800 text-right"> $ {{ $i[6] }} </td>
                                              </tr>
                                              <tr>
                                                  <td>Shipping Cost</td>
                                                  <td class="text-right">$ {{ $i[7] }} </td>
                                              </tr>
                                              <tr class="bg-light">
                                                  <td class="text-bold-800">Grand Total</td>
                                                  <td class="text-bold-800 text-right">$ {{ $i[8] }}</td>
                                              </tr>
                                              <tr class="bg-light">
                                                  <td class="text-bold-800">Due</td>
                                                  <td class="text-bold-800 text-danger text-right">$
                                                      {{ $i[9] }}</td>
                                              </tr>
                                          </tbody>
                                      </table>
                                      <table>
                                          <tr>
                                              <td class="pl-3 pr-3 font-weight-bolder" style="width:auto">Paid By:
                                                  {{ $i[12] }}</td>
                                              <td class="pl-5 pr-3 font-weight-bolder" style="width:auto">paid Amount: $
                                                  {{ $i[13] }}</td>
                                              <td class="pl-5 font-weight-bolder" style="width:auto">Change: $
                                                  {{ $i[10] }}</td>
                                          </tr>

                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="container-fluid mt-1 w-100">
                          <a href="/delivery" class="btn btn-primary float-right mt-4 ml-2"><i data-feather="send"
                                  class="mr-3 icon-md"></i>Back</a>
                          <a href="#" onclick="window.print();" class="btn btn-outline-primary float-right mt-4"><i
                                  data-feather="printer" class="mr-2 icon-md"></i>Print</a>
                      </div>

                  </div>
                  <p class="text-center font-weight-lighter font-italic ">Thank you for shopping with us. Please come
                      again</p>

              </div>

          </div>
      </div>
  </div>

  <script type="text/javascript">
      function auto_print() {
          window.print()

      }
      setTimeout(auto_print, 1000);
      if (window.history.replaceState) {
          window.history.replaceState(null, null, '/delivery');
      }

  </script>
