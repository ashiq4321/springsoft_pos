@extends('layout.master')
@section('title')
Essential-infotech- All Users
@endsection
@section('content')
<div class="row">
  <div class="col-lg-6 m-auto">
    <div class="card">
      <div class="card-header">
        <h4>Edit User Information</h4>
      </div>
      <div class="card-body">
            @if(session('delete_success'))
	          <div class="alert alert-success">
	            {{session('delete_success')}}
	          </div>
          	@endif
          	<form action="{{url('edit_user_post')}}" method="POST">
              @csrf
                <div class="form-group">
                  <input type="text" name="name" class="form-control" value="{{$get_user->name}}" placeholder="User Name">
                  <input type="hidden" name="id" class="form-control" value="{{$get_user->id}}" placeholder="User Name">
                  @error('name')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control" value="{{$get_user->email}}">
                  @error('email')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
                </div>
                <div class="form-group">
                  <!-- <select name="role" class="form-control">
                    <option>-- Choose Role --</option>
                    <option value="1">Admin</option>
                    <option value="0">User</option>
                  </select> -->
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" value="1" {{($get_user->role == 1)? 'checked':''}}>&nbsp&nbsp&nbspAdmin
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" value="0" {{($get_user->role == 0)? 'checked':''}}>&nbsp&nbsp&nbspUser
                  </div>
                  @error('role')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        	
      </div>
    </div>
</div>
@endsection