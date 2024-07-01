@extends('layouts.main')
@section('content')
 <main>
      <div class="container">
        <div class="row g-4">
          <div class="col-md-8 col-lg-6 vstack gap-4">
            <div class="d-flex gap-2 mb-n3"></div>
            <div class="card">
              <div class="card-header border-0 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center">
                    <div>
                      <div class="nav nav-divider">
                        <div class="avatar avatar-xs me-2">
                          <a href="#">
                            @if($user->image === null)
                                <img
                                alt="profile"
                                class="avatar-img rounded-2"
                                src="../img/person-outline-filled.svg"
                                >
                             @else
                                <img
                                alt="Profile"
                                class="avatar-img rounded-2"
                                src="{{ asset('storage/profilepicture/'.$data->user->image) }}"
                                >
                             @endif
                            </a>
                        </div>
                        <div class="nav nav-divider">
                          <h6 class="nav-item card-title mb-0">{{ $data->user->username }}</h6>
                          <span class="nav-item small">{{ $data->created_at->diffForHumans() }} </span>
                        </div>
                      </div>
                      <p class="mb-0 small" style="margin-top: 5px">
                        {{ $data->user->role }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            <div class="card-body">
                <h1>{{ $data->title }}</h1>
                @if ($data->image)
                <img
                    class="card-img mb-3"
                    src="{{ asset('storage/aspirasi/'.$data->image) }}"
                    alt="Post"
                />
                @endif
                <p>
                  {{ $data->body }}
                </p>
            </div>
          </div>
          </div>
        </div>
    </div>

@endsection
