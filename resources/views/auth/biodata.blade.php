@extends('layouts.login')
@section('content')
<div
class="container d-flex justify-content-center align-items-center vh-100"
>
<div class="col-lg-6 col-xl-8">
  <div class="card">
    <div class="card-body">
      <h2 class="text-center text-primary">Bio Data</h2>
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
      <form method="POST" action="{{ route('biodata.proses',['username'=>session('username')])}}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        <!-- Bio Data -->
        <input type="hidden" name="username" value="{{session('username') }}">
        <!-- Full Name input -->
        <div class="mb-3 row">
          <!-- First Name input -->
          <div class="col-md-6">
            <label for="bio-firstname" class="form-label"
              >Nama Depan</label
            >
            <input
              id="bio-firstname"
              type="text"
              class="form-control"
              name="firstname"
              tabindex="5"
            />
            @error('firstname')
            <small>{{ $message }}</small>

            @enderror
          </div>

          <!-- Last Name input -->
          <div class="col-md-6">
            <label for="bio-lastname" class="form-label"
              >Nama Belakang</label
            >
            <input
              id="bio-lastname"
              type="text"
              class="form-control"
              name="lastname"
              tabindex="6"
            />
            @error('lastname')
            <small>{{ $message }}</small>

            @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <!-- Upload Foto Profil input -->
          <div class="col-md-6">
            <label for="profile-picture" class="form-label"
              >Upload Foto Profil</label
            >
            <input
              id="profile-picture"
              type="file"
              class="form-control"
              name="image"
              tabindex="4"
              accept="image/*"
            />
            @error('image')
            <small>{{ $message }}</small>

            @enderror
          </div>

          <!-- Tanggal lahir input -->
          <div class="col-md-6">
            <label for="bio-dob" class="form-label">Tanggal Lahir</label>
            <input
              id="bio-dob"
              type="date"
              class="form-control"
              name="lahir"
              tabindex="7"
            />
          </div>
        </div>

        <!-- Status input -->
        <div class="mb-3">
          <label for="bio-status" class="form-label">Status</label>
          <textarea
            id="bio-status"
            class="form-control"
            name="status"
            rows="2"
            tabindex="8"
            maxlength="300"
          ></textarea>
          @error('status')
          <small>{{ $message }}</small>

          @enderror
          <div class="form-text text-muted">
            Masukkan status Anda (maksimal 300 karakter).
          </div>
        </div>

        <!-- Optional Skip Button -->


        <!-- Submit button -->
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary mb-4">
            Simpan Bio Data
          </button>
        </div>
{{--
        <div class="mt-3 text-muted text-center">
          <a href="register.html">Kembali ke Halaman Pendaftaran</a>
        </div> --}}
      </form>
      <div class="d-grid gap-2">
        <a class="btn btn-secondary mb-3" href="{{ route('login') }}"> Lewati</a>


      </div>
    </div>
  </div>
</div>
</div>
@endsection
