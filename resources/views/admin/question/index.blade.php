@extends('layout.master')
@section('title')
Essential-infotech- Add Question
@endsection
@section('content')
<div class="row">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header">
        <h4>Question Table</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
              <table class="table table-bordered">
                <tr>
                  <th>SL NO</th>
                  <th>Category</th>
                  <th>Question Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                @forelse($questions as $index => $question)
                  <tr>
                    <td>{{$questions->firstitem() + $index}}</td>
                    <td>{{$question->connect_to_category->category_name}}</td>
                    <td>{{$question->question}}</td>
                    <td>
                      <a href="{{url('question_active')}}/{{$question->id}}" class="btn @php echo $question->status == 0?'bg-maroon':'bg-blue'@endphp">
                        @php
                        echo $question->status == 0?'Off&nbsp&nbsp&nbsp<i data-feather="toggle-left"></i>':'On&nbsp&nbsp&nbsp<i data-feather="toggle-right"></i>'
                        @endphp
                      </a>
                    </td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('edit_question')}}/{{$question->id}}" class="btn bg-blue"><i data-feather="edit"></i></a>
                        <a href="{{url('delete_question')}}/{{$question->id}}" class="btn bg-marron"><i data-feather="delete"></i></a>
                      </div>
                    </td>
                  </tr>
                @empty
                <tr>
                  <td class="text-center text-danger" colspan="4">No Data Found</td>
                </tr>
                @endforelse
              </table>
            </div>
            <div>
              {{$questions->links()}}
            </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Add Question</h4>
      </div>
      <div class="card-body">
        <form action="{{url('questionpost')}}" method="POST">
            @csrf
            <div class="form-group">
              <label>Category</label>
              <select name="category_id" class="form-control">
                <option value="">-- Choose Category --</option>
                @foreach($get_category as $category)
                  <option value="{{$category->id}}">{{$category->category_name}}</option>
                @endforeach
              </select>
              @error('category_id')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Question</label>
              <input type="text" name="question" class="form-control" value="{{old('question')}}">
              @error('question')
              <div class="alert alert-danger">
                <small>{{$message}}</small>
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Status</label>
              <select name="status" class="form-control">
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
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
 
@endsection