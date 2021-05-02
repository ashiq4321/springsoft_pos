@extends('layout.master')
@section('title')
Essential-infotech- View Answer
@endsection
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <!-- <h4 class="card-title">Billing Details</h4> -->
        <!-- <p class="card-description">Read the <a href="https://jqueryvalidation.org/" target="_blank"> Official jQuery Validation Documentation </a>for a full list of instructions and other options.</p> -->
        <div class="row">
        	<div class="col-lg-12">
            @if(session('delete'))
	          <div class="alert alert-success">
	            {{session('delete')}}
	          </div>
          	@endif
        		<h4>Answer Table</h4>
            <div class="table-responsive">
              <table id="dataTableExample" class="table table-bordered">
                <thead>
                  <tr>
                  <th>SL NO</th>
                  <th>Question Name</th>
                  <th>Category</th>
                  <th>User Name</th>
                  <th>Answer</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($get_answers as $answer)
                <tr>
                  <td>{{$answer->id}}</td>
                  <td>{{$answer->connect_to_question->connect_to_category->category_name}}</td>
                  <td>{{$answer->connect_to_question->question}}</td>
                  <td>{{$answer->connect_to_user->name}}</td>
                  <td>
                      @php
                      echo $answer->answer == 0?'No':'Yes'
                      @endphp
                  </td>
                  <td>{{$answer->created_at->format('d-m-y h:i:s A')}}</td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
           
        	</div>
        </div>
      </div>
    </div>
</div>
@endsection