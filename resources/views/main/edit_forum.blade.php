@extends('layouts.main')
@section('content')

    <main>
      <div class="container">
        <div class="card">
            @if (session()->has('loginError'))
            <div class=" m-3 alert alert-danger" role="alert">
                {{session('loginError')  }}

            </div>
        @endif
        @if (session()->has('success'))
            <div class="m-3 alert alert-success" role="alert">
                {{session('success')  }}

            </div>
        @endif
          <div class="card-header border-0 pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center">
                <div>
                  <div class="nav nav-divider">
                    <div class="avatar avatar-xs me-2">
                      <a href="#"
                        >@if($user->image === null)
                            <img
                            alt="profile"
                            class="avatar-img rounded-2"
                            src="../img/person-outline-filled.svg"
                            >
                        @else
                            <img
                          alt="Profile"
                          class="avatar-img rounded-2"
                          src="{{ asset('storage/profilepicture/'.$user->image) }}"
                            >
                        @endif
                      </a>
                    </div>
                    <h6 class="nav-item card-title mb-0">{{ $user->username }}</h6>
                  </div>
                  <p class="mb-0 small" style="margin-top: 5px">{{ $user->role }}</p>
                </div>
              </div>
            </div>
          </div>
          <form id="addForm" method="POST" action="
                {{ route('forum.update', ['id'=> $forum->id])}}"
                enctype="multipart/form-data" class="needs-validation" novalidate>
                  @csrf
                  @method('PUT')
            <div class="card-body">
              <div class="mb-3">
                <textarea
                  class="form-control"
                  rows="5"
                  name="isi"
                  id="contentTextarea"
                  placeholder="Share your thoughts..."
                >{{ $forum->isi }}</textarea>
              </div>
              <input type="hidden" name="anonim" value="{{ $forum->is_anonim }}"> {{-- ini anonim otomatis sama --}}
              <input type="hidden" name="user" value="{{ $forum->user_id }}">
              <input type="hidden" name="default_image" value="{{ $forum->image }}">
              <input
                type="file"
                class="form-control"
                name="image"
                tabindex="4"
                accept="image/*"
                value="{{ $forum->image }}"
              />

              <div class="mt-3">
                <button class="btn btn-danger">Cancel</button>
                <button class="btn btn-primary">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div
        class="col-md-8 col-lg-6 vstack gap-4"
        style="padding-left: 92px; padding-right: 92px"
      >
        <div class="d-flex gap-2 mb-n3"></div>
      </div>


    </main>
    @endsection
