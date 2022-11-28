@extends('layouts.main')

@section('title','Login')

@section('content')
  <main class="form-login w-50 m-auto text-center my-5">
    <form method="post" action="{{route('login.process')}}">
      @csrf
      <img class="mt-5 mb-3" src="{{asset('source/flower1.svg')}}" alt="" width="72" height="57">
      
      <h5 class="h5 mb-5 fw-bold">City Garden Hotel</h5>
      <h5 class="h6 mt-3 fw-normal">Please Log-In</h5>

      @if(session('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ $errors->login->first('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="form-floating">
        <input type="text" name="nama_user" class="form-control" id="floatingInput" placeholder="Username">
        <label for="floatingInput">Username</label>
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>

      <div class="checkbox mb-3">
        <label><input type="checkbox" value="remember-me"> Remember me</label>
      </div>
      <button class="w-100 btn btn-lg text-light btn-primary fw-semibold" type="submit">Log in</button>
      <p class="mt-5 mb-3 text-muted">Fadhilah Qalbi Annisa &copy; 2022</p>
    </form>
  </main>

@endsection