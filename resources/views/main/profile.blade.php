@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row g-4">
      <div class="col-lg-8 vstack gap-4">
        <div class="card">
          <div
            class="h-200px rounded-top"
            style="
              background-image: url(img/night.jpg);
              background-size: cover;
              background-repeat: no-repeat;
            "
          ></div>
          <div class="card-body py-0">
            <div
              class="text-center text-sm-start d-sm-flex align-items-start"
            >
              <div>
                <div class="avatar avatar-xxl mt-n5 mb-3">
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
                    src="{{ asset('storage/profilepicture/'.$user->image) }}"
                    >
                @endif
                </div>
              </div>
              <div class="ms-sm-4 mt-sm-3">
                <h1 class="mb-0 h5">{{ $user->username }}</h1>
              </div>
              <div class="d-flex justify-content-center ms-sm-auto mt-3">
                <a
                  class="btn btn-danger-soft me-2"
                  role="button"
                  href="{{ route('setting_profile',['id'=>$user->id]) }}"
                >
                  Edit profile
                </a>
              </div>
            </div>
          </div>
          <div class="card-footer mt-3 pt-2 pb-0">
            <ul
              class="nav card-header-s border-0 justify-content-center align-items-center justify-content-md-start card-header-s nav-bottom-line mb-0"
            >
              <li class="nav-item">
                <a
                  class="nav-link active"
                  href="#"
                >
                  Posts
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="card card-body">
            @if (session()->has('loginError'))
                <div class="alert alert-danger" role="alert">
                    {{session('loginError')  }}
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session('success')  }}
                </div>
            @endif
            <div class="d-flex mb-3">
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
                      src="{{ asset('storage/profilepicture/'.$user->image) }}"
                      >
                  @endif
                </a>
              </div>
              <div class="w-100">
                <input
                  type="text"
                  class="border-0 form-control form-control form-control pe-4"
                  placeholder="Share your thoughts..."
                  data-bs-target="#feedActionPhoto"
                  data-bs-toggle="modal"
                  readonly
                  href="#"
                />
              </div>
            </div>
            <ul class="nav nav-pills fw-normal nav-stack small">
              <li class="nav-item">
                <a
                  class="nav-link bg-light py-1 px-2 mb-0"
                  data-bs-target="#feedActionPhoto"
                  data-bs-toggle="modal"
                  href="#"
                >
                  <i style="width: 14px" class="mb-1" data-feather="camera">
                  </i
                  >&nbsp;Photo</a
                >
              </li>
              <!-- <li class="nav-item"></li>
              <li class="nav-item ms-lg-auto dropdown">
                <a
                  class="nav-link bg-light py-1 px-2 mb-0"
                  aria-expanded="false"
                  data-bs-toggle="dropdown"
                  href="#"
                  id="feedActionShare"
                >
                  <i style="width: 14px" data-feather="send"></i>
                </a>
              </li> -->
            </ul>

            <!-- create post start -->
            <div
              class="modal fade"
              role="dialog"
              tabindex="-1"
              id="feedActionPhoto"
              aria-labelledby="feedActionPhotoLabel"
              aria-hidden="true"
            >
              <form id="addForm" method="POST" action="
              {{ route('posting')}}
              " enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <input
                type="hidden"
                name="user"
                value="{{ $user->id }}"
                >
                <div
                  class="modal-dialog modal-dialog-centered"
                  role="document"
                >
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">
                        Buat Postingan
                      </h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">
                      <!-- Your existing form fields go here -->
                      <div class="form-group row mb-4">
                        <div class="col-sm-12">
                          <textarea
                            class="form-control"
                            rows="5"
                            name="isi"
                            id="contentTextarea"
                            placeholder="Share your thoughts..."
                          ></textarea>
                        </div>
                      </div>

                      {{-- <div class="form-group row mb-4">
                        <label
                          class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                          >Tags</label
                        >
                        <div class="col-sm-12 col-md-7">
                          <input
                            type="text"
                            class="form-control"
                            name="tags"
                          />
                        </div>
                      </div> --}}
                      <div class="form-group row mb-4">
                        <label
                          class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                          for="anonimCheckbox"
                          >Post anonim</label
                        >
                        <div
                          class="col-sm-12 col-md-7 d-flex align-items-center"
                        >
                          <div class="form-check">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              value="1"
                              id="anonimCheckbox"
                              name="anonim"
                            />
                          </div>
                        </div>
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
                    </div>
                    <div class="modal-footer">
                      <button
                        type="submit"
                        class="btn btn-secondary w-100"
                        id="uploadButton"
                        disabled=""
                      >
                        Upload
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!-- create post end-->
          </div>

          @foreach ($forum as $item)

          <div class="card">
            <div class="card-header border-0 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        @if ($item->is_anonim)
                        <div>
                            <div class="nav nav-divider">
                              <div class="avatar avatar-xs me-2">
                                <a href="#"
                                  ><img
                                    class="rounded-circle avatar-img"
                                    src="../img/person-outline-filled.svg"
                                    alt="profile"
                                /></a>
                              </div>
                              <h6 class="nav-item card-title mb-0">Anonim</h6>
                              <span class="nav-item small">{{ $item->created_at->diffForHumans() }} </span>
                            </div>
                            <p class="mb-0 small" style="margin-top: 5px">anonim</p>
                          </div>
                        @else
                        <div>
                            <div class="nav nav-divider">
                                <div class="avatar avatar-xs me-2">
                                    <a href="#"
                                    >
                                @if($item->user->image === null)
                                    <img
                                    alt="profile"
                                    class="avatar-img rounded-2"
                                    src="../img/person-outline-filled.svg"
                                    >
                                @else
                                    <img
                                    alt="Profile"
                                    class="avatar-img rounded-2"
                                    src="{{ asset('storage/profilepicture/'.$item->user->image) }}"
                                    >
                                @endif
                                </a>
                                </div>
                                <div class="nav nav-divider">
                                    <h6 class="nav-item card-title mb-0">{{ $item->User->username }}</h6>
                                    <span class="nav-item small">{{ $item->created_at->diffForHumans() }} </span>
                                </div>
                            </div>
                            <p class="mb-0 small" style="margin-top: 5px">
                                {{ $item->User->role }}
                            </p>
                        </div>
                        @endif
                    </div>



                    <div class="dropdown">
                        <a
                        class="btn text-secondary btn-secondary-soft-hover py-1 px-2"
                        role="button"
                        href="#"
                        id="cardFeedAction-1"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        ><i style="width: 16px" data-feather="settings"></i
                            ></a>
                            <ul
                            class="dropdown-menu dropdown-menu-end"
                            aria-labelledby="cardFeedAction"
                            >
                            <li>
                                <a class="dropdown-item" href="#"
                                ><i class="bi bi-slash-circle fa-fw pe-2"></i>Hapus</a
                                >
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                                <a class="dropdown-item" href="#"
                                ><i class="bi bi-flag fa-fw pe-2"></i>Report post</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body" style="margin-bottom: 8px">
                <p>
                    {{ $item->isi }}
                </p>
            @if ($item->image)
                <img
                class="card-img"
                src="{{ asset('storage/forumimg/'.$item->image) }}"
                alt="Post"
                />
            @endif
                <ul class="nav nav-stack py-3 small">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('komentar',['id'=>$item->id]) }}"
                        ><i
                        class="mb-1"
                        data-feather="message-circle"
                        style="width: 20px"
                        ></i>
                        Comments</a
                        >
                    </li>
                </ul>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection
