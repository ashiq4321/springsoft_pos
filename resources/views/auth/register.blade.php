@extends('layout.master2')
<style>
.form-group{
  margin-bottom: 5px !important;
}
</style>
@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pr-md-0">
            <div class="auth-left-wrapper" style="background-image: url({{ url('https://www.nobleui.com/html/template/assets/images/carousel/img6.jpg') }})">

            </div>
          </div>
          <div class="col-md-8 pl-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo d-block mb-2">Noble<span>UI</span></a>
              <h5 class="text-muted font-weight-normal mb-4">Create a free account.</h5>
              

<form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group" >
                            <label for="name" >{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-group " >
                            <label for="email" >{{ __('E-Mail Address') }}</label>

                            
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            
                        </div>

                        <div class="form-group " >
                            <label for="password" >{{ __('Password') }}</label>

                           
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
               
                        </div>

                        <div class="form-group " >
                            <label for="password-confirm" >{{ __('Confirm Password') }}</label>

                            
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
               
                        </div>

                        <div class="form-group mb-2" >
                            <label for="role" >{{ __('Role') }}</label>

                       
                              <select name="role" required class="form-control" required>
                              <option value="">Select Your Role</option>
                                  <option value="1">Admin</option>
                                  <option value="2">Owner</option>
                                  <option value="3">Employee</option>
                              </select> 
              
                        </div>

                        <div class="form-group" >
                            <div class="col-md-6 " style="padding-left: 0 !important">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        <a href="{{ route('login') }}" class="d-block mt-3 text-muted">Already a user? Sign in</a>
                    </form>



              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>



                    
@endsection
