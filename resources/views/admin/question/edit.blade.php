@extends('layout.master')
@section('title')
Essential-infotech- Edit Question
@endsection
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <!-- <h4 class="card-title">Billing Details</h4> -->
        <!-- <p class="card-description">Read the <a href="https://jqueryvalidation.org/" target="_blank"> Official jQuery Validation Documentation </a>for a full list of instructions and other options.</p> -->
        <div class="row">
          <div class="col-lg-5 m-auto">
          	@if(session('success'))
	          <div class="alert alert-success">
	            {{session('success')}}
	          </div>
          	@endif
            <h4 class="card-title">Edit Question</h4>
            <form action="{{url('edit_questionpost')}}" method="POST">
            @csrf
            <div class="form-group">
              <label>Question</label>
              <input type="text" name="question" class="form-control" value="{{$get_question->question}}">
              <input type="hidden" name="id" class="form-control" value="{{$get_question->id}}">
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
              @error('question')
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
</div>
@endsection