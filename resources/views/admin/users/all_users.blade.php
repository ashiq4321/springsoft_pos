@extends('layout.master')
@section('title')
Essential-infotech- All Users
@endsection
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-8">
            <h4 style="font-family: 'Brush Script MT', cursive;">Users Table</h4>
          </div>
          <div class="col-lg-4" style="text-align: end;">
            <a href="{{url('add_user')}}" class="btn btn-primary pull-right">Add User</a>
          </div>
        </div>
      </div>
      <div class="card-body">
       
        <div class="row">
        	<div class="col-lg-12">
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
            <div class="table-responsive">
              <table class="table table-bordered text-center">
                <tr>
                  <th>SL NO</th>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
                @forelse($all_users as $index => $user)
                <tr>
                  <td>{{$all_users->firstitem() + $index}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>
                        @php
                        echo $user->role == 0?'<span class="badge bg-primary text-white">User</span>':'<span class="badge bg-dark text-white">Admin</span>'
                        @endphp
                  </td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('user_edit')}}/{{$user->id}}" class="btn bg-blue"><i data-feather="edit"></i></a>
                        <a href="{{url('user_delete')}}/{{$user->id}}" class="btn bg-marron"><i data-feather="delete"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
            <div class="mt-2">
              {{$all_users->links()}}
            </div>
        	</div>
        </div>

        <div class="row">
          <div class="col-lg-12 mt-5">
            @if(session('delete'))
            <div class="alert alert-success">
              {{session('delete')}}
            </div>
            @endif
            <h4 class="mb-3" style="font-family: 'Brush Script MT', cursive;">Admin Table</h4>
            <div class="table-responsive">
              <table class="table table-bordered text-center">
                <tr>
                  <th>SL NO</th>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
                @forelse($all_admin as $index => $user)
                <tr>
                  <td>{{$all_users->firstitem() + $index}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>
                        @php
                        echo $user->role == 0?'<span class="badge bg-success text-white">User</span>':'<span class="badge bg-dark text-white">Admin</span>'
                        @endphp
                  </td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('user_edit')}}/{{$user->id}}" class="btn bg-blue"><i data-feather="edit"></i></a>
                        <a href="{{url('user_delete')}}/{{$user->id}}" class="btn bg-marron"><i data-feather="delete"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
            <div class="mt-2">
              {{$all_users->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection