@extends('layouts.login')
@section('content')
<div
class="container d-flex justify-content-center align-items-center vh-100"
>
<div class="col-lg-6 col-xl-4">
  <div class="card">
    <div class="card-body">
      <div class="login-brand">
        <img
          src="img/logo.svg"
          alt="logo"
          width="100"
          class="shadow-light mx-auto d-block mb-3"
        />
      </div>
      <h2 class="text-center text-primary mb-4">Login</h2>
      @if (session()->has('loginError'))
      <div class="alert alert-danger" role="alert">
        {{session('loginError')  }}
        {{-- <button type="button" class="btn-close" aria-label="close"></button> --}}
      </div>
      @endif
      @if (session()->has('success'))
      <div class="alert alert-success" role="alert">
        {{session('success')  }}
        {{-- <button type="button" class="btn-close" aria-label="close"></button> --}}
      </div>
      @endif
      <form method="POST" action="{{ route('login.proses') }}" class="needs-validation" novalidate>
        @csrf
        <!-- Email input -->
        <div class="form-outline mb-4">
          <label for="username">Username</label>
          <input
          @if (isset($_COOKIE['username']))
              value="{{ $_COOKIE['username'] }}"
          @endif
            id="username"
            type="username"
            class="form-control"
            name="username"
            tabindex="1"
            required=""
            autofocus=""
          />
          <div class="invalid-feedback">Masukan Username Anda</div>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
          <label for="password">Password</label>
          <input
          @if (isset($_COOKIE['password']))
              value="{{ $_COOKIE['password'] }}"
          @endif
            id="password"
            type="password"
            class="form-control"
            name="password"
            tabindex="2"
            required=""
          />
          <div class="invalid-feedback">Masukan Password Anda</div>
        </div>

        <div class="form-check mb-4">
          <input
            class="form-check-input"
            name="remember"
            type="checkbox"
            id="form2Example31"
          />
          <label class="form-check-label" for="form2Example31">
            Remember&nbspme
          </label>
        </div>

        {{-- <!-- 2 column grid layout for inline styling -->
        <div class="row mb-4">
          <div class="col d-flex justify-content-center">
            <!-- Checkbox -->

          </div>
        </div> --}}

        <!-- Submit button -->
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary mb-4">
            Login
          </button>
        </div>

        <!-- Register buttons -->
        <div class="mt-5 text-muted text-center">
          Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
        </div>
        <div class="simple-footer text-center">
          Copyright © Emo care 2023
        </div>
      </form>
    </div>
  </div>
</div>
</div>
@endsection