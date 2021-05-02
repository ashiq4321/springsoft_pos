@extends('layout.master')
@section('title')
Essential-infotech- All Users
@endsection
@section('content')
<div class="row">
  <div class="col-lg-6 m-auto">
    <div class="card">
      <div class="card-header">
        <h4 style="font-family: 'Brush Script MT', cursive;">Edit User Profile</h4>
      </div>
      <div class="card-body">
            @if(session('editsuccess'))
	          <div class="alert alert-success">
	            {{session('editsuccess')}}
	          </div>
          	@endif
            @if(session('editerror'))
            <div class="alert alert-danger">
              {{session('editerror')}}
            </div>
            @endif
          	<form action="{{url('editprofilepost')}}" method="POST">
            @csrf
            <div class="form-group">
              <label>Old Password</label>
              <input type="password" name="old_password" class="form-control">
              @error('old_password')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label>New Password</label>
              <input type="password" name="password" class="form-control">
              @error('password')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Confirm New Password</label>
              <input type="password" name="password_confirmation" class="form-control">
              @error('password_confirmation')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        	
      </div>
    </div>
</div>
@endsection