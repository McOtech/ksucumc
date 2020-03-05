@extends('layouts.auth')

@section('content')
<div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
<div class="col-md-7">
<div class="p-5">
    <div class="text-center">
      <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
    </div>
    <form method="POST" action="{{ route('register') }}" class="user">
        @csrf

      <div class="form-group row">
        <div class="col-sm-12 mb-3 mb-sm-0">
          <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror" id="username" placeholder="Username" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
          @error('username')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
      </div>
      <div class="form-group">
        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" id="email" placeholder="Email Address">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
          <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" id="password" placeholder="Password">
          @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        <div class="col-sm-6">
          <input type="password" class="form-control form-control-user" id="password-confirm" placeholder="Repeat Password" name="password_confirmation" required autocomplete="new-password">
        </div>
      </div>
      <input type="submit" value="Register Account" class="btn btn-primary btn-user btn-block">

      {{-- <hr> {{route('ministry-admin')}}
      <a href="index.html" class="btn btn-google btn-user btn-block">
        <i class="fab fa-google fa-fw"></i> Register with Google
      </a>
      <a href="index.html" class="btn btn-facebook btn-user btn-block">
        <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
      </a> --}}
    </form>
    <hr>
    <div class="text-center">
      <a class="small" href="forgot-password.html">Forgot Password?</a>
    </div>
    <div class="text-center">
      <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
    </div>
  </div>
</div>
@endsection
