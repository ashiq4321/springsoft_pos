@extends('layout.master')
@section('title')
Essential-infotech- Edit Category
@endsection
@section('content')
<div class="row">
  <div class="col-lg-6 m-auto">
    <div class="card">
      @if(session('success'))
      <strong class="alert alert-success">{{session('success')}}</strong>
      @endif
      <div class="card-header">
        <h4 class="card-title">Edit Category</h4>
      </div>
      <div class="card-body">
        <form action="{{url('edit_categorypost')}}" method="POST">
            @csrf
            <div class="form-group">
              <label>Category</label>
              <input type="text" name="category_name" class="form-control" value="{{$get_category->category_name}}" placeholder="Category Name">
              <input type="hidden" name="id" class="form-control" value="{{$get_category->id}}" placeholder="Category Name">
              @error('category_name')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror
            </div>
             <div class="form-group">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="1" {{($get_category->status == 1)? 'checked':''}}>&nbsp&nbsp&nbspOn
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="0" {{($get_category->status == 0)? 'checked':''}}>&nbsp&nbsp&nbspOff
                  </div>
                  @error('status')
                  <strong class="text-danger">{{$message}}</strong>
                  @enderror
              </div>
              <div>
              <img src="{{asset('uploads/category/')}}/{{$get_category->category_image}}" width="200px">
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