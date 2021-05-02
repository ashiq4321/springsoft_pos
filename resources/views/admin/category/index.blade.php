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
                  <th>Category Name</th>
                  <th>Category Image</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                @forelse($get_categories as $index => $category)
                <tr>
                  <td>{{$get_categories->firstitem() + $index}}</td>
                  <td>{{$category->category_name}}</td>
                  <td><img src="{{asset('uploads/category/')}}/{{$category->category_image}}" width="50px;"></td>
                  <td>
                    <a href="{{url('active_category')}}/{{$category->id}}" class="btn @php echo $category->status == 0?'bg-maroon':'bg-blue'@endphp">
                        @php
                        echo $category->status == 0?'Off&nbsp&nbsp&nbsp<i data-feather="toggle-left"></i>':'On&nbsp&nbsp&nbsp<i data-feather="toggle-right"></i>'
                        @endphp
                    </a>
                  </td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('edit_category')}}/{{$category->id}}" class="btn bg-blue"><i data-feather="edit"></i></a>
                        <a href="{{url('delete_category')}}/{{$category->id}}" class="btn bg-marron"><i data-feather="delete"></i></a>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td class="text-danger text-center" colspan="4">No Data Found</td>
                </tr>
                @endforelse
              </table>
            </div>
            <div class="mt-2">
              {{$get_categories->links()}}
            </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card">
      @if(session('category_success'))
      <strong class="alert alert-success">{{session('category_success')}}</strong>
      @endif
      <div class="card-header">
        <h4 class="card-title">Add Category</h4>
      </div>
      <div class="card-body">
        <form action="{{url('categorypost')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Category</label>
              <input type="text" name="category_name" class="form-control" value="{{old('category_name')}}" placeholder="Category Name">
              @error('category_name')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Status</label>
              <select name="status" class="form-control">
                <option value="">-- Choose Category --</option>
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
              <label>Category Image</label>
              <input type="file" class="form-control" name="category_image" value="{{old('category_image')}}">
              @error('category_image')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection