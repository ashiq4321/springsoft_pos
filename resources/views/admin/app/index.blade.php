@extends('layout.master')
@section('title')
Essential-infotech- Add Category
@endsection
@section('content')
<div class="row">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header">
        <h4>Category Table</h4>
      </div>
      <div class="card-body">
            @if(session('delete'))
            <div class="alert alert-success">
              {{session('delete')}}
            </div>
            @endif
            <!-- <h4>Category Table</h4> -->
            <div class="table-responsive">
              <table class="table table-bordered">
                <tr>
                  <th>SL NO</th>
                  <th>App Name</th>
                  <th>App Image</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                @forelse($getapps as $index => $app)
                <tr>
                  <td>{{$getapps->firstitem() + $index}}</td>
                  <td>{{$app->app_name}}</td>
                  <td><img src="{{asset('uploads/applogo/')}}/{{$app->app_logo}}" width="50px"></td>
                  <td>
                    <a href="{{url('active_app')}}/{{$app->id}}" class="btn @php echo $app->status == 0?'bg-maroon':'bg-blue'@endphp">
                        @php
                        echo $app->status == 0?'Off&nbsp&nbsp&nbsp<i data-feather="toggle-left"></i>':'On&nbsp&nbsp&nbsp<i data-feather="toggle-right"></i>'
                        @endphp
                    </a>
                  </td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('edit_app')}}/{{$app->id}}" class="btn bg-blue"><i data-feather="edit"></i></a>
                        <a href="{{url('delete_app')}}/{{$app->id}}" class="btn bg-marron"><i data-feather="delete"></i></a>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td class="text-center text-danger" colspan="5">No Data Found</td>
                </tr>
                @endforelse
              </table>
            </div>
            <div class="mt-2"> 
              {{$getapps->links()}}
            </div>
            
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card">
      @if(session('logo_success'))
      <strong class="alert alert-success">{{session('logo_success')}}</strong>
      @endif
      <div class="card-header">
        <h4 class="card-title">Add App Info</h4>
      </div>
      <div class="card-body">
        <form action="{{url('appinfopost')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>App Name</label>
              <input type="text" name="app_name" class="form-control" value="{{old('app_name')}}" placeholder="App Name">
              @error('app_name')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Status</label>
              <select name="status" class="form-control">
                <option value="">-- Choose Status --</option>
                <option value="1">Active</option>
                <option value="0">Deactive</option>
              </select>
              @error('status')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label>App Logo</label>
              <input type="file" class="form-control" name="app_logo" value="{{old('app_logo')}}">
              @error('app_logo')
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
</div>
@endsection