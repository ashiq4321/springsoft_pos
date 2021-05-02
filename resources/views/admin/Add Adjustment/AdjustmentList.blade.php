
@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')


<div class="row">

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title" style="font-size: 1.5rem !important">Product Adjustment</h1>

                <div class="card-header" style="width:100%; padding: 15px 0px !important" >
                    <a class="btn btn-sm btn-info"  href="{{ url('/add_Adjustment') }}">Product Adjustment</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="productCategory" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Reference No.</th>
                                <th>Ware House Name</th> 
                                <th>Product Name</th> 
                                <th>Quentity</th>
                               
                               
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($adjusment as $key=>$adjusment)
                            <tr>
                                <th><span class="badge badge-danger">{{++$key}}</span></th>
                                 <th>
                                 <span class="badge badge-info">{{$adjusment->reference_id}}</span></th>
                                <th>{{$adjusment->name}}</th>
                                <th>{{$adjusment->p_name}}</th>
                                <th><span class="badge badge-danger badge-secondary">{{$adjusment->p_qty}}</span></th> 
                               
                            </tr>
                               @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



























@endsection

@push('plugin-scripts')

<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
<!--<script src="{{ asset('backend/js/brand.js') }}"></script>-->
<script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush