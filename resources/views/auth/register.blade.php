@extends('layouts.login')
@section('content')
<div
    id="registrationForm"
    class="container justify-content-center align-items-center vh-100"
    style="display: flex"
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
      <h2 class="text-center text-primary mb-4">Daftar</h2>
      <form method="POST" action="{{ route('register.proses') }}" class="needs-validation" novalidate>
        <!-- User Type selection -->
        @csrf
        <div class="form-outline mb-4">
            <label for="user-type">Daftar Sebagai:</label>
            <select
              id="user-type"
              class="form-select"
              name="role"
              tabindex="3"
              required=""
              >
              <option value="" disabled selected>Pilih...</option>
              <option value="user">User</option>
              <option value="psikiater">Psikiater</option>
            </select>
            @error('role')
            <small>{{ $message }}</small>

            @enderror
            <div class="invalid-feedback">Pilih peran Anda</div>
          </div>

        <!-- Username input -->
        <div class="form-outline mb-4">
            <label for="username">Username</label>
            <input
              id="username"
              value="{{ old('username') }}"
              type="text"
              class="form-control"
              name="username"
              tabindex="1"
              required=""
              autofocus=""
            />
            @error('username')
            <small>{{ $message }}</small>

            @enderror
            <div class="invalid-feedback">Masukan Username Anda</div>
          </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <label for="password">Password</label>
            <input
              id="password"
              type="password"
              class="form-control"
              name="password"
              tabindex="2"
              required=""
            />
            @error('password')
            <small>{{ $message }}</small>

            @enderror
            <div class="invalid-feedback">Masukan Password Anda</div>
          </div>

        <!-- Submit button -->
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary mb-4">
            Daftar
          </button>
        </div>

        <!-- Register buttons -->
        <div class="mt-5 text-muted text-center">
            Sudah punya akun? <a href="{{ route('login') }}">Login</a>
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
