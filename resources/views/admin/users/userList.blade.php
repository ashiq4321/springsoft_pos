
@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />


@endpush
<style>
  body {
    padding-top: 90px;
}
.panel-login {
	/* border-color: #ccc; */
	/* -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2); */
}
.panel-login>.panel-heading {
	color: #00415d;
	background-color: #fff;
	border-color: #fff;
	text-align:center;
}
.panel-login>.panel-heading a{
	text-decoration: none;
	color: #666;
	font-weight: bold;
	font-size: 15px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login>.panel-heading a.active{
	color: #029f5b;
	font-size: 18px;
}
.panel-login>.panel-heading hr{
	margin-top: 10px;
	margin-bottom: 0px;
	clear: both;
	border: 0;
	height: 1px;
	background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
	background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
}
.panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
	height: 45px;
	border: 1px solid #ddd;
	font-size: 16px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login input:hover,
.panel-login input:focus {
	outline:none;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	border-color: #ccc;
}
.btn-login {
	background-color: #59B2E0;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #59B2E6;
}
.btn-login:hover,
.btn-login:focus {
	color: #fff;
	background-color: #53A3CD;
	border-color: #53A3CD;
}
.forgot-password {
	text-decoration: underline;
	color: #888;
}
.forgot-password:hover,
.forgot-password:focus {
	text-decoration: underline;
	color: #666;
}

.btn-register {
	background-color: #1CB94E;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #1CB94A;
}
.btn-register:hover,
.btn-register:focus {
	color: #fff;
	background-color: #1CA347;
	border-color: #1CA347;
}

</style>
@section('content')


<div class="row">

  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h1 class="card-title" style="font-size: 1.5rem !important">User List</h1>
        
        <br>
        @if(session('delete_success'))
                    <div class="alert alert-success">
                      {{session('delete_success')}}
                    </div>
                    @endif
                    @if(session('edit_successs'))
                    <div class="alert alert-success">
                      {{session('edit_successs')}}
                    </div>
                    @endif
                    @if(session('add_successs'))
                    <div class="alert alert-success">
                      {{session('add_successs')}}
                    </div>
                    @endif
        @if(Route::current()->getName() == 'admin.addExpense')
        <div class="card-header" style="width:100%; padding: 15px 0px !important" >
          <a class="btn btn-sm btn-info" data-toggle="modal" href="#add_expense_modal">Add New Expense</a>
      </div>
      @endif

          <div class="panel panel-login">
            <div class="panel-heading">
              <div class="row">
                <div class="col-md-4">
                  <a href="#" class="active" id="admin-form-link">Admin</a>
                </div>
                <div class="col-md-4">
                  <a href="#" id="owner-form-link">Owner</a>
                </div>
                <div class="col-md-4">
                  <a href="#" id="employee-form-link">Employee</a>
                </div>
              </div>
              <hr>
              <br>
              
            </div>
            <div class="panel-body">
              <div class="row">
                  <div class="col-lg-12">
                    <div class="adminnn"  id="admin-form"> 
                          
                              <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                  <tr>
                                    <th>SL NO</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                  @forelse($all_admin as $index => $admin)
                                  <tr>
                                    <td>{{$all_admin->firstitem() + $index}}</td>
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>
                                          @php
                                          echo $admin->status == 1 ? '<span class="badge bg-primary text-white">Active</span>':'<span class="badge bg-danger text-white">Inactive</span>'
                                          @endphp
                                    </td>
                                    <td>
                                      <div class="btn-group" role="group" aria-label="Basic example">
                                          <a href="{{url('user_edit')}}/{{$admin->id}}" class="btn bg-blue"><i data-feather="edit"></i></a>
                                          <a href="{{url('user_delete')}}/{{$admin->id}}" class="btn bg-marron"><i data-feather="delete"></i></a>
                                      </div>
                                    </td>
                                  </tr>
                                  @endforeach
                                </table>
                              </div>
                              <div class="mt-2">
                                {{$all_admin->links()}}
                              </div>

                    </div>

                    <div class="ownerrr"  id="owner-form"> 
                          
                      <div class="table-responsive">
                        <table class="table table-bordered text-center">
                          <tr>
                            <th>SL NO</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                          @forelse($all_owner as $index => $owner)
                          <tr>
                            <td>{{$all_owner->firstitem() + $index}}</td>
                            <td>{{$owner->name}}</td>
                            <td>{{$owner->email}}</td>
                            <td>
                                  @php
                                  echo $owner->status == 1 ? '<span class="badge bg-primary text-white">Active</span>':'<span class="badge bg-danger text-white">Inactive</span>'
                                  @endphp
                            </td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                  <a href="{{url('user_edit')}}/{{$owner->id}}" class="btn bg-blue"><i data-feather="edit"></i></a>
                                  <a href="{{url('user_delete')}}/{{$owner->id}}" class="btn bg-marron"><i data-feather="delete"></i></a>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </table>
                      </div>
                      <div class="mt-2">
                        {{$all_owner->links()}}
                      </div>

                    </div>

                    <div class="employeee"  id="employee-form"> 
                          
                      <div class="table-responsive">
                        <table class="table table-bordered text-center">
                          <tr>
                            <th>SL NO</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                          @forelse($all_employee as $index => $employee)
                          <tr>
                            <td>{{$all_employee->firstitem() + $index}}</td>
                            <td>{{$employee->name}}</td>
                            <td>{{$employee->email}}</td>
                            <td>
                                  @php
                                  echo $employee->status == 1 ? '<span class="badge bg-primary text-white">Active</span>':'<span class="badge bg-danger text-white">Inactive</span>'
                                  @endphp
                            </td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                  <a href="{{url('user_edit')}}/{{$employee->id}}" class="btn bg-blue"><i data-feather="edit"></i></a>
                                  <a href="{{url('user_delete')}}/{{$employee->id}}" class="btn bg-marron"><i data-feather="delete"></i></a>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </table>
                      </div>
                      <div class="mt-2">
                        {{$all_employee->links()}}
                      </div>

                    </div>


                  
                 
                </div>
              </div>
            </div>
          </div>
      


      </div>
    </div>
  </div>
</div>




<script>


$(function() {
  $("#admin-form").show();
  $("#owner-form").hide();
  $("#employee-form").hide();


$('#admin-form-link').click(function(e) {
$("#admin-form").delay(100).fadeIn(100);
 $("#owner-form").fadeOut(100);
 $("#employee-form").fadeOut(100);
$('#owner-form-link').removeClass('active');
$('#employee-form-link').removeClass('active');
$(this).addClass('active');
e.preventDefault();
});
$('#owner-form-link').click(function(e) {
$("#owner-form").delay(100).fadeIn(100);
 $("#admin-form").fadeOut(100);
 $("#employee-form").fadeOut(100);
$('#admin-form-link').removeClass('active');
$('#employee-form-link').removeClass('active');
$(this).addClass('active');
e.preventDefault();
});

$('#employee-form-link').click(function(e) {
$("#employee-form").delay(100).fadeIn(100);
 $("#admin-form").fadeOut(100);
 $("#owner-form").fadeOut(100);
$('#admin-form-link').removeClass('active');
$('#owner-form-link').removeClass('active');
$(this).addClass('active');
e.preventDefault();
});

});

</script>
@endsection


@push('plugin-scripts')
  
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('backend/js/expense.js') }}"></script>
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush