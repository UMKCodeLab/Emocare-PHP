@extends('layouts.main')
@section('content')
<main>
    <div class="container">
      <div class="py-3"  style="background-image: url(img/night.jpg); background-position: center center;background-size: cover;background-repeat: no-repeat;">
        <h2 class="text-center text-white">Content Aspirasi</h2>
      </div>

      <div class="py-7  bg-white">
        <!-- Form konten -->
        <div class="card-body px-4 py-4">
            @if (session()->has('loginError'))
            <div class=" alert alert-danger" role="alert">
                {{session('loginError')  }}

            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{session('success')  }}

            </div>
        @endif
          <form class="row g-3" method="POST" action="{{ route('store.content') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
              <input
                type="hidden"
                name="user"
                value="{{ $user->id }}"
                >
              <label for="" class="form-label">Judul</label>

              <input type="text" class="form-control" id="" name="title" required>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Isi Konten</label>

              <textarea class="form-control" id="" placeholder="" style="height:200px" name="body" required></textarea>
            </div>
            <div class="form-group row mb-4">
                <label
                  class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                  >Upload Gambar</label
                >

                <div class="col-sm-12 col-md-7">
                  <input
                    type="file"
                    class="form-control"
                    name="image"
                    tabindex="4"
                    accept="image/*"
                  />
                </div>
            </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
          </form>
        </div>
      </div>
    </div>
  </main>
@endsection
