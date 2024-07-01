@extends('layouts.main')
@section('content')
<main>
    <div class="container">
      <div
        class="tab-pane show active fade"
        id="nav-setting-tab-1"
        role="tabpanel"
      >
        <div class="card mb-4">
          <div class="card-header border-0 pb-0">
            <h1 class="h5 card-title">Profile Setting</h1>
            <p class="mb-0">
              Ubah nama, username, status, dan juga ulang tahun
            </p>
          </div>
          <div class="card-body">
            <form class="row g-3" method="POST" action="
            {{ route('edit_profile',['id'=>$item->id])}}"
            enctype="multipart/form-data" class="needs-validation" novalidate>
              @csrf
              <div class="col-sm-12">
                <label class="form-label">Edit foto profil</label
                ><input
                  class="form-control form-control"
                  type="file"
                  accept="image/*"
                  id="filepond-input"
                  name="image"
                  tabindex="4"
                />
                <small>file max 2Mb</small><br>
                @error('image')
                <small>{{ $message }}</small>

                @enderror
              </div>
              <div class="col-sm-6 col-lg-4">
                <label class="form-label form-label form-label form-label"
                  >First name</label
                ><input
                  class="form-control form-control form-control form-control"
                  type="text"
                  name="firstname"
                  placeholder=""
                  value="{{ $item->firstname }}"
                />
              </div>
              <div class="col-sm-6 col-lg-4">
                <label class="form-label form-label form-label form-label"
                  >Last name</label
                ><input
                  class="form-control form-control form-control form-control"
                  type="text"
                  placeholder=""
                  name="lastname"
                  value="{{ $item->lastname }}"
                />
              </div>
              <div class="col-sm-6">
                <label class="form-label form-label form-label form-label"
                  >User name</label
                ><input
                  class="form-control form-control form-control form-control"
                  type="text"
                  placeholder=""
                  readonly
                  name="username"
                  value="{{ $item->username }}"
                />
                @error('username')
                <small>{{ $message }}</small>

                @enderror
              </div>
              <div class="col-lg-6">
                <label class="form-label form-label form-label form-label"
                  >Birthday </label
                ><input
                  class="form-control form-control form-control form-control flatpickr flatpickr-input"
                  type="date"
                  name="lahir"

                  {{-- readonly="readonly" --}}
                  value="{{ $item->tanggal_lahir }}"
                />
              </div>
              {{-- <div class="col-12">
                <div class="form-check">
                  <input
                    type="checkbox"
                    checked=""
                    class="form-check-input"
                    id="allowChecked"
                    value=""
                  /><label
                    class="form-label form-label form-label form-check-label"
                    for="allowChecked"
                    >Yakin Diubah?</label
                  >
                </div>
              </div> --}}
              <div class="col-12">
                <label class="form-label form-label form-label form-label"
                  >Status</label
                ><textarea
                  class="form-control form-control form-control form-control"
                  placeholder="{{ $item->status }}"
                  name="status"
                  rows="4"
                  {{-- value="{{ $item->status }}" --}}
                >{{ $item->status }}</textarea
                ><small>Character limit: 300</small>
                @error('status')
                <small>{{ $message }}</small>

                @enderror
              </div>
              <div class="col-12 text-end">
                  <a href="{{ route('forum') }}" class="btn btn-warning btn-sm mb-0">
                        back
                    </a>
                <button class="btn btn-primary btn-sm mb-0" type="submit">
                  Save changes
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
