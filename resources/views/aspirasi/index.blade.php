@extends('layouts.main')
@section('content')
<main style="margin-top: -25px;">
    <div class="col">
        <div class="py-5" style="background-image: url(img/night.jpg);background-position: center center;background-size: cover;background-repeat: no-repeat;">
            <div class="container">
                <div class="row justify-content-center py-5" >
                    <div class="col-md-6 text-center">
                        <h1 class="text-white" >Selamat Datang di Ruang Aspirasi</h1>
                        <p class="text-white mb-4" > tempat dimana kalian dapat membaca konten menarik disini </p>
                        @if ($user->role == 'user')
                            <form class="rounded position-relative">
                                <input class="bg-light form-control ps-5" type="search" aria-label="Search" placeholder="Search...">
                                <button class="btn bg-transparent px-2 py-0 position-absolute top-50 start-0 translate-middle-y" type="submit">
                                    <svg class="bi bi-search" fill="currentColor" height="1em" style="font-size:26px;" viewbox="0 0 16 16" width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                                        </path>
                                    </svg>
                                </button>
                            </form>
                        @else
                              <a
                              class="link-primary btn btn-light border rounded border-0"
                              href="{{ route('create.content') }}"
                              >
                              Buat Konten
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5" style="margin-top:-63px;">
        <div class="container">
            <div class="tab-content mb-0 pb-0">
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                    <div class="row g-4">

                      @foreach ($posts as $post)
                      <div class="col-sm-6 col-lg-4">
                            <div class="card h-100">
                                @if ($post->image)
                                <img
                                class="card-img-top w-100 d-block card-img-top w-100 card-img-top"
                                src="{{ asset('storage/aspirasi/'.$post->image) }}"
                                alt="Post"
                                >
                                @else
                                <img
                                class="card-img-top w-100 d-block card-img-top w-100 card-img-top"
                                src="../img/aspirasi.jpg"
                                alt="Post"
                                >
                                @endif

                                <div class="card-body"><a class="text-body" href="{{ route('content.show', $post->id) }}">{{ $post->title }}</a>
                                    <ul class="nav flex-wrap nav-stack small mt-3">
                                        <li class="nav-item"><a class="nav-link link-primary" href="{{ route('content.show', $post->id) }}"><em>baca selengkapnya -&gt;</em></a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                      @endforeach

                        <div class="col-12 text-center"><button class="btn btn-primary mb-0" type="button"><span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true">
                            </span> Loading </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
